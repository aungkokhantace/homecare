<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 10/6/2016
 * Time: 5:56 PM
 */


namespace App\Http\Controllers\Backend;

use App\Backend\Route\RouteRepository;
use App\Core\Utility;
use Illuminate\Http\Request;

use App\Backend\Route\Route;
use App\Backend\Route\RouteRepositoryInterface;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\RouteEntryRequest;
use App\Backend\Infrastructure\Forms\RouteEditRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class RouteController extends Controller
{
    private $repo;

    public function __construct(RouteRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $route      = $this->repo->getObjs();
                return view('backend.route.index')->with('route', $route);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/route');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            $categoryRepo = new RouteRepository();
            return view('backend.route.route');
        }
        return redirect('/');
    }

    public function store(RouteEntryRequest $request)
    {
        $prefix = Utility::getTerminalId();
        $table = (new Route())->getTable();
        $col = "id";
        $offset = 1;

        $generatedId = Utility::generatedId($prefix,$table,$col,$offset);

        $request->validate();
        $name                = Input::get('name');
        $description         = Input::get('description');
        $paramObj = new Route();
        $paramObj->id = $generatedId;
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->repo->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\RouteController@index')
                ->withMessage(FormatGenerator::message('Success', 'Route created ...'));
        }
        else{
            return redirect()->action('Backend\RouteController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Route did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $route = $this->repo->getObjByID($id);
            $categoryRepo = new RouteRepository();
            $categories      = $categoryRepo->getObjs();
            return view('backend.route.route')->with('route', $route);
        }
        return redirect('/');
    }

    public function update(RouteEditRequest $request){
        $request->validate();

        $id = Input::get('id');
        $name                 = Input::get('name');
        $description          = Input::get('description');

        $paramObj = Route::find($id);

        $paramObj->name        = $name;
        $paramObj->description         = $description;

        $result = $this->repo->update($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\RouteController@index')
                ->withMessage(FormatGenerator::message('Success', 'Route updated ...'));
        }
        else{
            return redirect()->action('Backend\RouteController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Route did not update ...'));
        }

    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }

        return redirect()->action('Backend\RouteController@index')
            ->withMessage(FormatGenerator::message('Success', 'Route deleted ...'));

    }
}
