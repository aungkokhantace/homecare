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
use App\Backend\Infrastructure\Forms\FamilymemberEntryRequest;
use App\Backend\Infrastructure\Forms\FamilymemberEditRequest;
use App\Backend\Familymember\FamilymemberRepositoryInterface;
use App\Backend\Familymember\Familymember;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class FamilymemberController extends Controller
{
    private $familymemberRepository;

    public function __construct(FamilymemberRepositoryInterface $familymemberRepository)
    {
        $this->familymemberRepository = $familymemberRepository;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $familymembers      = $this->familymemberRepository->getObjs();
                return view('backend.familymember.index')->with('familymembers', $familymembers);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/family member');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('backend.familymember.familymember');
        }
        return redirect('/');
    }

    public function store(FamilymemberEntryRequest $request)
    {
        $prefix = Utility::getTerminalId();
        $table = (new Familymember())->getTable();
        $col = "id";
        $offset = 1;

        $generatedId = Utility::generatedId($prefix,$table,$col,$offset);

        $request->validate();
        $name           = Input::get('name');
        $description    = Input::get('description');

        $paramObj = new Familymember();
        $paramObj->id           = $generatedId;
        $paramObj->name         = $name;
        $paramObj->description  = $description;

        $result = $this->familymemberRepository->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\FamilymemberController@index')
                ->withMessage(FormatGenerator::message('Success', 'Family member created ...'));
        }
        else{
            return redirect()->action('Backend\FamilymemberController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Family member did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $familymember = $this->familymemberRepository->getObjByID($id);
            return view('backend.familymember.familymember')->with('familymember', $familymember);
        }
        return redirect('/');
    }

    public function update(FamilymemberEditRequest $request){

        $id = Input::get('id');
        $name           =Input::get('name');
        $description    =Input::get('description');

        $paramObj = Familymember::find($id);
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->familymemberRepository->update($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\FamilymemberController@index')
                ->withMessage(FormatGenerator::message('Success', 'Family Member updated ...'));
        }
        else{
            return redirect()->action('Backend\FamilymemberController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Family Member did not update ...'));
        }
    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->familymemberRepository->delete($id);
        }
        return redirect()->action('Backend\FamilymemberController@index')
            ->withMessage(FormatGenerator::message('Success', 'Family Member deleted ...'));

    }

}
