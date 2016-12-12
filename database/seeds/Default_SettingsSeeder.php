<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/4/2016
 * Time: 3:03 PM
 */

use Illuminate\Database\Seeder;
class Default_SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_settings')->delete();

        $roles = array(
            ['code'=>'LOCAL', 'type'=>'PATIENT_TYPE', 'value' =>'1', 'description' =>'Local Patient'],
            ['code'=>'FOREIGNER', 'type'=>'PATIENT_TYPE', 'value' =>'2', 'description' =>'Foreign Patient'],
            ['code'=>'TAX_RATE', 'type'=>'TAX_RATE', 'value' =>'7', 'description' =>'Tax Rate']

        );

        DB::table('core_settings')->insert($roles);
    }
}