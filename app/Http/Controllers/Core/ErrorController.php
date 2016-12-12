<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/1/2016
 * Time: 10:47 AMs
 */
namespace App\Http\Controllers\Core;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{

    public function __construct()    {

    }

    public function index($errorId)
    {
        $errorMessage = "There is error in your request. !";
        if($errorId == '504'){
            $errorMessage = "You don't have permission to access this operation. !";
        }
        return view('core.error.index')
            ->with('errorMessage', $errorMessage);
    }

    public function error($errorId,$module)
    {
        $errorMessage = "There is error in your request. !";
        if($errorId == '204'){
            $errorMessage = "Error in loading ".$module." list view !";
        }
        return view('core.error.index')
            ->with('errorMessage', $errorMessage);
    }

    public function unauthorize()
    {
        $errorMessage = "You don't have permission to access this request. !";
        return view('core.error.unauthorize')
            ->with('errorMessage', $errorMessage);
    }

    public function unauthorizePatient()
    {
        $errorMessage = "You don't have permission to access this request. !";
        return view('core.error.unauthorize_patient')
            ->with('errorMessage', $errorMessage);
    }

}
