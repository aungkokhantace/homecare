<?php
namespace App\Api\Route;
/**
 * Created by PhpStorm.
 * Author: Khin Zar Ni Wint
 * Date: 10/17/2016
 * Time: 6:02 PM
 */
interface RouteApiRepositoryInterface
{
    public function route($data);
    public function getRouteArray();
}