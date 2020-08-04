<?php

namespace App\Http\Controllers\CSVImport;

use App\Backend\Product\Product;
use App\Backend\Productcategory\Productcategory;
use App\Core\FormatGenerator;
use App\Core\ReturnMessage;
use App\CSVImport\CSVImportRepository;
use App\CSVImport\Form\CSVImportRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Auth;
use Alert;

class CSVImportController extends Controller
{

    public function import(){

        return view('import.import');
    }
    /*
    public function store(){
        $table_name = Input::get('table_name');
        $csv        = Input::file('csv');

        $column_names = Schema::getColumnListing($table_name); //get column names of table

        $remove_columns = array('id','created_by','updated_by','deleted_by','created_at','updated_at','deleted_at');
        foreach($column_names as $name){
            if(!in_array($name,$remove_columns)){
                $column_name[] = $name;
            }
        }
        $columns  = implode(",",$column_name);
        $handle = fopen($csv, "r");

        $c = 0;

        while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {

            $values = implode("','",$filesop);


            DB::insert("INSERT INTO $table_name ($columns,created_by) VALUES ('$values','U0001')");

            $c = $c + 1;
        }

        return view('backend.import.import');
    }*/

    public function store(CSVImportRequest $request){
        $request->validate();
        $table_name = Input::get('table_name');
        $csv        = Input::file('csv_file');

        $result['aceplusStatusCode']    = ReturnMessage::INTERNAL_SERVER_ERROR;
        $result['aceplusStatusMessage'] = "";
        try{
            DB::beginTransaction();

            $handle = fopen($csv, "r");
            $c = 0;
            $csvRepo = new CSVImportRepository();
            $today   = Carbon::now()->format('Y-m-d H:i:s');
            $user_id = Auth::guard('User')->user()->id;
            $product_category_name = Productcategory::whereNull('deleted_at')->get();
            while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
            {
                $values = implode("','",$filesop);

                if($table_name == 'product_categories'){
                    $result = $csvRepo->createProductCategories($values,$user_id,$today);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){

                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                if($table_name == 'products'){
                    $p_name        = $filesop[0];
                    $category_name = $filesop[1];
                    $price          = $filesop[2];
                    $description    = $filesop[3];

                    foreach($product_category_name as $name){
                        if($name->name == $category_name){
                            $category_id = $name->id;
                        }
                    }

                    $result = $csvRepo->createProducts($p_name,$category_id,$price,$description,$user_id,$today);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                if($table_name == 'family_histories'){
                    $result = $csvRepo->createFamilyHistories($values,$user_id,$today);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){
                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                if($table_name == 'medical_history'){

                    $result = $csvRepo->createMedicalHistory($values,$user_id,$today);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){

                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                if($table_name == 'provisional_diagnosis'){

                    $result = $csvRepo->createProvisionalDiagnosis($values,$user_id,$today);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){

                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                if($table_name == 'allergies'){

                    $result = $csvRepo->createAllergies($values,$user_id,$today);
                    if($result['aceplusStatusCode'] != ReturnMessage::OK){

                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                if($table_name == 'investigation_labs'){
                    $result = $csvRepo->createInvestigationLabs($values,$user_id,$today);
                    if($result['aceplusStatusCode'] !== ReturnMessage::OK){
                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                if($table_name == 'townships'){
                    $result = $csvRepo->createTownships($values,$user_id,$today);
                    if($result['aceplusStatusCode'] !== ReturnMessage::OK){
                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                if($table_name == 'zones'){
                    $result = $csvRepo->createZones($values,$user_id,$today);
                    if($result['aceplusStatusCode'] !== ReturnMessage::OK){
                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                if($table_name == 'zone_detail'){
                    $result = $csvRepo->createZoneDetail($values,$user_id,$today);
                    if($result['aceplusStatusCode'] !== ReturnMessage::OK){
                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                if($table_name == 'car_type_setup'){
                    $result = $csvRepo->createCarTypeSetup($values,$user_id,$today);
                    if($result['aceplusStatusCode'] !== ReturnMessage::OK){
                        DB::rollback();
                        alert()->error('Error Message', 'Sorry! There is some problem.')->persistent('Close');

                        return redirect()->action('CSVImport\CSVImportController@import');
                    }
                }

                $c = $c + 1;
            }

            DB::commit();
            alert()->success('Success Message', 'Table has imported successfully')->persistent('Close');
            return redirect()->action('CSVImport\CSVImportController@import');


        }catch(\Exception $e){
            DB::rollback();
        }
    }
}
