<?php
namespace App\Log\TabletIssues;
/**
 * Created by PhpStorm.
 * User: william
 * Author: Wai Yan Aung
 * Date: 12/6/2016
 * Time: 10:35 AM
 */

use DB;

class TabletIssuesRepository implements TabletIssuesRepositoryInterface
{
    public function getTabletIssues($type){

        try {
            if($type == 'all') {
                $tabletIssues = DB::select("SELECT * FROM log_tablet_issue ORDER BY created_at");
            }
            else{
                $tabletIssues = DB::select("SELECT * FROM log_tablet_issue WHERE tablet_id = '$type'");
            }
            return $tabletIssues;
        }
        catch(\Exception $e){
            return redirect('/');
        }
    }
}