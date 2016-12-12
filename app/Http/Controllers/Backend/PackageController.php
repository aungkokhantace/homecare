<?php

namespace App\Http\Controllers\Backend;

use App\Backend\Service\Service;
use App\Backend\Service\ServiceRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Backend\Package\Package;
use App\Backend\Package\PackageRepositoryInterface;
use App\Backend\Infrastructure\Forms\PackageEntryRequest;
use App\Backend\Infrastructure\Forms\PackageEditRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class PackageController extends Controller
{
    private $repo;

    public function __construct(PackageRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $packages      = $this->repo->getObjs();
                $servicesArray = array();
                $packageServicesArray = array();

                foreach($packages as $package){
                    $servicesString = "";
                    $packageServicesArray = "";
                    $package_id = $package->id;
                    $packageDetails = $this->repo->getPackageDetails($package_id);
                    foreach($packageDetails as $packageDetail){
                        $packageServicesArray[] = $packageDetail->service->name;
                    }
                    foreach($packageServicesArray as $service){
                        $servicesString .= $service.', ';
                    }
                    $servicesString = rtrim($servicesString,', ');
                    $servicesArray[$package_id] = $servicesString;
                }
                return view('backend.package.index')->with('package', $packages)->with('servicesArray', $servicesArray);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/package');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            $serviceRepo = new ServiceRepository();
            $services    = $serviceRepo->getObjs();
            return view('backend.package.package')->with('services', $services);
        }
        return redirect('/');
    }

    public function store(PackageEntryRequest $request)
    {
        $request->validate();

        $name           = Input::get('name');
        $services       = Input::get('services');
        $price          = Input::get('price');
        $schedule_no    = Input::get('schedule_no');
        $expiry_date    = Input::get('expiry_date');
        $description    = Input::get('description');

        $paramObj = new Package();
        $paramObj->package_name = $name;
        $paramObj->price        = $price;
        $paramObj->schedule_no  = $schedule_no;
        $paramObj->expiry_date  = $expiry_date;
        $paramObj->description  = $description;

        $result = $this->repo->create($paramObj,$services);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\PackageController@index')
                ->withMessage(FormatGenerator::message('Success', 'Package created ...'));
        }
        else{
            return redirect()->action('Backend\PackageController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Package did not create ...'));
        }

    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $package = $this->repo->getObjByID($id);

            $serviceRepo = new ServiceRepository();
            $services      = $serviceRepo->getObjs();

            return view('backend.package.package')
                ->with('package', $package)
                ->with('services', $services);
        }
        return redirect('/');
    }

    public function update(PackageEditRequest $request){
        $request->validate();

        $id             = Input::get('id');
        $name           = Input::get('name');
        $services       = Input::get('services');
        $price          = Input::get('price');
        $schedule_no    = Input::get('schedule_no');
        $expiry_date    = Input::get('expiry_date');
        $description    = Input::get('description');

        $paramObj = Package::find($id);
        $old_price = $paramObj->price;

        $paramObj->package_name = $name;
        $paramObj->price        = $price;
        $paramObj->schedule_no  = $schedule_no;
        $paramObj->expiry_date  = $expiry_date;
        $paramObj->description  = $description;

        $result = $this->repo->update($paramObj,$services,$old_price);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\PackageController@index')
                ->withMessage(FormatGenerator::message('Success', 'Package updated ...'));
        }
        else{
            return redirect()->action('Backend\PackageController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Package did not update ...'));
        }

    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }
        return redirect()->action('Backend\PackageController@index')
            ->withMessage(FormatGenerator::message('Success', 'Package deleted ...'));
    }
}
