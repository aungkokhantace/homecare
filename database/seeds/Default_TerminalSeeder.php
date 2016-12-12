<?php

use Illuminate\Database\Seeder;

class Default_TerminalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terminals')->delete();

        $terminals = array(
            ['id'=>'U000', 'tablet_id'=>'backend', 'remark'=>'This is for the backend central server only !']
        );

        DB::table('terminals')->insert($terminals);
    }
}
