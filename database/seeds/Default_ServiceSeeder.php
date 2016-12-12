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
            ['id'=>'1', 'name'=>'MO', 'price' =>'100000', 'description' =>'MO Service'],
            ['id'=>'2', 'name'=>'Physiotherapy Musculo', 'price' =>'100000', 'description' =>'Physiotherapy Musculo Service'],
            ['id'=>'3', 'name'=>'Physiotherapy Neuro', 'price' =>'100000', 'description' =>'Physiotherapy Neuro Service'],
            ['id'=>'4', 'name'=>'Nutrition', 'price' =>'100000', 'description' =>'Nutrition Service']

        );

        DB::table('services')->insert($objs);
    }
}