<?php namespace App\Http\Controllers\Backend;
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/21/2016
 * Time: 5:12 PM
 */

use App\Backend\Cartypesetup\CartypesetupRepository;
use App\Backend\Cartype\CartypeRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\CartypesetupEntryRequest;
use App\Backend\Infrastructure\Forms\CartypesetupEditRequest;
use App\Backend\Cartypesetup\CartypesetupRepositoryInterface;
use App\Backend\Cartypesetup\Cartypesetup;
use Auth;
use App\Core\Utility;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Backend\Zone\ZoneRepository;

class CartypesetupController extends Controller
{
    private $repo;

    public function __construct(CartypesetupRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $carTypeSetups      = $this->repo->getObjs();
                $carTypeRepo        = new CartypeRepository();
                $carTypes           = $carTypeRepo->getObjs();
                $patientTypes       = Utility::getSettingsByType("PATIENT_TYPE");

                $zoneRepo           = new ZoneRepository();
                $zones              = $zoneRepo->getObjs();

                return view('backend.cartypesetup.index')
                    ->with('carTypeSetups', $carTypeSetups)
                    ->with('patientTypes', $patientTypes)
                    ->with('zones', $zones)
                    ->with('carTypes', $carTypes);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/car type setup');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {

            $carTypeRepo       = new CartypeRepository();
            $carTypes         = $carTypeRepo->getObjs();

            $patientTypes = Utility::getSettingsByType("PATIENT_TYPE");

            $zoneRepo       = new ZoneRepository();
            $zones          = $zoneRepo->getObjs();

            return view('backend.cartypesetup.cartypesetup')
                ->with('patientTypes', $patientTypes)
                ->with('zones', $zones)
                ->with('carTypes', $carTypes);
        }
        return redirect('/');
    }

    public function store(CartypesetupEntryRequest $request)
    {
        $request->validate();
        $car_type_id            = Input::get('car_type_id');
        $remark                 = Input::get('remark');
        $price                  = Input::get('price');
        $patient_type_id        = Input::get('patient_type_id');
        $zone_id                = Input::get('zone_id');

        $paramObj = new Cartypesetup();
        $paramObj->price = $price;
        $paramObj->remark = $remark;
        $paramObj->car_type_id = $car_type_id;
        $paramObj->patient_type_id = $patient_type_id;
        $paramObj->zone_id         = $zone_id;

        $result = $this->repo->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\CartypesetupController@index')
                ->withMessage(FormatGenerator::message('Success', 'Car Type Setup created ...'));
        }
        else{
            return redirect()->action('Backend\CartypesetupController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Car Type Setup did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {

            $carTypeSetup       = $this->repo->getObjByID($id);

            $carTypeRepo        = new CartypeRepository();
            $carTypes           = $carTypeRepo->getObjs();

            $patientTypes       = Utility::getSettingsByType("PATIENT_TYPE");
            $zoneRepo           = new ZoneRepository();
            $zones              = $zoneRepo->getObjs();

            return view('backend.cartypesetup.cartypesetup')
                ->with('carTypeSetup', $carTypeSetup)
                ->with('patientTypes', $patientTypes)
                ->with('carTypes', $carTypes)
                ->with('zones',$zones);
        }
        return redirect('/');
    }

    public function update(CartypesetupEditRequest $request){

        $id = Input::get('id');
        $car_type_id            = Input::get('car_type_id');
        $remark                 = Input::get('remark');
        $price                  = Input::get('price');
        $patient_type_id        = Input::get('patient_type_id');
        $zone_id                = Input::get('zone_id');

        $paramObj = Cartypesetup::find($id);
        $old_price = $paramObj->price;

        $paramObj->price = $price;
        $paramObj->remark = $remark;
        $paramObj->car_type_id = $car_type_id;
        $paramObj->patient_type_id = $patient_type_id;
        $paramObj->zone_id         = $zone_id;

        $result = $this->repo->update($paramObj,$old_price);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\CartypesetupController@index')
                ->withMessage(FormatGenerator::message('Success', 'Car Type Setup updated ...'));
        }
        else{
            return redirect()->action('Backend\CartypesetupController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Car Type Setup did not update ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }

        return redirect()->action('Backend\CartypesetupController@index')
            ->withMessage(FormatGenerator::message('Success', 'Car Type Setup deleted ...'));

    }

}
