<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/25/2016
 * Time: 11:57 AM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Backend\Infrastructure\Forms\AllergyEntryRequest;
use App\Backend\Infrastructure\Forms\AllergyEditRequest;
use App\Backend\Allergy\AllergyRepositoryInterface;
use App\Backend\Allergy\Allergy;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use Illuminate\Support\Facades\Storage;

class ActivitiesController extends Controller
{
    private $allergyRepository;

    public function __construct(AllergyRepositoryInterface $allergyRepository)
    {
        $this->allergyRepository = $allergyRepository;
    }

    public function index(Request $request)
    {
        if (Auth::guard('User')->check()) {
            $dir = storage_path('logs');

            $rawFiles = scandir($dir);

            $logArray = array();

            foreach ($rawFiles as $rawFile){
                if (0 === strpos($rawFile, 'custom-laravel-')){
                    $logDateRaw = str_replace('custom-laravel-',"",$rawFile);
                    $logDate = str_replace('.log',"",$logDateRaw);
                    $logfileNameWithPath = $dir . "/" . $rawFile;
                    $activities = file($logfileNameWithPath, FILE_IGNORE_NEW_LINES);
                    $logArray[$logDate] = $activities;
                }
            }
            return view('log.activities')->with('logArray',$logArray);
        }
        return redirect('/');
    }
}
