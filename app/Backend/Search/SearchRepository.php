<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/29/2016
 * Time: 1:25 PM
 */

namespace App\Backend\Search;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Core\Utility;
use App\Core\ReturnMessage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Core\FormatGenerator As FormatGenerator;
use App\Backend\Package\PackageRepository;

class SearchRepository implements  SearchRepositoryInterface
{

    public function getAutoCompletePatient(){
        $term = Input::get('term');
        $results = array();
        $patients = DB::select("SELECT * FROM patients WHERE name like  '%$term%'");

        foreach ($patients as $patient)
        {
            $patient_id = $patient->user_id;
            $patientAllergiesRaw = DB::select("SELECT allergy_id FROM patient_allergy WHERE patient_id = '$patient_id'");
            $patientAllergies = array();
            if(isset($patientAllergiesRaw) && count($patientAllergiesRaw)>0){
                foreach ($patientAllergiesRaw as $key => $allergy) {
                    $patientAllergies[$key] = $allergy->allergy_id;
                }
            }

            $packageRepo        = new PackageRepository();
            $packageRaws        = $packageRepo->getPackageByPatientId($patient_id);
            $packages           = "";

            if(isset($packageRaws) && count($packageRaws)>0) {
                foreach($packageRaws as $packageRaw){
                    $packages .= $packageRaw->package_name . "<br>";
                }
            }

            $results[] = [ 'id' => $patient->user_id, 'value' => $patient->name, 'nrc_no' => $patient->nrc_no, 'phone_no' => $patient->phone_no, 'patient_type_id' => $patient->patient_type_id, 'dob' => $patient->dob, 'patient_id' => $patient->user_id, 'gender' => $patient->gender, 'allergies' => $patientAllergies, 'packages' => $packages, 'staff_id' => $patient->user_id, 'having_allergy' => $patient->having_allergy ];
        }
        return $results;
    }

}