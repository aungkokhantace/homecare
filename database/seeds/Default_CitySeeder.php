<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 10/19/2016
 * Time: 5:34 PM
 */

use Illuminate\Database\Seeder;

class Default_CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();

        $importData = array(
            ['id'=>'1', 'name'=>'Yangon', 'description'=>'Yangon City','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52']

        );

        DB::table('cities')->insert($importData);
    }
}