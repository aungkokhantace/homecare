<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::guard('User')->check()) {
            $users = DB::select("SELECT count(id) as userCount FROM core_users WHERE deleted_at IS  NULL AND role_id != 5");
            $user_count = 0;
            if (isset($users) && count($users) > 0) {
                $user_count = $users[0]->userCount;
            }

            $patient_count = 0;
            $patients = DB::select("SELECT count(user_id) as patientCount FROM patients WHERE deleted_at IS  NULL");
            if(isset($patients) && count($patients) > 0){
                $patient_count = $patients[0]->patientCount;
            }

            $family_member_count = 0;
            $familyMembers = DB::select("SELECT count(id) as familyMemberCount FROM patient_family_member WHERE deleted_at IS  NULL");
            if(isset($familyMembers) && count($familyMembers) > 0){
                $family_member_count = $familyMembers[0]->familyMemberCount;
            }

            $schedule_count = 0;
            $schedules = DB::select("SELECT count(id) as scheduleCount FROM schedules WHERE deleted_at IS  NULL");
            if(isset($schedules) && count($schedules) > 0){
                $schedule_count = $schedules[0]->scheduleCount;
            }

            $enquiry_count = 0;
            $enquiries = DB::select("SELECT count(id) as enquiryCount FROM enquiries WHERE deleted_at IS  NULL");
            if(isset($enquiries) && count($enquiries) > 0){
                $enquiry_count = $enquiries[0]->enquiryCount;
            }

            $route_count = 0;
            $routes = DB::select("SELECT count(id) as routeCount FROM route WHERE deleted_at IS  NULL");
            if(isset($routes) && count($routes) > 0){
                $route_count = $routes[0]->routeCount;
            }

            $city_count = 0;
            $cities = DB::select("SELECT count(id) as cityCount FROM cities WHERE deleted_at IS  NULL");
            if(isset($cities) && count($cities) > 0){
                $city_count = $cities[0]->cityCount;
            }

            $township_count = 0;
            $townships = DB::select("SELECT count(id) as townshipCount FROM townships WHERE deleted_at IS  NULL");
            if(isset($townships) && count($townships) > 0){
                $township_count = $townships[0]->townshipCount;
            }

            $zone_count = 0;
            $zones = DB::select("SELECT count(id) as zoneCount FROM zones WHERE deleted_at IS  NULL");
            if(isset($zones) && count($zones) > 0){
                $zone_count = $zones[0]->zoneCount;
            }

            $car_type_count = 0;
            $carTypes = DB::select("SELECT count(id) as carTypeCount FROM car_types WHERE deleted_at IS  NULL");
            if(isset($carTypes) && count($carTypes) > 0){
                $car_type_count = $carTypes[0]->carTypeCount;
            }

            $medication_category_count = 0;
            $medicationCategories = DB::select("SELECT count(id) as medicationCategoryCount FROM zones WHERE deleted_at IS  NULL");
            if(isset($medicationCategories) && count($medicationCategories) > 0){
                $medication_category_count = $medicationCategories[0]->medicationCategoryCount;
            }

            $medication_count = 0;
            $medications = DB::select("SELECT count(id) as medicationCount FROM products WHERE deleted_at IS  NULL");
            if(isset($medications) && count($medications) > 0){
                $medication_count = $medications[0]->medicationCount;
            }

            $allergy_count = 0;
            $allergies = DB::select("SELECT count(id) as allergyCount FROM allergies WHERE deleted_at IS  NULL");
            if(isset($allergies) && count($allergies) > 0){
                $allergy_count = $allergies[0]->allergyCount;
            }

            $service_count = 0;
            $services = DB::select("SELECT count(id) as serviceCount FROM services WHERE deleted_at IS  NULL");
            if(isset($services) && count($services) > 0){
                $service_count = $services[0]->serviceCount;
            }

            $package_count = 0;
            $packages = DB::select("SELECT count(id) as packageCount FROM packages WHERE deleted_at IS  NULL");
            if(isset($packages) && count($packages) > 0){
                $package_count = $packages[0]->packageCount;
            }

            $family_history_count = 0;
            $familyHistories = DB::select("SELECT count(id) as familyHistoryCount FROM family_histories WHERE deleted_at IS  NULL");
            if(isset($familyHistories) && count($familyHistories) > 0){
                $family_history_count = $familyHistories[0]->familyHistoryCount;
            }

            $medical_history_count = 0;
            $medicalHistories = DB::select("SELECT count(id) as medicalHistoryCount FROM medical_history WHERE deleted_at IS  NULL");
            if(isset($medicalHistories) && count($medicalHistories) > 0){
                $medical_history_count = $medicalHistories[0]->medicalHistoryCount;
            }

            $provisional_diagnosis_count = 0;
            $provisionalDiagnosis = DB::select("SELECT count(id) as provisionalDiagnosisCount FROM provisional_diagnosis WHERE deleted_at IS  NULL");
            if(isset($provisionalDiagnosis) && count($provisionalDiagnosis) > 0){
                $provisional_diagnosis_count = $provisionalDiagnosis[0]->provisionalDiagnosisCount;
            }

            return view('core.dashboard.dashboard')
                ->with('userCount', $user_count)
                ->with('patientCount',$patient_count)
                ->with('familyMemberCount',$family_member_count)
                ->with('scheduleCount',$schedule_count)
                ->with('enquiryCount',$enquiry_count)
                ->with('routeCount',$route_count)
                ->with('cityCount',$city_count)
                ->with('townshipCount',$township_count)
                ->with('zoneCount',$zone_count)
                ->with('carTypeCount',$car_type_count)
                ->with('medicationCategoryCount',$medication_category_count)
                ->with('medicationCount',$medication_count)
                ->with('allergyCount',$allergy_count)
                ->with('serviceCount',$service_count)
                ->with('packageCount',$package_count)
                ->with('familyHistoryCount',$family_history_count)
                ->with('medicalHistoryCount',$medical_history_count)
                ->with('provisionalDiagnosisCount',$provisional_diagnosis_count);
        }
        return redirect('/login');
    }
}
