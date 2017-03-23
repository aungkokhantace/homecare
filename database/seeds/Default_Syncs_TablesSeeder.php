<?php
/**
 * Created by PhpStorm.
 * User: Dell
 * Date: 7/4/2016
 * Time: 3:03 PM
 */

use Illuminate\Database\Seeder;
class Default_Syncs_TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_syncs_tables')->delete();

        $syncs_tables = array(
            ['table_name'=>'core_configs', 'version' =>'1'],
            ['table_name'=>'core_permissions', 'version' =>'1'],
            ['table_name'=>'core_permission_role', 'version' =>'1'],
            ['table_name'=>'core_roles', 'version' =>'1'],
            ['table_name'=>'core_users', 'version' =>'1'],
            ['table_name'=>'core_settings', 'version' =>'1'],

            ['table_name'=>'cities', 'version' =>'1'],
            ['table_name'=>'townships', 'version' =>'1'],
            ['table_name'=>'car_types', 'version' =>'1'],
            ['table_name'=>'zones', 'version' =>'1'],
            ['table_name'=>'zone_detail', 'version' =>'1'],
            ['table_name'=>'car_type_setup', 'version' =>'1'],
            ['table_name'=>'product_categories', 'version' =>'1'],
            ['table_name'=>'products', 'version' =>'1'],
            ['table_name'=>'packages', 'version' =>'1'],
            ['table_name'=>'package_detail', 'version' =>'1'],
            ['table_name'=>'investigations_imaging', 'version' =>'1'],
            ['table_name'=>'investigation_labs', 'version' =>'1'],
            ['table_name'=>'physical_exams', 'version' =>'1'],
            ['table_name'=>'services', 'version' =>'1'],
            ['table_name'=>'allergies', 'version' =>'1'],
            ['table_name'=>'family_histories', 'version' =>'1'],
            ['table_name'=>'medical_history', 'version' =>'1'],
            ['table_name'=>'patients', 'version' =>'1'],
            ['table_name'=>'patient_allergy', 'version' =>'1'],
            ['table_name'=>'patient_family_history', 'version' =>'1'],
            ['table_name'=>'patient_medical_history', 'version' =>'1'],
            ['table_name'=>'patient_package', 'version' =>'1'],
            ['table_name'=>'patient_package_detail', 'version' =>'1'],
            ['table_name'=>'patient_surgery_history', 'version' =>'1'],
            ['table_name'=>'provisional_diagnosis', 'version' =>'1'],
            ['table_name'=>'patient_family_member', 'version' =>'1'],
            ['table_name'=>'route', 'version' =>'1'],
            ['table_name'=>'schedule_treatment_histories', 'version' =>'1'],
            ['table_name'=>'enquiries', 'version' =>'1'],
            ['table_name'=>'enquiry_detail', 'version' =>'1'],
            ['table_name'=>'schedules', 'version' =>'1'],
            ['table_name'=>'schedule_detail', 'version' =>'1'],
            ['table_name'=>'patient_physiotherapy_neuro_general', 'version' =>'1'],
            ['table_name'=>'patient_physiotherapy_neuro_limb', 'version' =>'1'],
            ['table_name'=>'patient_physiotherapy_neuro_functional_performance1', 'version' =>'1'],
            ['table_name'=>'patient_physiotherapy_neuro_functional_performance2', 'version' =>'1'],
            ['table_name'=>'patient_physiotherapy_neuro_functional_performance3', 'version' =>'1'],
            ['table_name'=>'patient_physiothreapy_musculo_1_and_2', 'version' =>'1'],
            ['table_name'=>'patient_physiotherapy_musculo_3_sitting', 'version' =>'1'],
            ['table_name'=>'patient_physiotherapy_musculo_3_standing', 'version' =>'1'],
            ['table_name'=>'patient_physiotherapy_musculo_4_1and2', 'version' =>'1'],
            ['table_name'=>'patient_physiotherapy_musculo_4_3', 'version' =>'1'],
            ['table_name'=>'patient_physiotherapy_musculo_4_4and5', 'version' =>'1'],

            ['table_name'=>'package_promotions', 'version' =>'1'],
            ['table_name'=>'transaction_promotions', 'version' =>'1'],



        );

        DB::table('core_syncs_tables')->insert($syncs_tables);
    }
}