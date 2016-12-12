<?php

namespace App\Http\Controllers\Backend;

use App\Backend\Productcategory\ProductcategoryRepository;
use App\Core\Utility;
use Illuminate\Http\Request;

use App\Backend\Product\Product;
use App\Backend\Product\ProductRepositoryInterface;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\ProductEntryRequest;
use App\Backend\Infrastructure\Forms\ProductEditRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;

class ProductController extends Controller
{
    private $repo;

    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(Request $request)
    {
        try{
            if (Auth::guard('User')->check()) {
                $product      = $this->repo->getObjs();
                return view('backend.product.index')->with('product', $product);
            }
            return redirect('/');
        }
        catch(\Exception $e){
            return redirect('/error/204/product');
        }
    }

    public function create(){
        if (Auth::guard('User')->check()) {
            $categoryRepo = new ProductcategoryRepository();
            $categories      = $categoryRepo->getObjs();
            return view('backend.product.product')->with('categories', $categories);
        }
        return redirect('/');
    }

        public function store(ProductEntryRequest $request)
        {
            $prefix = Utility::getTerminalId();
            $table = (new Product())->getTable();
            $col = "id";
            $offset = 1;
            $pad_length = 9;
//            $generatedId = Utility::generateKey($prefix,$table,$col,$offset, $pad_length);
            $generatedId = Utility::generatedId($prefix,$table,$col,$offset);

            $request->validate();
            $name                = Input::get('name');
            $product_category_id = Input::get('product_category_id');
            $price               = Input::get('price');
            $description         = Input::get('description');
            $paramObj                       = new Product();
            $paramObj->id                   = $generatedId;
            $paramObj->product_name         = $name;
            $paramObj->product_category_id  = $product_category_id;
            $paramObj->price                = $price;
            $paramObj->description          = $description;

            $result = $this->repo->create($paramObj);

            if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
                return redirect()->action('Backend\ProductController@index')
                    ->withMessage(FormatGenerator::message('Success', 'Medication created ...'));
            }
            else{
                return redirect()->action('Backend\ProductController@index')
                    ->withMessage(FormatGenerator::message('Fail', 'Medication did not create ...'));
            }
        }

    public function edit($id){
        if (Auth::guard('User')->check()) {
            $product = $this->repo->getObjByID($id);
            $categoryRepo = new ProductcategoryRepository();
            $categories      = $categoryRepo->getObjs();
            return view('backend.product.product')->with('product', $product)->with('categories', $categories);
        }
        return redirect('/');
    }

    public function update(ProductEditRequest $request){
        $request->validate();

        $id = Input::get('id');
        $name                 = Input::get('name');
        $product_category_id  = Input::get('product_category_id');
        $price                = Input::get('price');
        $description          = Input::get('description');

        $paramObj = Product::find($id);
        $old_price = $paramObj->price;

        $paramObj->product_name        = $name;
        $paramObj->product_category_id = $product_category_id;
        $paramObj->price               = $price;
        $paramObj->description         = $description;

        $result = $this->repo->update($paramObj,$old_price);

        if($result['aceplusStatusCode'] ==  ReturnMessage::OK){
            return redirect()->action('Backend\ProductController@index')
                ->withMessage(FormatGenerator::message('Success', 'Medication updated ...'));
        }
        else{
            return redirect()->action('Backend\ProductController@index')
                ->withMessage(FormatGenerator::message('Fail', 'Medication did not update ...'));
        }

    }

    public function destroy(){
        $id         = Input::get('selected_checkboxes');
        $new_string = explode(',', $id);
        foreach($new_string as $id){
            $this->repo->delete($id);
        }

        return redirect()->action('Backend\ProductController@index')
            ->withMessage(FormatGenerator::message('Success', 'Medication deleted ...'));

    }
}
