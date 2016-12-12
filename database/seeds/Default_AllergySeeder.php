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
            ['name'=>'Peanuts', 'type' =>'food', 'description' =>'Peanuts Allergy'],
            ['name'=>'Milk', 'type' =>'food', 'description' =>'Milk Allergy'],
            ['name'=>'Eggs', 'type' =>'food', 'description' =>'Eggs Allergy'],
            ['name'=>'Nuts', 'type' =>'food', 'description' =>'Nuts Allergy'],
            ['name'=>'Fish', 'type' =>'food', 'description' =>'Fish Allergy'],
            ['name'=>'Shellfish', 'type' =>'food', 'description' =>'Shellfish Allergy'],
            ['name'=>'Soy', 'type' =>'food', 'description' =>'Soy Allergy'],
            ['name'=>'Wheat', 'type' =>'food', 'description' =>'Wheat Allergy'],

            ['name'=>'Amoxicillin (Anitbiotics)', 'type' =>'drug', 'description' =>'Amoxicillin Allergy'],
            ['name'=>'Ampicillin (Anitbiotics)', 'type' =>'drug', 'description' =>'Ampicillin Allergy'],
            ['name'=>'Penicillin (Anitbiotics)', 'type' =>'drug', 'description' =>'Penicillin Allergy'],
            ['name'=>'Tetracycline (Anitbiotics)', 'type' =>'drug', 'description' =>'Tetracycline Allergy'],
            ['name'=>'NSAIDs', 'type' =>'drug', 'description' =>'NSAIDs Allergy'],
            ['name'=>'Septrin (Sulfa Drugs)', 'type' =>'drug', 'description' =>'Septrin Allergy'],
            ['name'=>'Anti-malarials (Sulfa Drugs)', 'type' =>'drug', 'description' =>'Anti-malarials Allergy'],
            ['name'=>'Cetuximab (Monoclonal antibody therapy)', 'type' =>'drug', 'description' =>'Cetuximab Allergy'],
            ['name'=>'Rituximab (Monoclonal antibody therapy)', 'type' =>'drug', 'description' =>'Rituximab Allergy'],
            ['name'=>'Abacavir (HIV drugs)', 'type' =>'drug', 'description' =>'Abacavir Allergy'],
            ['name'=>'Nevirapine (HIV drugs)', 'type' =>'drug', 'description' =>'Nevirapine Allergy'],
            ['name'=>'Insulin', 'type' =>'drug', 'description' =>'Insulin Allergy'],
            ['name'=>'Carbamazepine (Antiseizure Drugs)', 'type' =>'drug', 'description' =>'Carbamazepine Allergy'],
            ['name'=>'Lamotrigine (Antiseizure Drugs)', 'type' =>'drug', 'description' =>'Lamotrigine Allergy'],
            ['name'=>'Phenytoin (Antiseizure Drugs)', 'type' =>'drug', 'description' =>'Phenytoin Allergy']

        );

        DB::table('allergies')->insert($objs);
    }
}