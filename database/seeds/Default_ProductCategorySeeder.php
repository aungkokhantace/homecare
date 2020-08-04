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
            ['id'=>'1', 'name'=>'Injection', 'description' =>'Injection', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-12-12 09:30:35', 'updated_at' =>'2017-12-12 09:30:35'],
            ['id'=>'2', 'name'=>'Tablet', 'description' =>'Tablet', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-12-12 09:30:35', 'updated_at' =>'2017-12-12 09:30:35'],
            ['id'=>'3', 'name'=>'Satch', 'description' =>'Satch', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-12-12 09:30:35', 'updated_at' =>'2017-12-12 09:30:35'],
            ['id'=>'4', 'name'=>'Nabulize', 'description' =>'Nabulize', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-12-12 09:30:35', 'updated_at' =>'2017-12-12 09:30:35'],
            ['id'=>'5', 'name'=>'Medical Item', 'description' =>'Medical Item', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-12-12 09:30:35', 'updated_at' =>'2017-12-12 09:30:35'],
            ['id'=>'6', 'name'=>'Topical', 'description' =>'Topical', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-12-12 09:30:35', 'updated_at' =>'2017-12-12 09:30:35'],
            ['id'=>'7', 'name'=>'Other', 'description' =>'Other', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-12-12 09:30:35', 'updated_at' =>'2017-12-12 09:30:35'],
            ['id'=>'8', 'name'=>'Intravenous infusion', 'description' =>'Intravenous infusion', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-12-12 09:30:35', 'updated_at' =>'2017-12-12 09:30:35'],
            ['id'=>'10001', 'name'=>'new_medication', 'description' =>'new_medication', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-12-12 09:30:35', 'updated_at' =>'2017-12-12 09:30:35'],
            ['id'=>'10002', 'name'=>'treatment', 'description' =>'treatment', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-12-12 09:30:35', 'updated_at' =>'2017-12-12 09:30:35'],
        );

        DB::table('product_categories')->insert($objs);
    }
}
