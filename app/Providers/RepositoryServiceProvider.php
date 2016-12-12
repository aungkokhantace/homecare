<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Core
        $this->app->bind('App\Core\Role\RoleRepositoryInterface','App\Core\Role\RoleRepository');
        $this->app->bind('App\Core\Permission\PermissionRepositoryInterface','App\Core\Permission\PermissionRepository');
        $this->app->bind('App\Core\Config\ConfigRepositoryInterface','App\Core\Config\ConfigRepository');
        $this->app->bind('App\Core\User\UserRepositoryInterface','App\Core\User\UserRepository');

        // Backend
        $this->app->bind('App\Backend\City\CityRepositoryInterface','App\Backend\City\CityRepository');
        $this->app->bind('App\Backend\Township\TownshipRepositoryInterface','App\Backend\Township\TownshipRepository');
        $this->app->bind('App\Backend\Cartype\CartypeRepositoryInterface','App\Backend\Cartype\CartypeRepository');
        $this->app->bind('App\Backend\Zone\ZoneRepositoryInterface','App\Backend\Zone\ZoneRepository');
        $this->app->bind('App\Backend\Cartypesetup\CartypesetupRepositoryInterface','App\Backend\Cartypesetup\CartypesetupRepository');
        $this->app->bind('App\Backend\Enquiry\EnquiryRepositoryInterface','App\Backend\Enquiry\EnquiryRepository');
        $this->app->bind('App\Backend\Allergy\AllergyRepositoryInterface','App\Backend\Allergy\AllergyRepository');
        $this->app->bind('App\Backend\Productcategory\ProductcategoryRepositoryInterface','App\Backend\Productcategory\ProductcategoryRepository');
        $this->app->bind('App\Backend\Product\ProductRepositoryInterface','App\Backend\Product\ProductRepository');
        $this->app->bind('App\Backend\Package\PackageRepositoryInterface','App\Backend\Package\PackageRepository');
        $this->app->bind('App\Backend\Service\ServiceRepositoryInterface','App\Backend\Service\ServiceRepository');
        $this->app->bind('App\Backend\Investigation\InvestigationRepositoryInterface','App\Backend\Investigation\InvestigationRepository');
        $this->app->bind('App\Backend\Physicalexam\PhysicalexamRepositoryInterface','App\Backend\Physicalexam\PhysicalexamRepository');
        $this->app->bind('App\Backend\Patient\PatientRepositoryInterface','App\Backend\Patient\PatientRepository');
        $this->app->bind('App\Backend\Search\SearchRepositoryInterface','App\Backend\Search\SearchRepository');
        $this->app->bind('App\Backend\Packagesale\PackageSaleRepositoryInterface','App\Backend\Packagesale\PackageSaleRepository');
        $this->app->bind('App\Backend\Schedule\ScheduleRepositoryInterface','App\Backend\Schedule\ScheduleRepository');
        $this->app->bind('App\Backend\Invoice\InvoiceRepositoryInterface','App\Backend\Invoice\InvoiceRepository');
        $this->app->bind('App\Backend\Presentmedication\PresentmedicationRepositoryInterface','App\Backend\Presentmedication\PresentmedicationRepository');
        $this->app->bind('App\Backend\Patientsurgeryhistory\PatientsurgeryhistoryRepositoryInterface','App\Backend\Patientsurgeryhistory\PatientsurgeryhistoryRepository');
        $this->app->bind('App\Backend\Patientfamilyhistory\PatientfamilyhistoryRepositoryInterface','App\Backend\Patientfamilyhistory\PatientfamilyhistoryRepository');
        $this->app->bind('App\Backend\Familyhistory\FamilyhistoryRepositoryInterface','App\Backend\Familyhistory\FamilyhistoryRepository');
        $this->app->bind('App\Backend\Familymember\FamilymemberRepositoryInterface','App\Backend\Familymember\FamilymemberRepository');
        $this->app->bind('App\Backend\Medicalhistory\MedicalhistoryRepositoryInterface','App\Backend\Medicalhistory\MedicalhistoryRepository');
        $this->app->bind('App\Backend\Patientmedicalhistory\PatientmedicalhistoryRepositoryInterface','App\Backend\Patientmedicalhistory\PatientmedicalhistoryRepository');
        $this->app->bind('App\Backend\Route\RouteRepositoryInterface','App\Backend\Route\RouteRepository');
        $this->app->bind('App\Core\SyncsTable\SyncsTableRepositoryInterface','App\Core\SyncsTable\SyncsTableRepository');
        $this->app->bind('App\Api\Patient\PatientApiRepositoryInterface','App\Api\Patient\PatientApiRepository');
        $this->app->bind('App\Api\Package\PackageApiRepositoryInterface','App\Api\Package\PackageApiRepository');
        $this->app->bind('App\Api\Enquiry\EnquiryApiRepositoryInterface','App\Api\Enquiry\EnquiryApiRepository');
        $this->app->bind('App\Api\Schedule\ScheduleApiRepositoryInterface','App\Api\Schedule\ScheduleApiRepository');
        $this->app->bind('App\Api\Familyhistory\FamilyhistoryApiRepositoryInterface','App\Api\Familyhistory\FamilyhistoryApiRepository');
        $this->app->bind('App\Api\Medicalhistory\MedicalhistoryApiRepositoryInterface','App\Api\Medicalhistory\MedicalhistoryApiRepository');

        $this->app->bind('App\Backend\Provisionaldiagnosis\ProvisionaldiagnosisRepositoryInterface','App\Backend\Provisionaldiagnosis\ProvisionaldiagnosisRepository');
        $this->app->bind('App\Backend\Terminal\TerminalRepositoryInterface','App\Backend\Terminal\TerminalRepository');

        $this->app->bind('App\Api\Invoice\InvoiceApiRepositoryInterface','App\Api\Invoice\InvoiceApiRepository');

        $this->app->bind('App\Backend\LogPatientCaseSummary\LogPatientCaseSummaryRepositoryInterface','App\Backend\LogPatientCaseSummary\LogPatientCaseSummaryRepository');

        $this->app->bind('App\Api\Scheduletreatmenthistory\ScheduletreatmenthistoryApiRepositoryInterface','App\Api\Scheduletreatmenthistory\ScheduletreatmenthistoryApiRepository');
        $this->app->bind('App\Api\Scheduletracking\ScheduletrackingApiRepositoryInterface','App\Api\Scheduletracking\ScheduletrackingApiRepository');
        $this->app->bind('App\Api\Waytracking\WaytrackingApiRepositoryInterface','App\Api\Waytracking\WaytrackingApiRepository');

        $this->app->bind('App\Api\Schedule\ScheduleApiV2RepositoryInterface','App\Api\Schedule\ScheduleApiV2Repository');
    }
}
