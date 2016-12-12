<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 11/8/2016
 * Time: 11:22 AM
 */

use Illuminate\Database\Seeder;
class Default_ServicePriceTrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setup_price_tracking')->where('table_name', '=', 'services')->delete();

        $objs = array(
            ['table_name'=>'services', 'table_id'=>'1', 'table_id_type'=>'integer', 'action'=>'create', 'old_price' =>'0', 'new_price' =>'100000'],
            ['table_name'=>'services', 'table_id'=>'2', 'table_id_type'=>'integer', 'action'=>'create', 'old_price' =>'0', 'new_price' =>'100000'],
            ['table_name'=>'services', 'table_id'=>'3', 'table_id_type'=>'integer', 'action'=>'create', 'old_price' =>'0', 'new_price' =>'100000'],
            ['table_name'=>'services', 'table_id'=>'4', 'table_id_type'=>'integer', 'action'=>'create', 'old_price' =>'0', 'new_price' =>'100000']
        );

        DB::table('setup_price_tracking')->insert($objs);
    }
}