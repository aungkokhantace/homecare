<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 11:33 AM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\CityEntryRequest;
use App\Backend\Infrastructure\Forms\CityEditRequest;
use App\Backend\City\CityRepositoryInterface;
use App\Backend\City\City;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class CityController extends Controller
{
    private $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $cities      = $this->cityRepository->getObjs();
                return view('backend.city.index')->with('cities', $cities);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/city');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('backend.city.city');
        }
        return redirect('/');
    }

    public function store(CityEntryRequest $request)
    {
        $request->validate();
        $name           = Input::get('name');
        $description    = Input::get('description');

        $paramObj = new City();
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->cityRepository->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\CityController@index')
                ->withMessage(FormatGenerator::message('Success', 'City created ...'));
        }
        else{
            return redirect()->action('Backend\CityController@index')
                ->withMessage(FormatGenerator::message('Fail', 'City did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $city = $this->cityRepository->getObjByID($id);
            return view('backend.city.city')->with('city', $city);
            }
        return redirect('/');
    }

    public function update(CityEditRequest $request){

        $id = Input::get('id');
        $name           =Input::get('name');
        $description    =Input::get('description');

        $paramObj = City::find($id);
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->cityRepository->update($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\CityController@index')
                ->withMessage(FormatGenerator::message('Success', 'City updated ...'));
        }
        else{
            return redirect()->action('Backend\CityController@index')
                ->withMessage(FormatGenerator::message('Fail', 'City did not update ...'));
        }
    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->cityRepository->delete($id);
        }
        return redirect()->action('Backend\CityController@index')
            ->withMessage(FormatGenerator::message('Success', 'City deleted ...'));

    }

}
