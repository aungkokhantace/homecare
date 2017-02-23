<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 11/8/2016
 * Time: 11:22 AM
 */

use Illuminate\Database\Seeder;
class Default_ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->delete();

        $objs = array(
            ['id'=>'1', 'name'=>'Pill', 'description' =>'Pill Category', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
        );

        DB::table('product_categories')->insert($objs);
    }
}