<?php
namespace App\Log\PriceHistory;
/**
 * Created by PhpStorm.
 * User: william
 * Author: Wai Yan Aung
 * Date: 12/6/2016
 * Time: 10:35 AM
 */

use DB;

class PriceHistoryRepository
{
    public function getPriceHistory($type,$id){

        try {
            $priceHistories = array();
            // Preparing all setup array for the showing data - Start
            $servicesRaw = DB::select("SELECT * FROM services");
            $packagesRaw = DB::select("SELECT * FROM packages");
            $productsRaw = DB::select("SELECT * FROM products");
            $car_type_setupRaw = DB::select("SELECT * FROM car_type_setup");
//            $investigationsRaw = DB::select("SELECT * FROM investigations");
//            $investigationLabsRaw = DB::select("SELECT * FROM investigation_labs");
            $investigations_imagingsRaw = DB::select("SELECT * FROM investigations_imaging");
            $car_typesRaw = DB::select("SELECT * FROM car_types");
            $zonesRaw = DB::select("SELECT * FROM zones");

            $services = array();
            $packages = array();
            $products = array();
            $car_type_setups = array();
//            $investigations = array();
            $investigationLabs = array();
            $investigations_imagings = array();
            $car_types = array();
            $zones = array();

            foreach($servicesRaw as $service){
                $services[$service->id] = $service;
            }

            foreach($packagesRaw as $package){
                $packages[$package->id] = $package;
            }

            foreach($productsRaw as $product){
                $products[$product->id] = $product;
            }

            foreach($car_type_setupRaw as $car_type_setup){
                $car_type_setups[$car_type_setup->id] = $car_type_setup;
            }

            /*foreach($investigationsRaw as $investigation){
                $investigations[$investigation->id] = $investigation;
            }*/
//            foreach($investigationLabsRaw as $investigationLab){
//                $investigationLabs[$investigationLab->id] = $investigationLab;
//            }

            foreach($investigations_imagingsRaw as $investigations_imaging){
                $investigations_imagings[$investigations_imaging->id] = $investigations_imaging;
            }

            foreach($car_typesRaw as $car_type){
                $car_types[$car_type->id] = $car_type;
            }

            foreach($zonesRaw as $zone){
                $zones[$zone->id] = $zone;
            }
            // Preparing all setup array for the showing data - End

            // Retrieve Data for price history - Start
            if($type == 'all') {
//                $priceHistories = DB::select("SELECT * FROM setup_price_tracking ORDER BY created_at");
                $priceHistories = DB::select("SELECT * FROM setup_price_tracking WHERE table_name != 'investigation_labs' ORDER BY created_at");
            }
            else{
                if($id == 0){
                    $priceHistories = DB::select("SELECT * FROM setup_price_tracking WHERE table_name = '$type'");
                }
                else{
                    $priceHistories = DB::select("SELECT * FROM setup_price_tracking WHERE table_name = '$type' AND table_id = '$id'");
                }
            }
            // Retrieve Data for price history - End

            // Adding name description to setup - start
            if(isset($priceHistories) && count($priceHistories)>0){

                foreach($priceHistories as $keyPrice => $priceHistory){
                    if($priceHistory->table_name == 'services'){
                        $tempName = $services[$priceHistory->table_id]->name;
                        $priceHistories[$keyPrice]->setup_name = $tempName;
                    }
                    if($priceHistory->table_name == 'packages'){
                        $tempName = $packages[$priceHistory->table_id]->package_name;
                        $priceHistories[$keyPrice]->setup_name = $tempName;
                    }
                    if($priceHistory->table_name == 'products'){
                        $tempName = $products[$priceHistory->table_id]->product_name;
                        $priceHistories[$keyPrice]->setup_name = $tempName;
                    }
                    if($priceHistory->table_name == 'car_type_setup'){

                        $car_type_id = $car_type_setups[$priceHistory->table_id]->car_type_id;
                        $zone_id = $car_type_setups[$priceHistory->table_id]->zone_id;

                        $tempName = $zones[$zone_id]->name . ' == ' . $car_types[$car_type_id]->name;
                        $priceHistories[$keyPrice]->setup_name = $tempName;
                    }
                    /*if($priceHistory->table_name == 'investigations'){
                        $tempName = $investigations[$priceHistory->table_id]->name;
                        $priceHistories[$keyPrice]->setup_name = $tempName;
                    }*/
//                    if($priceHistory->table_name == 'investigation_labs'){
//                        $tempName = $investigationLabs[$priceHistory->table_id]->service_name;
//                        $priceHistories[$keyPrice]->setup_name = $tempName;
//                    }
                    if($priceHistory->table_name == 'investigations_imaging'){
                        $tempName = $investigations_imagings[$priceHistory->table_id]->service_name;
                        $priceHistories[$keyPrice]->setup_name = $tempName;
                    }
                }
            }
            // Adding name description to setup - End
            return $priceHistories;
        }
        catch(\Exception $e){
            return redirect('/');
        }
    }

    public function getMultiplePriceHistory($type,$id){

        try {
            $priceHistories = array();
            // Preparing all setup array for the showing data - Start
            $investigationLabsRaw = DB::select("SELECT * FROM investigation_labs");

            $investigationLabs = array();

            foreach($investigationLabsRaw as $investigationLab){
                $investigationLabs[$investigationLab->id] = $investigationLab;
            }
            // Preparing all setup array for the showing data - End

            // Retrieve Data for price history - Start
            if($type == 'all') {
                $priceHistories = DB::select("SELECT * FROM setup_price_tracking WHERE table_name = 'investigation_labs' ORDER BY created_at");
            }
            else{
                if($id == 0){
                    $priceHistories = DB::select("SELECT * FROM setup_price_tracking WHERE table_name = '$type'");
                }
                else{
                    $priceHistories = DB::select("SELECT * FROM setup_price_tracking WHERE table_name = '$type' AND table_id = '$id'");
                }
            }
            // Retrieve Data for price history - End

            // Adding name description to setup - start
            if(isset($priceHistories) && count($priceHistories)>0){

                foreach($priceHistories as $keyPrice => $priceHistory){
                    if($priceHistory->table_name == 'investigation_labs'){
                        $tempName = $investigationLabs[$priceHistory->table_id]->service_name;
                        $priceHistories[$keyPrice]->setup_name = $tempName;
                    }
                }
            }
            // Adding name description to setup - End
            return $priceHistories;
        }
        catch(\Exception $e){
            return redirect('/');
        }
    }
}