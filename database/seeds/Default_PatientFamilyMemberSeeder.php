<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 11/9/2016
 * Time: 11:30 AM
 */

use Illuminate\Database\Seeder;
class Default_PatientFamilyMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('patient_family_member')->delete();

        $objs = array(
            ['id'=>'U0001', 'name'=>'Father', 'description' =>'Father', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0002', 'name'=>'Mother', 'description' =>'Mother', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0003', 'name'=>'Brother', 'description' =>'Brother', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0004', 'name'=>'Sister', 'description' =>'Sister', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0005', 'name'=>'Grandfather', 'description' =>'Grandfather', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0006', 'name'=>'Grandmother', 'description' =>'Grandmother', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0007', 'name'=>'Uncle', 'description' =>'Uncle', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0008', 'name'=>'Aunty', 'description' =>'Aunty', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],
            ['id'=>'U0009', 'name'=>'Cousin', 'description' =>'Cousin', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45']
        );

        DB::table('patient_family_member')->insert($objs);
    }
}