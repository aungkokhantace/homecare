<?php

namespace App\Http\Controllers\Backend;

use App\Backend\InvestigationImaging\InvestigationImaging;
use App\Backend\InvestigationImaging\InvestigationImagingRepositoryInterface;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Backend\Investigation\Investigation;
use App\Backend\Infrastructure\Forms\InvestigationImagingEntryRequest;
use App\Backend\Infrastructure\Forms\InvestigationImagingEditRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class InvestigationImagingController extends Controller
{
    private $repo;

    public function __construct(InvestigationImagingRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if (Auth::guard('User')->check()) {
            $investigationImagings      = $this->repo->getObjs();
            return view('backend.investigationimaging.index')->with('investigationImagings', $investigationImagings);
        }
        return redirect('/');
    }

//    public function create(){
//        if (Auth::guard('User')->check()) {
//            return view('backend.investigationimaging.investigationimaging');
//        }
//        return redirect('/');
//    }
//
//    public function store(InvestigationImagingEntryRequest $request)
//    {
//        $request->validate();
//        $name                 = Input::get('name');
//        $description          = Input::get('description');
//        $group_name           = Input::get('group_name');
//        $price                = Input::get('price');
//
//        $paramObj = new Investigation();
//        $paramObj->name = $name;
//        $paramObj->description = $description;
//        $paramObj->group_name = $group_name;
//        $paramObj->price = $price;
//
//        $result = $this->repo->create($paramObj);
//
//        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
//            return redirect()->action('Backend\InvestigationController@index')
//                ->withMessage(FormatGenerator::message('Success', 'Investigation created ...'));
//        }
//        else{
//            return redirect()->action('Backend\InvestigationController@index')
//                ->withMessage(FormatGenerator::message('Fail', 'Investigation did not create ...'));
//        }
//    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $investigationImaging = $this->repo->getObjByID($id);
            return view('backend.investigationImaging.investigationimaging')->with('investigationImaging', $investigationImaging);
        }
        return redirect('/');
    }

    public function update(InvestigationImagingEditRequest $request){
        $request->validate();
        $id = Input::get('id');
        $service_name         = Input::get('service_name');
        $group_name           = Input::get('group_name');
        $service_charges      = Input::get('service_charges');

        $paramObj = InvestigationImaging::find($id);
        $old_price = $paramObj->service_charges;

        $paramObj->service_name       = $service_name;
        $paramObj->group_name = $group_name;
        $paramObj->service_charges      = $service_charges;
        $result = $this->repo->update($paramObj,$old_price);
        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\InvestigationImagingController@index')
                ->withMessage(FormatGenerator::message('Success', 'Investigation Imaging updated ...'));
        }
        else{
            return redirect()->action('Backend\InvestigationImagingController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Investigation Imaging did not update ...'));
        }

    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }

        return redirect()->action('Backend\InvestigationController@index')
            ->withMessage(FormatGenerator::message('Success', 'Investigation deleted ...'));

    }
}
