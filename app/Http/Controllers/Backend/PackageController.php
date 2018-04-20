<?php

namespace App\Http\Controllers\Backend;

use App\Backend\Service\Service;
use App\Backend\Service\ServiceRepository;
use App\Core\Utility;
use App\Log\LogCustom;
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
                    // $packageServicesArray = "";
                    $packageServicesArray = array();
                    $package_id = $package->id;
                    $packageDetails = $this->repo->getPackageDetails($package_id);
                    foreach($packageDetails as $packageDetail){
                        // $packageServicesArray[] = $packageDetail->service->name;
                        $packageServicesArray[] = $packageDetail->service->name;
                        // array_push($packageServicesArray,$packageDetail->service->name);
                    }
                    foreach($packageServicesArray as $service){
                        $servicesString .= $service.', ';
                    }
                    $servicesString = rtrim($servicesString,', ');
                    $servicesArray[$package_id] = $servicesString;
                }

                foreach($packages as $packageInclusiveTransportCharge){
                    if($packageInclusiveTransportCharge->inclusive_transport_charge == 1){
                        $packageInclusiveTransportCharge->inclusive_transport_charge = "Yes";
                    }
                    else{
                        $packageInclusiveTransportCharge->inclusive_transport_charge = "No";
                    }
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

        $name                       = Input::get('name');
        $services                   = Input::get('services');
        $price                      = Input::get('price');
        $schedule_no                = Input::get('schedule_no');
        $expiry_date                = Input::get('expiry_date');
        $inclusive_transport_charge = (Input::has('inclusive_transport_charge')) ? 1 : 0;
        $description                = Input::get('description');


        $paramObj = new Package();
        $paramObj->package_name                     = $name;
        $paramObj->price                            = $price;
        $paramObj->schedule_no                      = $schedule_no;
        $paramObj->expiry_date                      = $expiry_date;
        $paramObj->inclusive_transport_charge      = $inclusive_transport_charge;
        $paramObj->description                      = $description;

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

        $id                         = Input::get('id');
        $name                       = Input::get('name');
        $services                   = Input::get('services');
        $price                      = Input::get('price');
        $schedule_no                = Input::get('schedule_no');
        $expiry_date                = Input::get('expiry_date');
        $inclusive_transport_charge = (Input::has('inclusive_transport_charge')) ? 1 : 0;
        $description                = Input::get('description');

        $paramObj = Package::find($id);
        $old_price = $paramObj->price;

        $paramObj->package_name                 = $name;
        $paramObj->price                        = $price;
        $paramObj->schedule_no                  = $schedule_no;
        $paramObj->expiry_date                  = $expiry_date;
        $paramObj->inclusive_transport_charge   = $inclusive_transport_charge;
        $paramObj->description                  = $description;

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

    public function editPromotion($id){
        if (Auth::guard('User')->check()) {
            $package = $this->repo->getObjByID($id);

            //check whether package has already promotions //if no, create function //if yes, update function
            $promotions = $this->repo->getPromotions($id);

            //if there are any promotions, prepare for edit form
            if(isset($promotions) && count($promotions)>0){
                foreach($promotions as $promotion){
                    //get second time price
                    if($promotion->promotion_order == 2){
                        $second_time_price = $this->repo->getPromotionPrice($promotion->package_id,$promotion->promotion_order);
                    }
                    //get third time price
                    elseif($promotion->promotion_order == 3){
                        $third_time_price = $this->repo->getPromotionPrice($promotion->package_id,$promotion->promotion_order);
                    }
                }
            }
            //if there is no promotion, prepare for create form
            else{
                $second_time_price = 0;
                $third_time_price = 0;
            }
            return view('backend.packagepromotion.packagepromotion')
                ->with('package',$package)
                ->with('promotions',$promotions)
                ->with('second_time_price',$second_time_price)
                ->with('third_time_price',$third_time_price);
        }
        return redirect('/');
    }

    public function createPromotion(){
        if (Auth::guard('User')->check()) {
            try{
                $currentUser = Utility::getCurrentUserID(); //get currently logged in user

                $package_id         = Input::get('id');
                $first_time_price   = Input::get('first_time_price');
                $second_time_price  = Input::get('second_time_price');
                $third_time_price   = Input::get('third_time_price');

//                DB::table('package_promotions')->insert([
//                    ['package_id' => $package_id, 'price' => $first_time_price, 'promotion_order' => 1],
//                    ['package_id' => $package_id, 'price' => $second_time_price, 'promotion_order' => 2],
//                    ['package_id' => $package_id, 'price' => $third_time_price, 'promotion_order' => 3],
//                ]);

                $firstTimeId = DB::table('package_promotions')->insertGetId(
                    ['package_id' => $package_id, 'price' => $first_time_price, 'promotion_order' => 1]
                );

                $secondTimeId = DB::table('package_promotions')->insertGetId(
                    ['package_id' => $package_id, 'price' => $second_time_price, 'promotion_order' => 2]
                );

                $thirdTimeId = DB::table('package_promotions')->insertGetId(
                    ['package_id' => $package_id, 'price' => $third_time_price, 'promotion_order' => 3]
                );

                $date = date('Y-m-d H:i:s');   //get current timestamp

                //save price tracking
                //parameters ($table_name,$table_id,$table_id_type,$action,$old_price,$new_price,$created_by,$created_at)
                Utility::savePriceTracking('package_promotions',$firstTimeId,'integer(first_time_price)','create',0.00,$first_time_price,$currentUser,$date);
                Utility::savePriceTracking('package_promotions',$secondTimeId,'integer(second_time_price)','create',0.00,$second_time_price,$currentUser,$date);
                Utility::savePriceTracking('package_promotions',$thirdTimeId,'integer(third_time_price)','create',0.00,$third_time_price,$currentUser,$date);

                //create info log
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' created promotions for package_id = '.$package_id . PHP_EOL;
                LogCustom::create($date,$message);

                return redirect()->action('Backend\PackageController@index')
                    ->withMessage(FormatGenerator::message('Success', 'Package Promotion created ...'));
            }
            catch(\Exception $e){
                //create error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' created a package promotion and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
                LogCustom::create($date,$message);

                return redirect()->action('Backend\PackageController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Package Promotion did not update ...'));
            }

        }
        return redirect('/');
    }

    public function updatePromotion(){
        if (Auth::guard('User')->check()) {
            try{
                $currentUser = Utility::getCurrentUserID(); //get currently logged in user

                $package_id         = Input::get('id');
                $first_time_price   = Input::get('first_time_price');
                $second_time_price  = Input::get('second_time_price');
                $third_time_price   = Input::get('third_time_price');

                //start getting ids of updated rows
                $firstTimeId = DB::table('package_promotions')
                    ->where('package_id', $package_id)
                    ->where('promotion_order', 1) //first_time
                    ->value('id');

                $secondTimeId = DB::table('package_promotions')
                    ->where('package_id', $package_id)
                    ->where('promotion_order', 2) //second_time
                    ->value('id');

                $thirdTimeId = DB::table('package_promotions')
                    ->where('package_id', $package_id)
                    ->where('promotion_order', 3) //third_time
                    ->value('id');
                //end getting ids of updated rows

                //start getting old prices
                $old_first_time_price = DB::table('package_promotions')
                    ->where('package_id', $package_id)
                    ->where('promotion_order', 1) //first_time
                    ->value('price');

                $old_second_time_price = DB::table('package_promotions')
                    ->where('package_id', $package_id)
                    ->where('promotion_order', 2) //second_time
                    ->value('price');

                $old_third_time_price = DB::table('package_promotions')
                    ->where('package_id', $package_id)
                    ->where('promotion_order', 3) //third_time
                    ->value('price');
                //end getting old prices

                //update first_time_price
                DB::table('package_promotions')
                    ->where('package_id', $package_id)
                    ->where('promotion_order', 1) //first_time
                    ->update(['price' => $first_time_price]);

                //update second_time_price
                DB::table('package_promotions')
                    ->where('package_id', $package_id)
                    ->where('promotion_order', 2) //second_time
                    ->update(['price' => $second_time_price]);

                //update third_time_price
                DB::table('package_promotions')
                    ->where('package_id', $package_id)
                    ->where('promotion_order', 3) //third_time
                    ->update(['price' => $third_time_price]);

                $date = date('Y-m-d H:i:s'); //get current timestamp

                //save price tracking
                //parameters ($table_name,$table_id,$table_id_type,$action,$old_price,$new_price,$created_by,$created_at)
                Utility::savePriceTracking('package_promotions',$firstTimeId,'integer(first_time_price)','update',$old_first_time_price,$first_time_price,$currentUser,$date);
                Utility::savePriceTracking('package_promotions',$secondTimeId,'integer(second_time_price)','update',$old_second_time_price,$second_time_price,$currentUser,$date);
                Utility::savePriceTracking('package_promotions',$thirdTimeId,'integer(third_time_price)','update',$old_third_time_price,$third_time_price,$currentUser,$date);

                //create info log
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated promotions for package_id = '.$package_id . PHP_EOL;
                LogCustom::create($date,$message);

                return redirect()->action('Backend\PackageController@index')
                    ->withMessage(FormatGenerator::message('Success', 'Package Promotion updated ...'));
            }
            catch(\Exception $e){
                //create error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated promotions for package_id = '.$package_id.' and got error -------'.$e->getMessage(). ' ----- line ' .$e->getLine(). ' ----- ' .$e->getFile(). PHP_EOL;
                LogCustom::create($date,$message);

                return redirect()->action('Backend\PackageController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Package Promotion did not update ...'));
            }

        }
        return redirect('/');
    }
}
