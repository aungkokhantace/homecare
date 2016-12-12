<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 8/30/2016
 * Time: 3:16 PM
 */

namespace App\Http\Controllers\Backend;

use App\Core\Utility;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\MedicalhistoryEntryRequest;
use App\Backend\Infrastructure\Forms\MedicalhistoryEditRequest;
use App\Backend\Medicalhistory\MedicalhistoryRepositoryInterface;
use App\Backend\Medicalhistory\Medicalhistory;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class MedicalhistoryController extends Controller
{
    private $medicalhistoryRepository;

    public function __construct(MedicalhistoryRepositoryInterface $medicalhistoryRepository)
    {
        $this->medicalhistoryRepository = $medicalhistoryRepository;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $medicalhistories      = $this->medicalhistoryRepository->getObjs();
                return view('backend.medicalhistory.index')->with('medicalhistories', $medicalhistories);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/medical history');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('backend.medicalhistory.medicalhistory');
        }
        return redirect('/');
    }

    public function store(MedicalhistoryEntryRequest $request)
    {
        $prefix = Utility::getTerminalId();
        $table = (new Medicalhistory())->getTable();
        $col = "id";
        $offset = 1;

        $generatedId = Utility::generatedId($prefix,$table,$col,$offset);

        $request->validate();
        $name           = Input::get('name');
        $description    = Input::get('description');

        $paramObj = new Medicalhistory();
        $paramObj->id = $generatedId;
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->medicalhistoryRepository->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\MedicalhistoryController@index')
                ->withMessage(FormatGenerator::message('Success', 'Medicalhistory created ...'));
        }
        else{
            return redirect()->action('Backend\MedicalhistoryController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Medicalhistory did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $medicalhistory = $this->medicalhistoryRepository->getObjByID($id);
            return view('backend.medicalhistory.medicalhistory')->with('medicalhistory', $medicalhistory);
        }
        return redirect('/');
    }

    public function update(MedicalhistoryEditRequest $request){

        $id = Input::get('id');
        $name           =Input::get('name');
        $description    =Input::get('description');

        $paramObj = Medicalhistory::find($id);
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->medicalhistoryRepository->update($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\MedicalhistoryController@index')
                ->withMessage(FormatGenerator::message('Success', 'Medicalhistory updated ...'));
        }
        else{
            return redirect()->action('Backend\MedicalhistoryController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Medicalhistory did not update ...'));
        }
    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->medicalhistoryRepository->delete($id);
        }
        return redirect()->action('Backend\MedicalhistoryController@index')
            ->withMessage(FormatGenerator::message('Success', 'Medicalhistory deleted ...'));

    }

}
