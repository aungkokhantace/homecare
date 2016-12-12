<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/29/2016
 * Time: 1:22 PM
 */

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Core\FormatGenerator As FormatGenerator;
use App\Core\ReturnMessage As ReturnMessage;
use App\Core\Utility;
use App\Backend\Search\SearchRepositoryInterface;

class SearchController extends Controller
{
    private $searchRepository;

    public function __construct(SearchRepositoryInterface $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }


    public function autoCompletePatient(){
        $results = $this->searchRepository->getAutoCompletePatient();
        return Response::json($results);
    }

}
