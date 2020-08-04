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
            ['id'=>'U0001', 'name'=>'History One', 'description' =>'History One Description', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0002', 'name'=>'Heart Disease', 'description' =>'Heart Disease', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0003', 'name'=>'Hypertension', 'description' =>'Hypertension', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0004', 'name'=>'High Cholestrol', 'description' =>'High Cholestrol', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0005', 'name'=>'Diabetes', 'description' =>'Diabetes', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0006', 'name'=>'Stroke', 'description' =>'Stroke', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0007', 'name'=>'Hepatitis', 'description' =>'Hepatitis', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0008', 'name'=>'Asthma', 'description' =>'Asthma', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0009', 'name'=>'Cancer', 'description' =>'Cancer', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U00010', 'name'=>'Bleeding disorder', 'description' =>'Bleeding disorder', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45']
        );

        DB::table('family_histories')->insert($objs);
    }
}