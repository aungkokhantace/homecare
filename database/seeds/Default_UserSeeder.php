<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/4/2016
 * Time: 3:03 PM
 */

use Illuminate\Database\Seeder;
class Default_UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    DB::table('core_users')->delete();

    $roles = array(
//        ['id'=>'U0001', 'name'=>'super-admin', 'password' =>'$2y$10$NLS2i1NpEUuQgoLgYk0QSOxsKxk6u1PFdeYJkpCraq2rS6polwYI6', 'phone' =>'09123456789','email' =>'waiyanaung@aceplussolutions.com','fees' =>'', 'role_id' =>'1','address'=>'Building 5, Room 10, MICT Park, Hlaing Township, Yangon, Myanmar'],
        ['id'=>'U0001', 'name'=>'super-admin', 'password' =>'YWNlcGx1c0AxMjM=', 'phone' =>'09123456789','email' =>'waiyanaung@aceplussolutions.com','fees' =>'', 'role_id' =>'1','address'=>'Building 5, Room 10, MICT Park, Hlaing Township, Yangon, Myanmar'],
        ['id'=>'U0002', 'name'=>'admin', 'password' =>'MTIzQHBhcmFtaQ==', 'phone' =>'09123456789','email' =>'test@aceplussolutions.com','fees' =>'', 'role_id' =>'2','address'=>'Building 5, Room 10, MICT Park, Hlaing Township, Yangon, Myanmar']

    );

    DB::table('core_users')->insert($roles);
}
}