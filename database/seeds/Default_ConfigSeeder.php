<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/4/2016
 * Time: 3:03 PM
 */
use Illuminate\Database\Seeder;

class Default_ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_configs')->delete();

        $roles = array(
            ['code'=>'SETTING_COMPANY_NAME', 'type'=>'SETTING', 'value'=>'AcePlus Backend','description'=>'Company Name'],
            ['code'=>'SETTING_LOGO', 'type'=>'SETTING', 'value'=>'/images/logo.png','description'=>'Company Logo'],
            ['code'=>'SETTING_SITE_ACTIVATION_KEY', 'type'=>'SETTING', 'value'=>'','description'=>'Site Activation Key'],
            ['code'=>'LOG_MAX_FILES', 'type'=>'SETTING', 'value'=>'60','description'=>'Maximum Log File Count']
        );

        DB::table('core_configs')->insert($roles);
    }
}