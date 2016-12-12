<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Seeders
         $this->call(Default_ConfigSeeder::class);
         $this->call(Default_RoleSeeder::class);
         $this->call(Default_UserSeeder::class);
         $this->call(Default_PermissionSeeder::class);
         $this->call(Default_RolePermissionSeeder::class);
         $this->call(Default_Syncs_TablesSeeder::class);
         $this->call(Default_SettingsSeeder::class);
         $this->call(Default_TerminalSeeder::class);
         $this->call(Default_InvestigationImagingSeeder::class);
         $this->call(Default_InvestigationSeeder::class);
         $this->call(Default_CitySeeder::class);
         $this->call(Default_TownshipSeeder::class);
         $this->call(Default_ServiceSeeder::class);
         $this->call(Default_PatientFamilyMemberSeeder::class);
         $this->call(Default_AllergySeeder::class);
         $this->call(Default_InvestigationPriceTrackingSeeder::class);
         $this->call(Default_ServicePriceTrackingSeeder::class);

    }
}
