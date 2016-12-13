<?php
namespace App\Http\Controllers\Log;

/**
 * Created by PhpStorm.
 * User: william
 * Author: Wai Yan Aung
 * Date: 12/5/2016
 * Time: 5:50 PM
 */
use App\Backend\Terminal\TerminalRepository;
use App\Log\TabletIssues\TabletIssuesRepository;
use App\Log\TabletIssues\TabletIssuesRepositoryInterface;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Log\PriceHistory\PriceHistoryRepository;


class TabletIssuesController extends Controller
{
    private $repo;

    public function __construct(TabletIssuesRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        if (Auth::guard('User')->check()) {
            return redirect('/');
        }
        return redirect('/');
    }

    public function search($type = 'all'){
        if (Auth::guard('User')->check()) {
            $terminalRepo = new TerminalRepository();
            $tabletIds = $terminalRepo->getObjs();
            $tabletIdsArray = array();
            foreach($tabletIds as $tabletId){
                if($tabletId->id !== 'U000'){
                    $tabletIdsArray[$tabletId->tablet_id] = $tabletId->id.'-'.$tabletId->tablet_id;
                }
            }
            $tabletIssues = array();
            $tabletIssuesRepo = new TabletIssuesRepository();
            $tabletIssues = $tabletIssuesRepo->getTabletIssues($type);

            return view('log.tablet_issues')
                ->with('type',$type)
                ->with('tabletIdsArray',$tabletIdsArray)
                ->with('tabletIssues',$tabletIssues);
        }
        return redirect('/');
    }


}
