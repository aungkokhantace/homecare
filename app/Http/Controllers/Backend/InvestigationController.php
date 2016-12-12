<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Backend\Investigation\Investigation;
use App\Backend\Investigation\InvestigationRepositoryInterface;
use App\Backend\Infrastructure\Forms\InvestigationEntryRequest;
use App\Backend\Infrastructure\Forms\InvestigationEditRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class InvestigationController extends Controller
{
    private $repo;

    public function __construct(InvestigationRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if (Auth::guard('User')->check()) {
            $investigation      = $this->repo->getObjs();
            return view('backend.investigation.index')->with('investigation', $investigation);
        }
        return redirect('/');
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('backend.investigation.investigation');
        }
        return redirect('/');
    }

    public function store(InvestigationEntryRequest $request)
    {
        $request->validate();
        $name                 = Input::get('name');
        $description          = Input::get('description');
        $group_name           = Input::get('group_name');
        $price                = Input::get('price');

        $paramObj = new Investigation();
        $paramObj->name = $name;
        $paramObj->description = $description;
        $paramObj->group_name = $group_name;
        $paramObj->price = $price;

        $result = $this->repo->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\InvestigationController@index')
                ->withMessage(FormatGenerator::message('Success', 'Investigation created ...'));
        }
        else{
            return redirect()->action('Backend\InvestigationController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Investigation did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $investigation = $this->repo->getObjByID($id);
            return view('backend.investigation.investigation')->with('investigation', $investigation);
        }
        return redirect('/');
    }

    public function update(InvestigationEditRequest $request){
        $request->validate();
        $id = Input::get('id');
        $name                 = Input::get('name');
        $description          = Input::get('description');
        $group_name           = Input::get('group_name');
        $price                = Input::get('price');

        $paramObj = Investigation::find($id);
        $old_price = $paramObj->price;

        $paramObj->name = $name;
        $paramObj->description = $description;
        $paramObj->group_name = $group_name;
        $paramObj->price = $price;

        $result = $this->repo->update($paramObj,$old_price);
        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\InvestigationController@index')
                ->withMessage(FormatGenerator::message('Success', 'Investigation updated ...'));
        }
        else{
            return redirect()->action('Backend\InvestigationController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Investigation did not update ...'));
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
