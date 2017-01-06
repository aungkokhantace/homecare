<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 11/8/2016
 * Time: 1:47 PM
 */

use Illuminate\Database\Seeder;

class Default_AllergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('allergies')->delete();

        $objs = array(
            ['name'=>'Peanuts', 'type' =>'food', 'description' =>'Peanuts Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Milk', 'type' =>'food', 'description' =>'Milk Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Eggs', 'type' =>'food', 'description' =>'Eggs Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Nuts', 'type' =>'food', 'description' =>'Nuts Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Fish', 'type' =>'food', 'description' =>'Fish Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Shellfish', 'type' =>'food', 'description' =>'Shellfish Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Soy', 'type' =>'food', 'description' =>'Soy Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Wheat', 'type' =>'food', 'description' =>'Wheat Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],

            ['name'=>'Amoxicillin (Anitbiotics)', 'type' =>'drug', 'description' =>'Amoxicillin Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Ampicillin (Anitbiotics)', 'type' =>'drug', 'description' =>'Ampicillin Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Penicillin (Anitbiotics)', 'type' =>'drug', 'description' =>'Penicillin Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Tetracycline (Anitbiotics)', 'type' =>'drug', 'description' =>'Tetracycline Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'NSAIDs', 'type' =>'drug', 'description' =>'NSAIDs Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Septrin (Sulfa Drugs)', 'type' =>'drug', 'description' =>'Septrin Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Anti-malarials (Sulfa Drugs)', 'type' =>'drug', 'description' =>'Anti-malarials Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Cetuximab (Monoclonal antibody therapy)', 'type' =>'drug', 'description' =>'Cetuximab Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Rituximab (Monoclonal antibody therapy)', 'type' =>'drug', 'description' =>'Rituximab Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Abacavir (HIV drugs)', 'type' =>'drug', 'description' =>'Abacavir Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Nevirapine (HIV drugs)', 'type' =>'drug', 'description' =>'Nevirapine Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Insulin', 'type' =>'drug', 'description' =>'Insulin Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Carbamazepine (Antiseizure Drugs)', 'type' =>'drug', 'description' =>'Carbamazepine Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Lamotrigine (Antiseizure Drugs)', 'type' =>'drug', 'description' =>'Lamotrigine Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35'],
            ['name'=>'Phenytoin (Antiseizure Drugs)', 'type' =>'drug', 'description' =>'Phenytoin Allergy', 'created_by' =>'U0001', 'updated_by' =>'U0001', 'created_at' =>'2017-01-06 11:30:35', 'updated_at' =>'2017-01-06 11:30:35']

        );

        DB::table('allergies')->insert($objs);
    }
}