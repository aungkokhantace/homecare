<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 9/9/2016
 * Time: 11:48 AM
 */

namespace App\Core\SyncsTable;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\SyncsTable\SyncsTable;

class SyncsTableRepository implements SyncsTableRepositoryInterface
{
    public function getArrays()
    {
        $tables = DB::select("SELECT * FROM core_syncs_tables WHERE deleted_at is null");
        return $tables;
    }
}