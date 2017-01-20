<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 11/9/2016
 * Time: 11:30 AM
 */

use Illuminate\Database\Seeder;
class Default_FamilyHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('family_histories')->delete();

        $objs = array(
            ['id'=>'U0001', 'name'=>'Heart Disease', 'description' =>'', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0002', 'name'=>'Hypertension', 'description' =>'', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0003', 'name'=>'High Cholestrol', 'description' =>'', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0004', 'name'=>'Diabetes', 'description' =>'', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0005', 'name'=>'Stroke', 'description' =>'Stroke', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0006', 'name'=>'Hepatitis', 'description' =>'Hepatitis', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0007', 'name'=>'Asthma', 'description' =>'Asthma', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0008', 'name'=>'Cancer', 'description' =>'Cancer', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0009', 'name'=>'Bleeding disorder', 'description' =>'', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45']
        );

        DB::table('family_histories')->insert($objs);
    }
}