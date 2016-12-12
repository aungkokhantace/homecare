<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:57 AM
 */

namespace App\Http\Controllers\Backend;

use App\Core\Utility;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\FamilyhistoryEntryRequest;
use App\Backend\Infrastructure\Forms\FamilyhistoryEditRequest;
use App\Backend\Familyhistory\FamilyhistoryRepositoryInterface;
use App\Backend\Familyhistory\Familyhistory;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class FamilyhistoryController extends Controller
{
    private $familyhistoryRepository;

    public function __construct(FamilyhistoryRepositoryInterface $familyhistoryRepository)
    {
        $this->familyhistoryRepository = $familyhistoryRepository;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $familyhistories       = $this->familyhistoryRepository->getObjs();
                return view('backend.familyhistory.index')->with('familyhistories', $familyhistories);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/family history');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('backend.familyhistory.familyhistory');
        }
        return redirect('/');
    }

    public function store(FamilyhistoryEntryRequest $request)
    {
        $prefix = Utility::getTerminalId();
        $table = (new Familyhistory())->getTable();
        $col = "id";
        $offset = 1;

        $generatedId = Utility::generatedId($prefix,$table,$col,$offset);

        $request->validate();
        $name           = Input::get('name');
        $description    = Input::get('description');

        $paramObj = new Familyhistory();
        $paramObj->id = $generatedId;
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->familyhistoryRepository->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\FamilyhistoryController@index')
                ->withMessage(FormatGenerator::message('Success', 'Family history created ...'));
        }
        else{
            return redirect()->action('Backend\FamilyhistoryController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Family history did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $familyhistory = $this->familyhistoryRepository->getObjByID($id);
            return view('backend.familyhistory.familyhistory')->with('familyhistory', $familyhistory);
        }
        return redirect('/');
    }

    public function update(FamilyhistoryEditRequest $request){

        $id = Input::get('id');
        $name           =Input::get('name');
        $description    =Input::get('description');

        $paramObj = Familyhistory::find($id);
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->familyhistoryRepository->update($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\FamilyhistoryController@index')
                ->withMessage(FormatGenerator::message('Success', 'Family history updated ...'));
        }
        else{
            return redirect()->action('Backend\FamilyhistoryController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Family history did not update ...'));
        }
    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->familyhistoryRepository->delete($id);
        }
        return redirect()->action('Backend\FamilyhistoryController@index')
            ->withMessage(FormatGenerator::message('Success', 'Family history deleted ...'));

    }

}
