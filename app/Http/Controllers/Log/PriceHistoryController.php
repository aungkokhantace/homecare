<?php
namespace App\Http\Controllers\Log;

/**
 * Created by PhpStorm.
 * User: william
 * Author: Wai Yan Aung
 * Date: 12/5/2016
 * Time: 5:50 PM
 */
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Backend\LogPatientCaseSummary\LogPatientCaseSummaryRepositoryInterface;
use App\Log\PriceHistory\PriceHistoryRepository;


class PriceHistoryController extends Controller
{

    private $repo;

    public function __construct(LogPatientCaseSummaryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        if (Auth::guard('User')->check()) {
            return redirect('/');
        }
        return redirect('/');
    }

    public function search($type = 'all', $id = 0){
        if (Auth::guard('User')->check()) {
            $priceHistories = array();
            $priceHistoryRepositoryRepo = new PriceHistoryRepository();
            $priceHistories = $priceHistoryRepositoryRepo->getPriceHistory($type,$id);
            return view('log.price_history')
                ->with('type',$type)
                ->with('priceHistories',$priceHistories);
        }
        return redirect('/');
    }

    public function multiplesearch($type = 'all', $id = 0){
        if (Auth::guard('User')->check()) {
            $priceHistories = array();
            $priceHistoryRepositoryRepo = new PriceHistoryRepository();
            $priceHistories = $priceHistoryRepositoryRepo->getMultiplePriceHistory($type,$id);
            return view('log.multiple_price_history')
                ->with('type',$type)
                ->with('priceHistories',$priceHistories);
        }
        return redirect('/');
    }


}
