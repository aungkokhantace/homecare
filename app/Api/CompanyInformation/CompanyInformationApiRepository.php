<?php
namespace App\Api\CompanyInformation;
use App\Core\ReturnMessage;
use App\Core\Utility;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * Author: Aung Ko Khant
 * Date: 2017-09-28
 * Time: 09:54 AM
 */
class CompanyInformationApiRepository implements CompanyInformationApiRepositoryInterface
{
    public function getObjs(){
        //get information from config
        $tempCompanyName    = DB::select("SELECT * FROM core_configs WHERE code = 'SETTING_COMPANY_NAME' and type = 'SETTING'");
        $tempCompanyAddress = DB::select("SELECT * FROM core_configs WHERE code = 'SETTING_ADDRESS' and type = 'SETTING'");
        $tempCompanyPhone   = DB::select("SELECT * FROM core_configs WHERE code = 'SETTING_CONTACT_PHONE' and type = 'SETTING'");
        $tempCompanyEmail   = DB::select("SELECT * FROM core_configs WHERE code = 'SETTING_CONTACT_EMAIL' and type = 'SETTING'");

        //Start setting default values for company information, if not setup in core_config
        if (isset($tempCompanyName) && count($tempCompanyName) > 0) {
            $company_name       = $tempCompanyName[0]->value;
        }
        else{
            $company_name       = "Parami HHCS";
        }

        if (isset($tempCompanyAddress) && count($tempCompanyAddress) > 0) {
            $company_address    = $tempCompanyAddress[0]->value;
        }
        else{
            $company_address    = "No.(60/A), G-1, New Parami Road, Mayangone Township, Yangon, Myanmar";
        }

        if (isset($tempCompanyPhone) && count($tempCompanyPhone) > 0) {
            $company_phone      = $tempCompanyPhone[0]->value;
        }
        else{
            $company_phone      = "(+95-9) 979909996, 9754013459";
        }

        if (isset($tempCompanyEmail) && count($tempCompanyEmail) > 0) {
            $company_email      = $tempCompanyEmail[0]->value;
        }
        else{
            $company_email      = "gzp.hhcs@gmail.com";
        }
        //End setting default values for company information, if not setup in core_config

        $result = array();
        $result['name'] = $company_name;
        $result['address'] = $company_address;
        $result['contact_phone'] = $company_phone;
        $result['email'] = $company_email;
        return $result;
    }

    // public function getArrays(){
    //     $result = DB::select("SELECT * FROM transaction_promotions");
    //     return $result;
    // }
}