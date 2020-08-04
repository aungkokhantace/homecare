<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:57 AM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\AllergyEntryRequest;
use App\Backend\Infrastructure\Forms\AllergyEditRequest;
use App\Backend\Allergy\AllergyRepositoryInterface;
use App\Backend\Allergy\Allergy;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class AllergyController extends Controller
{
    private $allergyRepository;

    public function __construct(AllergyRepositoryInterface $allergyRepository)
    {
        $this->allergyRepository = $allergyRepository;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $allergies      = $this->allergyRepository->getObjs();
                return view('backend.allergy.index')->with('allergies', $allergies);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/allergy');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('backend.allergy.allergy');
        }
        return redirect('/');
    }

    public function store(AllergyEntryRequest $request)
    {
        $request->validate();
        $name           = Input::get('name');
        $description    = Input::get('description');
        $type    = Input::get('type');

        $paramObj = new Allergy();
        $paramObj->name = $name;
        $paramObj->description = $description;
        $paramObj->type = $type;

        $result = $this->allergyRepository->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\AllergyController@index')
                ->withMessage(FormatGenerator::message('Success', 'Allergy created ...'));
        }
        else{
            return redirect()->action('Backend\AllergyController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Allergy did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $allergy = $this->allergyRepository->getObjByID($id);
            return view('backend.allergy.allergy')->with('allergy', $allergy);
        }
        return redirect('/');
    }

    public function update(AllergyEditRequest $request){

        $id = Input::get('id');
        $name           =Input::get('name');
        $description    =Input::get('description');
        $type    =Input::get('type');

        $paramObj = Allergy::find($id);
        $paramObj->name = $name;
        $paramObj->description = $description;
        $paramObj->type = $type;

        $result = $this->allergyRepository->update($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\AllergyController@index')
                ->withMessage(FormatGenerator::message('Success', 'Allergy updated ...'));
        }
        else{
            return redirect()->action('Backend\AllergyController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Allergy did not update ...'));
        }
    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        $delete_flag = true;
        foreach($new_string as $id){
            $check = $this->allergyRepository->checkToDelete($id);
            if(isset($check) && count($check)>0){
                alert()->warning('There are patients who have this allergy_id = '.$id)->persistent('OK');
                $delete_flag = false;
            }
            else{
                $this->allergyRepository->delete($id);
            }
        }
        if($delete_flag){
            return redirect()->action('Backend\AllergyController@index')
                ->withMessage(FormatGenerator::message('Success', 'Allergy deleted ...'));
        }
        else{
            return redirect()->action('Backend\AllergyController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Allergy did not delete ...'));
        }
    }
}
