<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/4/2016
 * Time: 3:03 PM
 */
use Illuminate\Database\Seeder;
class Default_RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_roles')->delete();

        $roles = array(
            ['id'=>1, 'name'=>'SUPER-ADMIN', 'description'=>'This is super admin role'],
            ['id'=>2, 'name'=>'ADMIN', 'description'=>'This is manager role'],
            ['id'=>3, 'name'=>'MANAGER', 'description'=>'This is cashier role'],
            ['id'=>5, 'name'=>'PATIENT', 'description'=>'This is patient role'],
            ['id'=>6, 'name'=>'MO', 'description'=>'This is MO role'],
            ['id'=>7, 'name'=>'CONSULTANT', 'description'=>'This is consultant role'],
            ['id'=>8, 'name'=>'NURSE', 'description'=>'This is nurse role']
            ['id'=>9, 'name'=>'PHYSIOTHERAPY', 'description'=>'This is physiotherapy role']
        );

        DB::table('core_roles')->insert($roles);
    }
}
