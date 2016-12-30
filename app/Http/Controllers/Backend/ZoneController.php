<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 5:52 PM
 */

namespace App\Http\Controllers\Backend;

use App\Backend\Township\TownshipRepository;
use App\Backend\Zone\ZoneRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ZoneEntryRequest;
use App\Backend\Infrastructure\Forms\ZoneEditRequest;
use App\Backend\Zone\ZoneRepositoryInterface;
use App\Backend\Zone\Zone;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class ZoneController extends Controller
{
    private $repo;

    public function __construct(ZoneRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $zones      = $this->repo->getObjs();
                return view('backend.zone.index')->with('zones', $zones);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/zone');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            $townshipsAlreadyInZones = $this->repo->getUsedTownships();
            $townshipsArray = array();
            foreach($townshipsAlreadyInZones as $township){
                array_push($townshipsArray,$township->township_id);
            }

            $townshipRepo = new TownshipRepository();
            $townships = $townshipRepo->getTownshipsForZone($townshipsArray);
            return view('backend.zone.zone')->with('townships', $townships);
        }
        return redirect('/');
    }

    public function store(ZoneEntryRequest $request)
    {
        $request->validate();
        $name           = Input::get('name');
        $townships      = Input::get('townships');
        $description    = Input::get('description');

        $paramObj = new Zone();
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->repo->create($paramObj,$townships);
        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\ZoneController@index')
                ->withMessage(FormatGenerator::message('Success', 'Zone created ...'));
        }
        else{
            return redirect()->action('Backend\ZoneController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Zone did not create ...'));
        }

    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
//            $zone = $this->repo->getObjByID($id);
            $zone = $this->repo->getObjByIDForEdit($id);

            $townshipsAlreadyInOtherZones = $this->repo->getUsedTownshipsInOtherZones($zone->id);
            $townshipsArray = array();
            foreach($townshipsAlreadyInOtherZones as $township){
                array_push($townshipsArray,$township->township_id);
            }
            $townshipRepo = new TownshipRepository();
            $townships = $townshipRepo->getTownshipsForZone($townshipsArray);

            return view('backend.zone.zone')
                ->with('zone', $zone)
                ->with('townships', $townships);
        }
        return redirect('/');
    }

    public function update(ZoneEditRequest $request){

        $id = Input::get('id');
        $name           = Input::get('name');
        $description    = Input::get('description');
        $townships      = Input::get('townships');

        $paramObj = Zone::find($id);
        $paramObj->name         = $name;
        $paramObj->description  = $description;

        $result = $this->repo->update($paramObj,$townships);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\ZoneController@index')
                ->withMessage(FormatGenerator::message('Success', 'Zone updated ...'));
        }
        else{
            return redirect()->action('Backend\ZoneController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Zone did not update ...'));
        }

    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        $delete_flag = true;
        foreach($new_string as $id){
            $check = $this->repo->checkToDelete($id);
            if(isset($check) && count($check)>0){
                alert()->warning('There are car_type_setups with this zone_id = '.$id)->persistent('OK');
                $delete_flag = false;
            }
            else{
                $this->repo->delete($id);
            }
        }

        if($delete_flag){
            return redirect()->action('Backend\ZoneController@index')
                ->withMessage(FormatGenerator::message('Success', 'Zones deleted ...'));
        }
        else{
            return redirect()->action('Backend\ZoneController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Zone did not delete ...'));
        }
    }
}
