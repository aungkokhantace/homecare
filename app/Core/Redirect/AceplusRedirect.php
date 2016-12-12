<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 6/30/2016
 * Time: 2:42 PM
 */
namespace App\Core\Redirect;

use Redirect;
class AceplusRedirect implements AceplusRedirectInterface {

    public function firstRedirect() {
        return Redirect::intended("/dashboard");
    }

    public function firstRedirectPath() {
        return "dashboard";
    }


    public function afterAuthedRedirect() {
        return Redirect::intended("/dashboard");
    }

    public function afterAuthedRedirectPath() {
        return "/dashboard";
    }

}