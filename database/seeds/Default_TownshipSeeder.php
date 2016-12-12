<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 10/19/2016
 * Time: 5:34 PM
 */

use Illuminate\Database\Seeder;

class Default_TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('townships')->delete();

        $importData = array(
            ['id'=>'1', 'name'=>'Ahlon', 'city_id' => '1','remark'=>'Ahlon Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'2', 'name'=>'Bahan', 'city_id' => '1','remark'=>'Bahan Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'3', 'name'=>'Cocokyun', 'city_id' => '1','remark'=>'Cocokyun Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'4', 'name'=>'Dagon Seikkan', 'city_id' => '1','remark'=>'Dagon Seikkan Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'5', 'name'=>'Dagon', 'city_id' => '1','remark'=>'Dagon Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'6', 'name'=>'Dawbon', 'city_id' => '1','remark'=>'Dawbon Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'7', 'name'=>'East Dagon', 'city_id' => '1','remark'=>'East Dagon Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'8', 'name'=>'Hlaing', 'city_id' => '1','remark'=>'Hlaing Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'9', 'name'=>'Hlaingthaya', 'city_id' => '1','remark'=>'Hlaingthaya Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'10', 'name'=>'Hlegu', 'city_id' => '1','remark'=>'Hlegu Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'11', 'name'=>'Hmawbi', 'city_id' => '1','remark'=>'Hmawbi Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'12', 'name'=>'Htantabin', 'city_id' => '1','remark'=>'Htantabin Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'13', 'name'=>'Insein', 'city_id' => '1','remark'=>'Insein Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'14', 'name'=>'Kamayut', 'city_id' => '1','remark'=>'Kamayut Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'15', 'name'=>'Kawhmu', 'city_id' => '1','remark'=>'Kawhmu Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'16', 'name'=>'Kayan', 'city_id' => '1','remark'=>'Kayan Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'17', 'name'=>'Kungyangon', 'city_id' => '1','remark'=>'Kungyangon Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'18', 'name'=>'Kyauktada', 'city_id' => '1','remark'=>'Kyauktada Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'19', 'name'=>'Kyauktan', 'city_id' => '1','remark'=>'Kyauktan Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'20', 'name'=>'Kyimyindaing', 'city_id' => '1','remark'=>'Kyimyindaing Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'21', 'name'=>'Lanmadaw', 'city_id' => '1','remark'=>'Lanmadaw Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'22', 'name'=>'Latha', 'city_id' => '1','remark'=>'Latha Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'23', 'name'=>'Mayangon', 'city_id' => '1','remark'=>'Mayangon Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'24', 'name'=>'Mingala Taungnyunt', 'city_id' => '1','remark'=>'Mingala Taungnyunt Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'25', 'name'=>'Mingaladon', 'city_id' => '1','remark'=>'Mingaladon Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'26', 'name'=>'North Dagon', 'city_id' => '1','remark'=>'North Dagon Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'27', 'name'=>'North Okkalapa', 'city_id' => '1','remark'=>'North Okkalapa Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'28', 'name'=>'Pabedan', 'city_id' => '1','remark'=>'Pabedan Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'29', 'name'=>'Pazundaung', 'city_id' => '1','remark'=>'Pazundaung Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'30', 'name'=>'Sanchaung', 'city_id' => '1','remark'=>'Sanchaung Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'31', 'name'=>'Seikkan', 'city_id' => '1','remark'=>'Seikkan Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'32', 'name'=>'Seikkyi Kanaungto', 'city_id' => '1','remark'=>'Seikkyi Kanaungto Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'33', 'name'=>'Shwepyitha', 'city_id' => '1','remark'=>'Shwepyitha Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'34', 'name'=>'South Dagon', 'city_id' => '1','remark'=>'South Dagon Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'35', 'name'=>'South Okkalapa', 'city_id' => '1','remark'=>'South Okkalapa Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'36', 'name'=>'Taikkyi', 'city_id' => '1','remark'=>'Taikkyi Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'37', 'name'=>'Tamwe', 'city_id' => '1','remark'=>'Tamwe Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'38', 'name'=>'Thaketa', 'city_id' => '1','remark'=>'Thaketa Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'39', 'name'=>'Thanlyin', 'city_id' => '1','remark'=>'Thanlyin Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'40', 'name'=>'Thingangyun', 'city_id' => '1','remark'=>'Thingangyun Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'41', 'name'=>'Thongwa', 'city_id' => '1','remark'=>'Thongwa Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'42', 'name'=>'Twante', 'city_id' => '1','remark'=>'Twante Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52'],
            ['id'=>'43', 'name'=>'Yankin', 'city_id' => '1','remark'=>'Yankin Township','created_by'=>'U0001','updated_by'=>'U0001','created_at'=>'2016-10-19 17:45:52','updated_at'=>'2016-10-19 17:45:52']

        );

        DB::table('townships')->insert($importData);
    }
}