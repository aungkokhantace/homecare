<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 9/12/2016
 * Time: 4:46 PM
 */

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Backend\Provisionaldiagnosis\Provisionaldiagnosis;
use App\Backend\Provisionaldiagnosis\ProvisionaldiagnosisRepository;
use App\Backend\Provisionaldiagnosis\ProvisionaldiagnosisRepositoryInterface;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ProvisionaldiagnosisEntryRequest;
use App\Backend\Infrastructure\Forms\ProvisionaldiagnosisEditRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Utility;

class ProvisionaldiagnosisController extends Controller
{
    private $repo;

    public function __construct(ProvisionaldiagnosisRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $provisionaldiagnosises      = $this->repo->getArrays();
                return view('backend.provisionaldiagnosis.index')
                    ->with('provisionaldiagnosises', $provisionaldiagnosises);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/provisional diagnosis');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('backend.provisionaldiagnosis.provisionaldiagnosis');
        }
        return redirect('/');
    }

    public function store(ProvisionaldiagnosisEntryRequest $request)
    {
        $prefix = Utility::getTerminalId();
        $table = (new Provisionaldiagnosis())->getTable();
        $col = "id";
        $offset = 1;

        $generatedId = Utility::generatedId($prefix,$table,$col,$offset);

        $request->validate();
        $name                = Input::get('name');
        $description         = Input::get('description');

        $paramObj = new Provisionaldiagnosis();
        $paramObj->id = $generatedId;
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->repo->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\ProvisionaldiagnosisController@index')
                ->withMessage(FormatGenerator::message('Success', 'Provisional Diagnosis created ...'));
        }
        else{
            return redirect()->action('Backend\ProvisionaldiagnosisController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Provisional Diagnosis did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $rawProvisionaldiagnosis = $this->repo->getArrayById($id);
            if(isset($rawProvisionaldiagnosis) && count($rawProvisionaldiagnosis)>0){
                return view('backend.provisionaldiagnosis.provisionaldiagnosis')
                    ->with('provisionaldiagnosis', $rawProvisionaldiagnosis[0]);
            }
            else{
                return redirect()->action('Backend\ProvisionaldiagnosisController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Invalid Provisional Diagnosis ! ...'));
            }

        }
        return redirect('/');
    }

    public function update(ProvisionaldiagnosisEditRequest $request){
        $request->validate();

        $id = Input::get('id');
        $name                = Input::get('name');
        $description         = Input::get('description');

        $paramObj = Provisionaldiagnosis::find($id);
        $paramObj->name = $name;
        $paramObj->description = $description;
        $result = $this->repo->update($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\ProvisionaldiagnosisController@index')
                ->withMessage(FormatGenerator::message('Success', 'Provisional Diagnosis updated ...'));
        }
        else{
            return redirect()->action('Backend\ProvisionaldiagnosisController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Provisional Diagnosis did not update ...'));
        }

    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }

        return redirect()->action('Backend\ProvisionaldiagnosisController@index')
            ->withMessage(FormatGenerator::message('Success', 'Provisional Diagnosis deleted ...'));

    }
}
