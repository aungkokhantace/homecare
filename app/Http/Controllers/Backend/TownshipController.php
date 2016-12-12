<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/15/2016
 * Time: 1:56 PM
 */
namespace App\Http\Controllers\Backend;

use App\Backend\City\CityRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\TownshipEntryRequest;
use App\Backend\Infrastructure\Forms\TownshipEditRequest;
use App\Backend\Township\TownshipRepositoryInterface;
use App\Backend\Township\Township;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class TownshipController extends Controller
{
    private $repo;

    public function __construct(TownshipRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $townships      = $this->repo->getObjs();
                $cityRepo       = new CityRepository();
                $cities         = $cityRepo->getObjs();
                return view('backend.township.index')
                    ->with('townships', $townships)
                    ->with('cities', $cities);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/township');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            $cityRepo = new CityRepository();
            $cities      = $cityRepo->getObjs();
            return view('backend.township.township')->with('cities', $cities);
        }
        return redirect('/');
    }

    public function store(TownshipEntryRequest $request)
    {
        $request->validate();
        $name           = Input::get('name');
        $remark    = Input::get('remark');
        $city_id    = Input::get('city_id');

        $paramObj = new Township();
        $paramObj->name = $name;
        $paramObj->remark = $remark;
        $paramObj->city_id = $city_id;

        $result = $this->repo->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\TownshipController@index')
                ->withMessage(FormatGenerator::message('Success', 'Township created ...'));
        }
        else{
            return redirect()->action('Backend\TownshipController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Township did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $township = $this->repo->getObjByID($id);
            $cityRepo       = new CityRepository();
            $cities         = $cityRepo->getObjs();
            return view('backend.township.township')
                ->with('township', $township)
                ->with('cities', $cities);
        }
        return redirect('/');
    }

    public function update(TownshipEditRequest $request){

        $id = Input::get('id');
        $name           = Input::get('name');
        $remark         = Input::get('remark');
        $city_id         = Input::get('city_id');

        $paramObj = Township::find($id);
        $paramObj->name = $name;
        $paramObj->remark = $remark;
        $paramObj->city_id = $city_id;

        $result = $this->repo->update($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\TownshipController@index')
                ->withMessage(FormatGenerator::message('Success', 'Township updated ...'));
        }
        else{
            return redirect()->action('Backend\TownshipController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Township did not update ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }

        return redirect()->action('Backend\TownshipController@index')
            ->withMessage(FormatGenerator::message('Success', 'Township deleted ...'));

    }

}
