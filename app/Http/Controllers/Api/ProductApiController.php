<?php

namespace App\Http\Controllers\Api;

use App\Api\Product\ProductApiRepository;
use App\Backend\Product\Product;
use App\Core\Check;
use App\Core\ReturnMessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ProductApiController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $returnedObj['aceplusStatusCode']       = ReturnMessage::OK;
        $returnedObj['aceplusStatusMessage']    = "Invalid Request !";
        return \Response::json($returnedObj);
    }

    public function upload(){
        $inputAll   = Input::All();

        $checkServerStatusArray = Check::checkSiteActivationCode($inputAll);

        if($checkServerStatusArray['aceplusStatusCode'] == ReturnMessage::OK){

            $productId                  = $inputAll['id'];

            $productRepo                = new ProductApiRepository();
            $product                    = $productRepo->getObjById($productId);

            if(isset($product) && $product->id == $productId){

                $paramObj                           = $product;
                $paramObj->product_name             = $inputAll['name'];
                $paramObj->product_category_id      = $inputAll['product_category_id'];
                $paramObj->price                    = $inputAll['price'];
                $paramObj->description              = $inputAll['description'];
                $paramObj->created_by               = $inputAll['created_by'];
                $paramObj->updated_by               = $inputAll['updated_by'];
                $paramObj->deleted_by               = $inputAll['deleted_by'];
                $paramObj->created_at               = $inputAll['created_at'];
                $paramObj->updated_at               = $inputAll['updated_at'];
                $paramObj->deleted_at               = $inputAll['deleted_at'];

                $result = $productRepo->update($paramObj);
            }
            else{
                $paramObj                           = new Product();
                $paramObj->id                       = $inputAll['id'];
                $paramObj->product_name             = $inputAll['name'];
                $paramObj->product_category_id      = $inputAll['product_category_id'];
                $paramObj->price                    = $inputAll['price'];
                $paramObj->description              = $inputAll['description'];
                $paramObj->created_by               = $inputAll['created_by'];
                $paramObj->updated_by               = $inputAll['updated_by'];
                $paramObj->deleted_by               = $inputAll['deleted_by'];
                $paramObj->created_at               = $inputAll['created_at'];
                $paramObj->updated_at               = $inputAll['updated_at'];
                $paramObj->deleted_at               = $inputAll['deleted_at'];

                $result = $productRepo->create($paramObj);
            }

            if($result['aceplusStatusCode'] == ReturnMessage::OK){

                $returnedObj['aceplusStatusCode'] = ReturnMessage::OK;
                $returnedObj['aceplusStatusMessage'] = "Request success !";
                $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];

                return \Response::json($returnedObj);

            }
            else{
                $returnedObj['aceplusStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
                $returnedObj['aceplusStatusMessage'] = "Request Fail !";
                $returnedObj['tabletId'] = $checkServerStatusArray['tablet_id'];
                return \Response::json($returnedObj);
            }
        }
        else{
            return \Response::json($checkServerStatusArray);
        }

    }
}
