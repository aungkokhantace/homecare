<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 11/8/2016
 * Time: 11:22 AM
 */

use Illuminate\Database\Seeder;
class Default_ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->delete();

        $objs = array(
            ['id'=>'1', 'name'=>'MO', 'price' =>'100000', 'description' =>'MO Service', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['id'=>'2', 'name'=>'Physiotherapy Musculo', 'price' =>'100000', 'description' =>'Physiotherapy Musculo Service', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['id'=>'3', 'name'=>'Physiotherapy Neuro', 'price' =>'100000', 'description' =>'Physiotherapy Neuro Service', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['id'=>'4', 'name'=>'Nutrition', 'price' =>'100000', 'description' =>'Nutrition Service', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['id'=>'5', 'name'=>'Blood Drawing', 'price' =>'100000', 'description' =>'Blood Drawing Service', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35']

        );

        DB::table('services')->insert($objs);
    }
}