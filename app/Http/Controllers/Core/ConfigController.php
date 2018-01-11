<?php namespace App\Http\Controllers\Core;

use App\Core\Config\Config;
use App\Core\Config\ConfigRepositoryInterface;
use App\Log\LogCustom;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use InterventionImage;
use App\Core\Utility;

class ConfigController extends Controller
{
    private $ConfigRepository;
    public $tbConfig = "";

    public function __construct(ConfigRepositoryInterface $ConfigRepository)
    {
        $this->ConfigRepository = $ConfigRepository;
        $this->tbConfig = (new Config())->getTable();
    }

    public function edit(){
        if (Auth::guard('User')->check()) {

            $configs      = $this->ConfigRepository->getSiteConfigs();
            $taxPercent   = Utility::getTaxRate();
            $maxDiscountTime   = Utility::getMaxDiscountTime();

            if (is_null($configs) || count($configs) == 0)
            {
                $configs = array();
                $configs['SETTING_COMPANY_NAME'] = "";
                $configs['SETTING_LOGO'] = "";
                $configs['SETTING_SITE_ACTIVATION_KEY'] = "";
                $configs['MAX_DISCOUNT_TIME'] = "";

                $configs['SETTING_ADDRESS'] = "";
                $configs['SETTING_CONTACT_PHONE'] = "";
                $configs['SETTING_CONTACT_EMAIL'] = "";

                return view('core.config.config')->with('configs', $configs);
            }

            $tempConfigs = array();
            foreach($configs as $config){
                $tempCode = $config->code;
                $tempValue = $config->value;
                $tempConfigs[$tempCode] = $tempValue;
            }

            if(!array_key_exists("SETTING_LOGO",$tempConfigs)){
                $tempConfigs["SETTING_LOGO"] = "/images/aceplus_logo.png";
            }

            if(array_key_exists("SETTING_LOGO",$tempConfigs) && $tempConfigs['SETTING_LOGO'] == ""){
                $tempConfigs["SETTING_LOGO"] = "/images/aceplus_logo.png";
            }

            if(!array_key_exists("SETTING_COMPANY_NAME",$tempConfigs)){
                $tempConfigs["SETTING_COMPANY_NAME"] = "";
            }

            if(!array_key_exists("SETTING_SITE_ACTIVATION_KEY",$tempConfigs)){
                $tempConfigs["SETTING_SITE_ACTIVATION_KEY"] = "";
            }
            $tempConfigs["TAX_RATE"] = $taxPercent;

            $tempConfigs["MAX_DISCOUNT_TIME"] = $maxDiscountTime;

            if(!array_key_exists("SETTING_ADDRESS",$tempConfigs)){
                $tempConfigs["SETTING_ADDRESS"] = "";
            }

            if(!array_key_exists("SETTING_CONTACT_PHONE",$tempConfigs)){
                $tempConfigs["SETTING_CONTACT_PHONE"] = "";
            }

            if(!array_key_exists("SETTING_CONTACT_EMAIL",$tempConfigs)){
                $tempConfigs["SETTING_CONTACT_EMAIL"] = "";
            }

            return view('core.config.config')->with('configs', $tempConfigs);

        }
        return redirect('/login');
    }

    public function update(){
        if (Auth::guard('User')->check()) {

            $SETTING_COMPANY_NAME = Input::get('SETTING_COMPANY_NAME');
            // $SETTING_SITE_ACTIVATION_KEY = Input::get('SETTING_SITE_ACTIVATION_KEY');
            $removeImageFlag = Input::get('removeImageFlag');
            $TAX_RATE = Input::get('TAX_RATE');
            $MAX_DISCOUNT_TIME = Input::get('MAX_DISCOUNT_TIME');

            $SETTING_ADDRESS        = Input::get('SETTING_ADDRESS');
            $SETTING_CONTACT_PHONE  = Input::get('SETTING_CONTACT_PHONE');
            $SETTING_CONTACT_EMAIL  = Input::get('SETTING_CONTACT_EMAIL');

            $currentUser = Utility::getCurrentUserID(); //get currently logged in user

            try{

                $loginUserId = "U0001";
                $sessionObj = session('user');
                if(isset($sessionObj)){
                    $userSession = session('user');
                    $loginUserId = $userSession['id'];
                }
                $updated_at = date('Y-m-d H:m:i');

                $oldSiteLogo = DB::select("SELECT * FROM `$this->tbConfig` WHERE `code` = 'SETTING_LOGO'");

                DB::statement("DELETE FROM `$this->tbConfig` WHERE `code` = 'SETTING_COMPANY_NAME'");
                $result = DB::statement("INSERT INTO `$this->tbConfig` (code,type,value,description,updated_by,updated_at) VALUES ('SETTING_COMPANY_NAME','SETTING','$SETTING_COMPANY_NAME','Company Name','$loginUserId','$updated_at')");

                /*
                DB::statement("DELETE FROM `$this->tbConfig` WHERE `code` = 'SETTING_SITE_ACTIVATION_KEY'");
                $result = DB::statement("INSERT INTO `$this->tbConfig` (code,type,value,description,updated_by,updated_at) VALUES ('SETTING_SITE_ACTIVATION_KEY','SETTING','$SETTING_SITE_ACTIVATION_KEY','Site Activation Key','$loginUserId','$updated_at')");
                */

                DB::statement("DELETE FROM `core_settings` WHERE `code` = 'TAX_RATE' AND `type` = 'TAX_RATE'");
                $result = DB::statement("INSERT INTO `core_settings` (code,type,value,description,updated_by,updated_at) VALUES ('TAX_RATE','TAX_RATE','$TAX_RATE','Tax Rate','$loginUserId','$updated_at')");

                DB::statement("DELETE FROM `core_settings` WHERE `code` = 'MAX_DISCOUNT_TIME' AND `type` = 'MAX_DISCOUNT_TIME'");
                $result = DB::statement("INSERT INTO `core_settings` (code,type,value,description,updated_by,updated_at) VALUES ('MAX_DISCOUNT_TIME','MAX_DISCOUNT_TIME','$MAX_DISCOUNT_TIME','Maximum time that discount coupon can be used','$loginUserId','$updated_at')");

                DB::statement("DELETE FROM `$this->tbConfig` WHERE `code` = 'SETTING_ADDRESS'");
                $result = DB::statement("INSERT INTO `$this->tbConfig` (code,type,value,description,updated_by,updated_at) VALUES ('SETTING_ADDRESS','SETTING','$SETTING_ADDRESS','Company Address','$loginUserId','$updated_at')");

                DB::statement("DELETE FROM `$this->tbConfig` WHERE `code` = 'SETTING_CONTACT_PHONE'");
                $result = DB::statement("INSERT INTO `$this->tbConfig` (code,type,value,description,updated_by,updated_at) VALUES ('SETTING_CONTACT_PHONE','SETTING','$SETTING_CONTACT_PHONE','Company Contact Phone','$loginUserId','$updated_at')");

                DB::statement("DELETE FROM `$this->tbConfig` WHERE `code` = 'SETTING_CONTACT_EMAIL'");
                $result = DB::statement("INSERT INTO `$this->tbConfig` (code,type,value,description,updated_by,updated_at) VALUES ('SETTING_CONTACT_EMAIL','SETTING','$SETTING_CONTACT_EMAIL','Company Contact Email','$loginUserId','$updated_at')");

                $path = base_path().'/public/images';
                $path2 = base_path().'/public';

                // saving image
                if(Input::hasFile('site_logo'))
                {
                    $file = Input::file('site_logo');

                    if ( ! file_exists($path))
                    {
                        mkdir($path, 0777, true);
                    }
                    $extension = Input::file('site_logo')->getClientOriginalExtension();
                    $img_name = uniqid().'.' .$extension;

                    $SETTING_LOGO = '/images/' .$img_name;
                    DB::statement("DELETE FROM `$this->tbConfig` WHERE `code` = 'SETTING_LOGO'");
                    $result = DB::statement("INSERT INTO `$this->tbConfig` (code,type,value,description,updated_by,updated_at) VALUES ('SETTING_LOGO','SETTING','$SETTING_LOGO','Company Logo','$loginUserId','$updated_at')");

                    // moving image into image folder
                    $file->move($path, $img_name);

                    $rWidth = 1.0;
                    $rHeight =  1.0;

                    // getting image width and height
                    $imgData = getimagesize($path . '/' . $img_name);
                    $width = $imgData[0];
                    $imgWidth = $width * $rWidth;
                    $height = $imgData[1];
                    $imgHeight = $height * $rHeight;

                    // resizing image
                    $image = InterventionImage::make(sprintf($path .'/%s', $img_name))->resize($imgWidth, $imgHeight)->save();

                    if(isset($oldSiteLogo) && count($oldSiteLogo)>0){
                        $oldLogo = $oldSiteLogo[0]->value;
                        Utility::deleteImage($path2 . $oldLogo);
                    }

                }
                if($removeImageFlag == 1){

                    if(isset($oldSiteLogo) && count($oldSiteLogo)>0){
                        $oldLogo = $oldSiteLogo[0]->value;
                        Utility::deleteImage($path2 . $oldLogo);
                    }

                    DB::statement("DELETE FROM `$this->tbConfig` WHERE `code` = 'SETTING_LOGO'");
                    $result = DB::statement("INSERT INTO `$this->tbConfig` (code,type,value,description,updated_by,updated_at) VALUES ('SETTING_LOGO','SETTING','','Company Logo','$loginUserId','$updated_at')");
                }

                //update info log
                $date = $updated_at;
                $message = '['. $date .'] '. 'info: ' . 'User '.$currentUser.' updated site_config. '. PHP_EOL;
                LogCustom::create($date,$message);

                return redirect()->action('Core\ConfigController@edit');

            }
            catch(Exception $ex){
                //update error log
                $date    = date("Y-m-d H:i:s");
                $message = '['. $date .'] '. 'error: ' . 'User '.$currentUser.' updated site_config and got error -------'.$ex->getMessage(). ' ----- line ' .$ex->getLine(). ' ----- ' .$ex->getFile(). PHP_EOL;
                LogCustom::create($date,$message);

                return redirect()->action('Core\ConfigController@edit');
//                    return Redirect::to('backend/posconfig/1/edit')
//                        ->withMessage(FormatGenerator::message('Fail', $ex->getMessage()));
            }

        }
        return redirect('/login');
    }

}
