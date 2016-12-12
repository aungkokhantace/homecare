<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:19 PM
 */

namespace App\Http\Controllers\Core;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\PermissionEntryRequest;
use App\Backend\Infrastructure\Forms\PermissionEditRequest;
use App\Core\Permission\PermissionRepositoryInterface;
use App\Core\Permission\Permission;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class PermissionController extends Controller
{
    private $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $permissions      = $this->permissionRepository->getObjs();
                return view('core.permission.index')->with('permissions', $permissions);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/permission');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('core.permission.permission');
        }
        return redirect('/');
    }

    public function store(PermissionEntryRequest $request)
    {
        $request->validate();
        $name           = Input::get('name');
        $description    = Input::get('description');
        $module     = Input::get('module');
        $url    = Input::get('url');

        $paramObj = new Permission();
        $paramObj->name = $name;
        $paramObj->module = $module;
        $paramObj->url = $url;
        $paramObj->description = $description;

        $result = $this->permissionRepository->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Core\PermissionController@index')
                ->withMessage(FormatGenerator::message('Success', 'Permission created ...'));
        }
        else{
            return redirect()->action('Core\PermissionController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Permission did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $permission = $this->permissionRepository->getObjByID($id);
            return view('core.permission.permission')->with('permission', $permission);
        }
        return redirect('/');
    }

    public function update(PermissionEditRequest $request){

        $id = Input::get('id');
        $name           =Input::get('name');
        $url            =Input::get('url');
        $module            =Input::get('module');
        $description    =Input::get('description');

        $paramObj = Permission::find($id);
        $paramObj->name = $name;
        $paramObj->module = $module;
        $paramObj->url = $url;
        $paramObj->description = $description;

        $result = $this->permissionRepository->update($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Core\PermissionController@index')
                ->withMessage(FormatGenerator::message('Success', 'Permission updated ...'));
        }
        else{
            return redirect()->action('Core\PermissionController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Permission did not update ...'));
        }
    }

    public function destroy(){

        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->permissionRepository->delete($id);
        }

        return redirect()->action('Core\PermissionController@index')
            ->withMessage(FormatGenerator::message('Success', 'Permission deleted ...'));

    }

}
