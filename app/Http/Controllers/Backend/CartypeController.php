<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:09 PM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\CartypeEntryRequest;
use App\Backend\Infrastructure\Forms\CartypeEditRequest;
use App\Backend\Cartype\CartypeRepositoryInterface;
use App\Backend\Cartype\Cartype;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class CartypeController extends Controller
{
    private $repo;

    public function __construct(CartypeRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $carTypes      = $this->repo->getObjs();
                return view('backend.cartype.index')->with('carTypes', $carTypes);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/car type');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('backend.cartype.cartype');
        }
        return redirect('/');
    }

    public function store(CartypeEntryRequest $request)
    {
        $request->validate();
        $name           = Input::get('name');
        $description    = Input::get('description');

        $paramObj = new Cartype();
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->repo->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\CartypeController@index')
                ->withMessage(FormatGenerator::message('Success', 'Car Type created ...'));
        }
        else{
            return redirect()->action('Backend\CartypeController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Car Type did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $carType = $this->repo->getObjByID($id);
            return view('backend.cartype.cartype')->with('carType', $carType);
        }
        return redirect('/');
    }

    public function update(CartypeEditRequest $request){

        $id = Input::get('id');
        $name           =Input::get('name');
        $description    =Input::get('description');

        $paramObj = Cartype::find($id);
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->repo->update($paramObj);
        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\CartypeController@index')
                ->withMessage(FormatGenerator::message('Success', 'Car Type updated ...'));
        }
        else{
            return redirect()->action('Backend\CartypeController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Car Type did not update ...'));
        }

    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }

        return redirect()->action('Backend\CartypeController@index')
            ->withMessage(FormatGenerator::message('Success', 'Car Type deleted ...'));

    }

}
