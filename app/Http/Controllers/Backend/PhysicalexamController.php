<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Backend\Physicalexam\Physicalexam;
use App\Backend\Physicalexam\PhysicalexamRepositoryInterface;
use App\Backend\Infrastructure\Forms\PhysicalexamEntryRequest;
use App\Backend\Infrastructure\Forms\PhysicalexamEditRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class PhysicalexamController extends Controller
{
    private $repo;

    public function __construct(PhysicalexamRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        if (Auth::guard('User')->check()) {
            $physicalExam      = $this->repo->getObjs();
            return view('backend.physicalexam.index')->with('physicalExam', $physicalExam);
        }
        return redirect('/');
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('backend.physicalexam.physicalexam');
        }
        return redirect('/');
    }

    public function store(PhysicalexamEntryRequest $request)
    {
        $request->validate();
        $name                 = Input::get('name');
        $type                 = Input::get('type');
        $description          = Input::get('description');

        $paramObj = new Physicalexam();
        $paramObj->name = $name;
        $paramObj->type = $type;
        $paramObj->description = $description;

        $result = $this->repo->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\PhysicalexamController@index')
                ->withMessage(FormatGenerator::message('Success', 'Physical Examination created ...'));
        }
        else{
            return redirect()->action('Backend\PhysicalexamController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Physical Examination did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $physicalExam = $this->repo->getObjByID($id);
            return view('backend.physicalexam.physicalexam')->with('physicalExam', $physicalExam);
        }
        return redirect('/');
    }

    public function update(PhysicalexamEditRequest $request){
        $request->validate();
        $id = Input::get('id');
        $name                 = Input::get('name');
        $type                 = Input::get('type');
        $description          = Input::get('description');

        $paramObj = Physicalexam::find($id);
        $paramObj->name = $name;
        $paramObj->type = $type;
        $paramObj->description = $description;

        $result = $this->repo->update($paramObj);
        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\PhysicalexamController@index')
                ->withMessage(FormatGenerator::message('Success', 'Physical Examination updated ...'));
        }
        else{
            return redirect()->action('Backend\PhysicalexamController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Physical Examination did not update ...'));
        }
    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }

        return redirect()->action('Backend\PhysicalexamController@index')
            ->withMessage(FormatGenerator::message('Success', 'Physical Examination deleted ...'));
    }
}
