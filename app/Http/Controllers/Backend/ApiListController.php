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

class ApiListController extends Controller
{
    public function __construct()
    {

    }

    public function syncdownapi()
    {
        if (Auth::guard('User')->check()) {
            return view('backend.apilist.syncdownapi');
        }
        return redirect('/');
    }

    public function invoiceapi()
    {
        if (Auth::guard('User')->check()) {
            return view('backend.apilist.invoiceapi');
        }
        return redirect('/');
    }

    public function enquiryapi()
    {
        if (Auth::guard('User')->check()) {
            return view('backend.apilist.enquiryapi');
        }
        return redirect('/');
    }

    public function scheduleapi()
    {
        if (Auth::guard('User')->check()) {
            return view('backend.apilist.scheduleapi');
        }
        return redirect('/');
    }

    public function patientpackageapi()
    {
        if (Auth::guard('User')->check()) {
            return view('backend.apilist.patientpackageapi');
        }
        return redirect('/');
    }

    public function waytrackingapi()
    {
        if (Auth::guard('User')->check()) {
            return view('backend.apilist.waytrackingapi');
        }
        return redirect('/');
    }

    public function patientapi()
    {
        if (Auth::guard('User')->check()) {
            return view('backend.apilist.patientapi');
        }
        return redirect('/');
    }
}
