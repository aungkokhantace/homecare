<?php

namespace App\Http\Controllers\Backend;

use App\Backend\Productcategory\Productcategory;
use App\Backend\Productcategory\ProductcategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ProductcategoryEntryRequest;
use App\Backend\Infrastructure\Forms\ProductcategoryEditRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class ProductcategoryController extends Controller
{
    private $repo;

    public function __construct(ProductcategoryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                // $productCategory      = $this->repo->getObjs();
                $excluded_array = [10001, 10002]; //ids to be hidden from list (new_medication and treatment)
                $productCategory      = $this->repo->getObjsByExcludedArray($excluded_array);
                return view('backend.productcategory.index')->with('productCategory', $productCategory);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/product category');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            return view('backend.productcategory.productcategory');
        }
        return redirect('/');
    }

    public function store(ProductcategoryEntryRequest $request)
    {
        $request->validate();
        $name           = Input::get('name');
        $description    = Input::get('description');

        $paramObj = new Productcategory();
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->repo->create($paramObj);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\ProductcategoryController@index')
                ->withMessage(FormatGenerator::message('Success', 'Medication Category created ...'));
        }
        else{
            return redirect()->action('Backend\ProductcategoryController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Medication Category did not create ...'));
        }
    }

    public function edit($id){
        if (Auth::guard('User')->check()) {
          if (in_array($id, [10001, 10002])) {
                return response()->view('core.error.pagenotfound', [], 404);
            }
            $productCategory = $this->repo->getObjByID($id);
            return view('backend.productcategory.productcategory')->with('productCategory', $productCategory);
        }
        return redirect('/');
    }

    public function update(ProductcategoryEditRequest $request){
        $request->validate();
        $id = Input::get('id');
        $name           =Input::get('name');
        $description    =Input::get('description');

        $paramObj = Productcategory::find($id);
        $paramObj->name = $name;
        $paramObj->description = $description;

        $result = $this->repo->update($paramObj);
        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\ProductcategoryController@index')
                ->withMessage(FormatGenerator::message('Success', 'Medication Category updated ...'));
        }
        else{
            return redirect()->action('Backend\ProductcategoryController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Medication Category did not update ...'));
        }

    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        $delete_flag = true;
        foreach($new_string as $id){
            $check = $this->repo->checkToDelete($id);
            if(isset($check) && count($check)>0){
                alert()->warning('There are products under this category_id = '.$id)->persistent('OK');
                $delete_flag = false;
            }
            else{
                $this->repo->delete($id);
            }
        }

        if($delete_flag) {
            return redirect()->action('Backend\ProductcategoryController@index')
                ->withMessage(FormatGenerator::message('Success', 'Medication Category deleted ...'));
        }
        else{
            return redirect()->action('Backend\ProductcategoryController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Medication Category did not delete ...'));
        }
    }
}
