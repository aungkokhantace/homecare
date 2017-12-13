<?php
namespace App\Http\Controllers\Core;

use App\Backend\Infrastructure\Forms\UserEditFormRequest;
use App\Backend\Infrastructure\Forms\UserEntryFormRequest;
use App\Core\Role\Role;
use App\Core\Permission\Permission;
use App\Core\Utility;
use App\Log\LogCustom;
use App\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Core\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use Log;

class UserController extends Controller
{
    private
        $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('right');
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                //if (Auth::guard('User')->user()->role_id == 1) {
                $users      = $this->userRepository->getUsers();
                $roles      = $this->userRepository->getRoles();
                $cur_time   = Carbon::now();
                //Log::info('TESTING LOG');
                foreach($users as $user){
                    if($user->active == 1){
                        $user->status = "Active";
                    }
                    else{
                        $user->status = "Inactive";
                    }
                }
                return view('core.user.index')->with('users', $users)->with('roles', $roles)->with('cur_time',$cur_time);
                //}
            }
            return redirect('/login');
        }
        catch(\Exception $e){
            return redirect('/error/204/staff');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            $roles = $this->userRepository->getRoles();
            $currentRole = Utility::getCurrentUser();
            $superAdmin = false;
            $admin = false;
            $normalUser = false;
            if($currentRole == 1){
                $superAdmin = true;
            }
            elseif($currentRole == 2){
                $admin = true;
            }
            else{
                $normalUser = true;
            }
            return view('core.user.user')
                ->with('roles', $roles)
                ->with('superAdmin',$superAdmin)
                ->with('admin',$admin)
                ->with('normalUser',$normalUser);
        }
         return redirect('/login');
    }

    public function store(UserEntryFormRequest $request)
    {
        $prefix             = Utility::getTerminalId();
        $table              = (new User())->getTable();
        $col                = "id";
        $offset             = 1;
        $generatedId        = Utility::generatedId($prefix,$table,$col,$offset);
        $request->validate();
        $name               = trim(Input::get('name'));

        //Start Saving Image
        $removeImageFlag    = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;

        $path               = base_path().'/public/images/users/';

        if(Input::hasFile('photo'))
        {
            $photo          = Input::file('photo');
            $imagedata      = file_get_contents($photo);
            $mobile_image   = base64_encode($imagedata);
            $photo_ext      = Utility::getImageExt($photo);
            $photo_name     = uniqid() . "." . $photo_ext;
            $image          = Utility::resizeImage($photo,$photo_name,$path);
        }
        else{
            $photo_name     = "";
            $mobile_image   = "";
        }

        if($removeImageFlag == 1){
            $photo_name     = "";
        }
        //End Saving Image
        $phone              = trim(Input::get('phone'));
        $email              = trim(Input::get('email'));
        //$password   = trim(bcrypt(Input::get('password')));// laravel framework default password encrypting method.
        $password           = base64_encode(Input::get('password'));
        $roleId             = Input::get('role_id');
        $fees               = Input::get('fees');
        $temp_doctor_license_number = Input::get('doctor_license_number');
        $doctor_license_number = 'SAMA-'.$temp_doctor_license_number; //bind sama prefix
        $address            = trim(Input::get('address'));

        $userObj            = new User();
        $userObj->id        = $generatedId;
        $userObj->name = $name;
        if(isset($photo)){
            $userObj->display_image = $photo_name;
            $userObj->mobile_image  = $mobile_image;
        }
        $userObj->phone     = $phone;
        $userObj->email     = $email;
        $userObj->password  = $password;
        $userObj->role_id   = $roleId;
        $userObj->fees      = $fees;
        $userObj->doctor_license_number      = $doctor_license_number;
        $userObj->address   = $address;

        $result = $this->userRepository->create($userObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            $created_id = $result['staff']->id;
            alert()->success('Staff successfully created with ID '.$created_id)->persistent('OK');
            return redirect()->action('Core\UserController@index');
        }
        else{
            return redirect()->action('Core\UserController@index')
                ->withMessage(FormatGenerator::message('Fail', 'User did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
                $user = $this->userRepository->getObjByID($id);
                $roles = $this->userRepository->getRoles();
                $currentRole = Utility::getCurrentUser();
                $superAdmin = false;
                $admin = false;
                $normalUser = false;
                if($currentRole == 1){
                    $superAdmin = true;
                }
                elseif($currentRole == 2){
                    $admin = true;
                }
                else{
                    $normalUser = true;
                }

                //remove sama prefix to show in edit form
                $user->doctor_license_number = ltrim($user->doctor_license_number,"SAMA-");

                return view('core.user.user')
                    ->with('user', $user)
                    ->with('roles', $roles)
                    ->with('superAdmin',$superAdmin)
                    ->with('admin',$admin)
                    ->with('normalUser',$normalUser);
        }
        return redirect('/login');
    }

    public function update(UserEditFormRequest $request){
        $request->validate();
        $id         = Input::get('id');
        $name       = Input::get('name');
        $path       = base_path().'/public/images/users/';

        //Start Saving Image
        $removeImageFlag          = (Input::has('removeImageFlag')) ? Input::get('removeImageFlag') : 0;
        $old_data                 = User::find($id);
        if(Input::hasFile('photo'))
        {
            $photo          = Input::file('photo');
            $imagedata      = file_get_contents($photo);
            $mobile_image   = base64_encode($imagedata);
            $photo_ext      = Utility::getImageExt($photo);
            $photo_name     = uniqid() . "." . $photo_ext;
            $image          = Utility::resizeImage($photo,$photo_name,$path);

        }
        elseif(isset($old_data) && $old_data->display_image != ""){
            $photo_name     = $old_data->display_image;
            $mobile_image   = $old_data->mobile_image;
        }
        else{
            $photo_name     = "";
            $mobile_image   = "";
        }

        if($removeImageFlag == 1){
            $photo_name     = "";
            $mobile_image   = null;
        }
        //End Saving Image
        $phone              = Input::get('phone');
        $email              = Input::get('email');
        $address            = Input::get('address');
        $roleId             = Input::get('role_id');
        if(isset($roleId) && $roleId == 7){
            $fees           = Input::get('fees');
        }
        if(isset($roleId) && ($roleId == 6 || $roleId == 7)){
          $temp_doctor_license_number = Input::get('doctor_license_number');
          $doctor_license_number = 'SAMA-'.$temp_doctor_license_number; //bind sama prefix
        }
        // else{
        //     $fees           = null;
        // }

        $userObj            = User::find($id);
        $userObj->name      = $name;
        $userObj->phone     = $phone;
        $userObj->email     = $email;
        $userObj->role_id   = $roleId;
        if(isset($roleId) && $roleId == 7){
          $userObj->fees      = $fees;
        }
        if(isset($roleId) && ($roleId == 6 || $roleId == 7)){
          $userObj->doctor_license_number      = $doctor_license_number;
        }
        $userObj->address   = $address;
        $password           = Input::get('password');

        $existingUserImage = $userObj->display_image;
        $userObj->display_image = $photo_name;
        $userObj->mobile_image = $mobile_image;

        if(isset($password) && $password != ""){
            //$pwd = trim(bcrypt(Input::get('password')));// laravel framework default password encrypting method.
            $pwd    = base64_encode(Input::get('password'));
            $userObj->password = $pwd;
        }

        $result = $this->userRepository->update($userObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){

            if($removeImageFlag == 1){
                Utility::deleteImage($path . $existingUserImage);
            }

            if(isset($photo)){
                Utility::deleteImage($path . $existingUserImage);
            }

            return redirect()->action('Core\UserController@index')
                ->withMessage(FormatGenerator::message('Success', 'User updated ...'));
        }
        else{
            return redirect()->action('Core\UserController@index')
                ->withMessage(FormatGenerator::message('Fail', 'User did not update ...'));
        }
    }

    public function profile($id){
        if (Auth::guard('User')->check()) {
            $userSession = session('user');
            $loginUserId = $userSession['id'];

            if($id == $loginUserId){
                $user = $this->userRepository->getObjByID($id);
                $roles = DB::table('core_roles')->get();
                $currentRole = Utility::getCurrentUser();
                $superAdmin = false;
                $admin = false;
                $normalUser = false;
                if($currentRole == 1){
                    $superAdmin = true;
                }
                elseif($currentRole == 2){
                    $admin = true;
                }
                else{
                    $normalUser = true;
                }

                return view('core.user.user')
                    ->with('user', $user)
                    ->with('roles', $roles)
                    ->with('profile',true)
                    ->with('superAdmin',$superAdmin)
                    ->with('admin',$admin)
                    ->with('normalUser',$normalUser);
            }
            else{
                return redirect('errors/504');
            }

        }
        else{
            return redirect('unauthorize');
        }
    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->userRepository->delete_users($id);
        }
        return redirect()->action('Core\UserController@index')
            ->withMessage(FormatGenerator::message('Success', 'User deleted ...'));

    }

    public function getAuthUser() //after login, update active field 0 to 1
    {
        if (Auth::guard('User')->check()) {
            $id         = Auth::guard('User')->user()->id;
            $cur        = Carbon::now();
            $to         = Carbon::createFromFormat('Y-m-d H:i:s', $cur);
            $this->userRepository->changeDisableToEnable($id, $cur);
            $role       = DB::table('core_users')->find($id);
            if ($role->role_id == 1) {
                return redirect('/');
            }
            else if ($role->role_id == 5) {
                return redirect('patient/dashboard');
            }
            else if ($role->role_id == 2) {
                return redirect('/');
            }
            else {
                return redirect('/');
            }
        }
    }

    public function disable(){
        if (Auth::guard('User')->check()) {
            $id = Input::get('selected_checkboxes');
            $new_string = explode(',', $id);
            foreach ($new_string as $id) {
                $this->userRepository->disable_user($id);
            }
            return redirect()->action('Core\UserController@index')
                ->withMessage(FormatGenerator::message('Success', 'User disabled ...'));
        }
        return redirect('/');
    }

    public function enable(){
        if (Auth::guard('User')->check()) {
            $id = Input::get('enable_user_id');

            $this->userRepository->enable_user($id);

            return redirect()->action('Core\UserController@index')
                ->withMessage(FormatGenerator::message('Success', 'User enabled ...'));
        }
        return redirect('/');
    }
}
