<?php
/**
 * Created by PhpStorm.
 * Authhor: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 5:21 PM
 */
namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ServiceEntryRequest;
use App\Backend\Infrastructure\Forms\ServiceEditRequest;
use App\Backend\Service\ServiceRepositoryInterface;
use App\Backend\Service\Service;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class ServiceController extends Controller
{
    private $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $services      = $this->serviceRepository->getObjs();
                return view('backend.service.index')->with('services', $services);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/service');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return redirect('/service');
            return view('backend.service.service');
        }
        return redirect('/');
    }

    public function store(ServiceEntryRequest $request)
    {
        $request->validate();
        $name           = Input::get('name');
        $price          = Input::get('price');
        $description    = Input::get('description');

        $paramObj = new Service();
        $paramObj->name         = $name;
        $paramObj->price        = $price;
        $paramObj->description  = $description;

        $result = $this->serviceRepository->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\ServiceController@index')
                ->withMessage(FormatGenerator::message('Success', 'Service created ...'));
        }
        else{
            return redirect()->action('Backend\ServiceController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Service did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $service = $this->serviceRepository->getObjByID($id);
            return view('backend.service.service')->with('service', $service);
        }
        return redirect('/');
    }

    public function update(ServiceEditRequest $request){

        $id = Input::get('id');
        $name               = Input::get('name');
        $price              = Input::get('price');
        $description        = Input::get('description');

        $paramObj = Service::find($id);
        $old_price = $paramObj->price;

        $paramObj->name         = $name;
        $paramObj->price        = $price;
        $paramObj->description  = $description;

        $result = $this->serviceRepository->update($paramObj,$old_price);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\ServiceController@index')
                ->withMessage(FormatGenerator::message('Success', 'Service updated ...'));
        }
        else{
            return redirect()->action('Backend\ServiceController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Service did not update ...'));
        }
    }

    public function destroy(){
        return redirect('/service');
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->serviceRepository->delete($id);
        }
        return redirect()->action('Backend\ServiceController@index')
            ->withMessage(FormatGenerator::message('Success', 'Service deleted ...'));

    }

}
