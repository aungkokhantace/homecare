<?php
/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 11/9/2016
 * Time: 11:30 AM
 */

use Illuminate\Database\Seeder;
class Default_ProvisionalDiagnosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provisional_diagnosis')->delete();

        $objs = array(
            ['id'=>'U0001', 'name'=>'Diagnosis One', 'description' =>'Diagnosis One Description', 'created_by'=> 'U0001', 'updated_by'=>'U0001', 'created_at'=> '2016-11-09 11:29:45', 'updated_at'=>'2016-11-09 11:29:45'],

        );

        DB::table('provisional_diagnosis')->insert($objs);
    }
}