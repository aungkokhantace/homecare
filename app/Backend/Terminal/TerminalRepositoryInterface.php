<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 9/14/2016
 * Time: 6:14 PM
 */

namespace App\Backend\Terminal;


interface TerminalRepositoryInterface
{
    public function getObjs();
    public function create($paramObj);
    public function update($paramObj);
    public function getObjByID($id);
    public function delete($id);
}