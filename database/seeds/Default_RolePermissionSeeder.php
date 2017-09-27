<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/4/2016
 * Time: 3:04 PM
 */

use Illuminate\Database\Seeder;

class Default_RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_permission_role')->delete();

        $roles = array(

            // Roles
            ['role_id'=>1, 'permission_id'=>1],
            ['role_id'=>1, 'permission_id'=>2],
            ['role_id'=>1, 'permission_id'=>3],
            ['role_id'=>1, 'permission_id'=>4],
            ['role_id'=>1, 'permission_id'=>5],
            ['role_id'=>1, 'permission_id'=>6],
            ['role_id'=>1, 'permission_id'=>7],
            ['role_id'=>1, 'permission_id'=>8],

            // Users
            ['role_id'=>1, 'permission_id'=>10],
            ['role_id'=>1, 'permission_id'=>11],
            ['role_id'=>1, 'permission_id'=>12],
            ['role_id'=>1, 'permission_id'=>13],
            ['role_id'=>1, 'permission_id'=>14],
            ['role_id'=>1, 'permission_id'=>15],
            ['role_id'=>1, 'permission_id'=>16],
            ['role_id'=>1, 'permission_id'=>17],
            ['role_id'=>1, 'permission_id'=>18],
            ['role_id'=>1, 'permission_id'=>19],

            // Permissions
            ['role_id'=>1, 'permission_id'=>20],
            ['role_id'=>1, 'permission_id'=>21],
            ['role_id'=>1, 'permission_id'=>22],
            ['role_id'=>1, 'permission_id'=>23],
            ['role_id'=>1, 'permission_id'=>24],
            ['role_id'=>1, 'permission_id'=>25],
            ['role_id'=>1, 'permission_id'=>26],

            // City
            ['role_id'=>1, 'permission_id'=>30],
            ['role_id'=>1, 'permission_id'=>31],
            ['role_id'=>1, 'permission_id'=>32],
            ['role_id'=>1, 'permission_id'=>33],
            ['role_id'=>1, 'permission_id'=>34],
            ['role_id'=>1, 'permission_id'=>35],

            // Township
            ['role_id'=>1, 'permission_id'=>40],
            ['role_id'=>1, 'permission_id'=>41],
            ['role_id'=>1, 'permission_id'=>42],
            ['role_id'=>1, 'permission_id'=>43],
            ['role_id'=>1, 'permission_id'=>44],
            ['role_id'=>1, 'permission_id'=>45],

            // Cartype
            ['role_id'=>1, 'permission_id'=>50],
            ['role_id'=>1, 'permission_id'=>51],
            ['role_id'=>1, 'permission_id'=>52],
            ['role_id'=>1, 'permission_id'=>53],
            ['role_id'=>1, 'permission_id'=>54],
            ['role_id'=>1, 'permission_id'=>55],

            // Zone
            ['role_id'=>1, 'permission_id'=>60],
            ['role_id'=>1, 'permission_id'=>61],
            ['role_id'=>1, 'permission_id'=>62],
            ['role_id'=>1, 'permission_id'=>63],
            ['role_id'=>1, 'permission_id'=>64],
            ['role_id'=>1, 'permission_id'=>65],

            // Cartypesetup
            ['role_id'=>1, 'permission_id'=>70],
            ['role_id'=>1, 'permission_id'=>71],
            ['role_id'=>1, 'permission_id'=>72],
            ['role_id'=>1, 'permission_id'=>73],
            ['role_id'=>1, 'permission_id'=>74],
            ['role_id'=>1, 'permission_id'=>75],

            // Product Category
            ['role_id'=>1, 'permission_id'=>80],
            ['role_id'=>1, 'permission_id'=>81],
            ['role_id'=>1, 'permission_id'=>82],
            ['role_id'=>1, 'permission_id'=>83],
            ['role_id'=>1, 'permission_id'=>84],
            ['role_id'=>1, 'permission_id'=>85],

            // Product
            ['role_id'=>1, 'permission_id'=>90],
            ['role_id'=>1, 'permission_id'=>91],
            ['role_id'=>1, 'permission_id'=>92],
            ['role_id'=>1, 'permission_id'=>93],
            ['role_id'=>1, 'permission_id'=>94],
            ['role_id'=>1, 'permission_id'=>95],

            // Package
            ['role_id'=>1, 'permission_id'=>100],
            ['role_id'=>1, 'permission_id'=>101],
            ['role_id'=>1, 'permission_id'=>102],
            ['role_id'=>1, 'permission_id'=>103],
            ['role_id'=>1, 'permission_id'=>104],
            ['role_id'=>1, 'permission_id'=>105],
            ['role_id'=>1, 'permission_id'=>106],
            ['role_id'=>1, 'permission_id'=>107],
            ['role_id'=>1, 'permission_id'=>108],


            // Investigation
            ['role_id'=>1, 'permission_id'=>110],
            ['role_id'=>1, 'permission_id'=>111],
            ['role_id'=>1, 'permission_id'=>112],
            ['role_id'=>1, 'permission_id'=>113],
            ['role_id'=>1, 'permission_id'=>114],
            ['role_id'=>1, 'permission_id'=>115],

            // Physical Examination
            ['role_id'=>1, 'permission_id'=>120],
            ['role_id'=>1, 'permission_id'=>121],
            ['role_id'=>1, 'permission_id'=>122],
            ['role_id'=>1, 'permission_id'=>123],
            ['role_id'=>1, 'permission_id'=>124],
            ['role_id'=>1, 'permission_id'=>125],

            // Service
            ['role_id'=>1, 'permission_id'=>130],
            ['role_id'=>1, 'permission_id'=>131],
            ['role_id'=>1, 'permission_id'=>132],
            ['role_id'=>1, 'permission_id'=>133],
            ['role_id'=>1, 'permission_id'=>134],
            ['role_id'=>1, 'permission_id'=>135],

            // Enquiry
            ['role_id'=>1, 'permission_id'=>140],
            ['role_id'=>1, 'permission_id'=>141],
            ['role_id'=>1, 'permission_id'=>142],
            ['role_id'=>1, 'permission_id'=>143],
            ['role_id'=>1, 'permission_id'=>144],
            ['role_id'=>1, 'permission_id'=>145],
            ['role_id'=>1, 'permission_id'=>146],
            ['role_id'=>1, 'permission_id'=>147],
            ['role_id'=>1, 'permission_id'=>148],

            // Allergy
            ['role_id'=>1, 'permission_id'=>150],
            ['role_id'=>1, 'permission_id'=>151],
            ['role_id'=>1, 'permission_id'=>152],
            ['role_id'=>1, 'permission_id'=>153],
            ['role_id'=>1, 'permission_id'=>154],
            ['role_id'=>1, 'permission_id'=>155],

            // Patient
            ['role_id'=>1, 'permission_id'=>160],
            ['role_id'=>1, 'permission_id'=>161],
            ['role_id'=>1, 'permission_id'=>162],
            ['role_id'=>1, 'permission_id'=>163],
            ['role_id'=>1, 'permission_id'=>164],
            ['role_id'=>1, 'permission_id'=>165],
            ['role_id'=>1, 'permission_id'=>166],
            ['role_id'=>1, 'permission_id'=>167],
            ['role_id'=>1, 'permission_id'=>168],

            // Schedule
            ['role_id'=>1, 'permission_id'=>200],
            ['role_id'=>1, 'permission_id'=>201],
            ['role_id'=>1, 'permission_id'=>202],
            ['role_id'=>1, 'permission_id'=>203],
            ['role_id'=>1, 'permission_id'=>204],
            ['role_id'=>1, 'permission_id'=>205],
            ['role_id'=>1, 'permission_id'=>206],
            ['role_id'=>1, 'permission_id'=>207],

            // Package Sale
            ['role_id'=>1, 'permission_id'=>210],
            ['role_id'=>1, 'permission_id'=>211],
            ['role_id'=>1, 'permission_id'=>212],
            ['role_id'=>1, 'permission_id'=>213],
            ['role_id'=>1, 'permission_id'=>214],
            ['role_id'=>1, 'permission_id'=>215],

            // Family History
            ['role_id'=>1, 'permission_id'=>220],
            ['role_id'=>1, 'permission_id'=>221],
            ['role_id'=>1, 'permission_id'=>222],
            ['role_id'=>1, 'permission_id'=>223],
            ['role_id'=>1, 'permission_id'=>224],
            ['role_id'=>1, 'permission_id'=>225],

            // Family Member
            ['role_id'=>1, 'permission_id'=>230],
            ['role_id'=>1, 'permission_id'=>231],
            ['role_id'=>1, 'permission_id'=>232],
            ['role_id'=>1, 'permission_id'=>233],
            ['role_id'=>1, 'permission_id'=>234],
            ['role_id'=>1, 'permission_id'=>235],

            // Patient Family History
            ['role_id'=>1, 'permission_id'=>240],
            ['role_id'=>1, 'permission_id'=>241],
            ['role_id'=>1, 'permission_id'=>242],
            ['role_id'=>1, 'permission_id'=>243],
            ['role_id'=>1, 'permission_id'=>244],
            ['role_id'=>1, 'permission_id'=>245],

            // Medical History
            ['role_id'=>1, 'permission_id'=>250],
            ['role_id'=>1, 'permission_id'=>251],
            ['role_id'=>1, 'permission_id'=>252],
            ['role_id'=>1, 'permission_id'=>253],
            ['role_id'=>1, 'permission_id'=>254],
            ['role_id'=>1, 'permission_id'=>255],

            // Patient Medical History
            ['role_id'=>1, 'permission_id'=>260],
            ['role_id'=>1, 'permission_id'=>261],
            ['role_id'=>1, 'permission_id'=>262],
            ['role_id'=>1, 'permission_id'=>263],
            ['role_id'=>1, 'permission_id'=>264],
            ['role_id'=>1, 'permission_id'=>265],

            // Patient Surgery History
            ['role_id'=>1, 'permission_id'=>270],
            ['role_id'=>1, 'permission_id'=>271],
            ['role_id'=>1, 'permission_id'=>272],
            ['role_id'=>1, 'permission_id'=>273],
            ['role_id'=>1, 'permission_id'=>274],
            ['role_id'=>1, 'permission_id'=>275],

            // Provisional Diagnosis
            ['role_id'=>1, 'permission_id'=>280],
            ['role_id'=>1, 'permission_id'=>281],
            ['role_id'=>1, 'permission_id'=>282],
            ['role_id'=>1, 'permission_id'=>283],
            ['role_id'=>1, 'permission_id'=>284],
            ['role_id'=>1, 'permission_id'=>285],

            // Route
            ['role_id'=>1, 'permission_id'=>290],
            ['role_id'=>1, 'permission_id'=>291],
            ['role_id'=>1, 'permission_id'=>292],
            ['role_id'=>1, 'permission_id'=>293],
            ['role_id'=>1, 'permission_id'=>294],
            ['role_id'=>1, 'permission_id'=>295],


            // Patient View Permissions
            // role_id 5 is patient role
            ['role_id'=>5, 'permission_id'=>16],

            // Patient profile
            ['role_id'=>5, 'permission_id'=>170],

            // Patient case
            ['role_id'=>5, 'permission_id'=>171],

            // Patient Export
            ['role_id'=>5, 'permission_id'=>172],

            // Patient Schedule History
            ['role_id'=>5, 'permission_id'=>173],

            // Patient Service History
            ['role_id'=>5, 'permission_id'=>174],

            // Patient Pakage History
            ['role_id'=>5, 'permission_id'=>175],

            // Patient Booking Request
            ['role_id'=>5, 'permission_id'=>176],
            ['role_id'=>5, 'permission_id'=>177],

            // Patient Invoice
            ['role_id'=>5, 'permission_id'=>178],
            ['role_id'=>5, 'permission_id'=>179],
            ['role_id'=>5, 'permission_id'=>180],

            // Patient Present Medications
            ['role_id'=>5, 'permission_id'=>181],

            //Report Permissions
            ['role_id'=>1, 'permission_id'=>1001],
            ['role_id'=>1, 'permission_id'=>1002],
            ['role_id'=>1, 'permission_id'=>1003],
            ['role_id'=>1, 'permission_id'=>1004],
            ['role_id'=>1, 'permission_id'=>1005],
            ['role_id'=>1, 'permission_id'=>1006],
            ['role_id'=>1, 'permission_id'=>1007],
            ['role_id'=>1, 'permission_id'=>1008],
            ['role_id'=>1, 'permission_id'=>1009],
            ['role_id'=>1, 'permission_id'=>1010],
            ['role_id'=>1, 'permission_id'=>1011],
            ['role_id'=>1, 'permission_id'=>1012],
            ['role_id'=>1, 'permission_id'=>1013],

            //Patient Visit Report
            ['role_id'=>1, 'permission_id'=>1030],
            ['role_id'=>1, 'permission_id'=>1031],
            ['role_id'=>1, 'permission_id'=>1032],

            //Patient Daily Visit Report
            ['role_id'=>1, 'permission_id'=>1040],
            ['role_id'=>1, 'permission_id'=>1041],
            ['role_id'=>1, 'permission_id'=>1042],
            ['role_id'=>1, 'permission_id'=>1043],

            //Sale Income Report
            ['role_id'=>1, 'permission_id'=>1050],
            ['role_id'=>1, 'permission_id'=>1051],
            ['role_id'=>1, 'permission_id'=>1052],
            // ['role_id'=>1, 'permission_id'=>1053],
            // ['role_id'=>1, 'permission_id'=>1054],

            //Log Patient Case Summary

            ['role_id'=>1, 'permission_id'=>1014],


            ['role_id'=>1, 'permission_id'=>1015],
            ['role_id'=>1, 'permission_id'=>1016],

            //Income summary report
            ['role_id'=>1, 'permission_id'=>1017],
            ['role_id'=>1, 'permission_id'=>1018],
            ['role_id'=>1, 'permission_id'=>1019],
            ['role_id'=>1, 'permission_id'=>1020],
            ['role_id'=>1, 'permission_id'=>1021],
            ['role_id'=>1, 'permission_id'=>1022],
            ['role_id'=>1, 'permission_id'=>1023],

            //Patient Detail New
            ['role_id'=>1, 'permission_id'=>1024],
            ['role_id'=>2, 'permission_id'=>1024],


            // For Admin Role ( id = 2 )



            // Users
            ['role_id'=>2, 'permission_id'=>10],
            ['role_id'=>2, 'permission_id'=>11],
            ['role_id'=>2, 'permission_id'=>12],
            ['role_id'=>2, 'permission_id'=>13],
            ['role_id'=>2, 'permission_id'=>14],
            ['role_id'=>2, 'permission_id'=>15],
            ['role_id'=>2, 'permission_id'=>16],
            ['role_id'=>2, 'permission_id'=>17],
            ['role_id'=>2, 'permission_id'=>18],
            ['role_id'=>2, 'permission_id'=>19],

            // City
            ['role_id'=>2, 'permission_id'=>30],
            ['role_id'=>2, 'permission_id'=>31],
            ['role_id'=>2, 'permission_id'=>32],
            ['role_id'=>2, 'permission_id'=>33],
            ['role_id'=>2, 'permission_id'=>34],
            ['role_id'=>2, 'permission_id'=>35],

            // Township
            ['role_id'=>2, 'permission_id'=>40],
            ['role_id'=>2, 'permission_id'=>41],
            ['role_id'=>2, 'permission_id'=>42],
            ['role_id'=>2, 'permission_id'=>43],
            ['role_id'=>2, 'permission_id'=>44],
            ['role_id'=>2, 'permission_id'=>45],

            // Cartype
            ['role_id'=>2, 'permission_id'=>50],
            ['role_id'=>2, 'permission_id'=>51],
            ['role_id'=>2, 'permission_id'=>52],
            ['role_id'=>2, 'permission_id'=>53],
            ['role_id'=>2, 'permission_id'=>54],
            ['role_id'=>2, 'permission_id'=>55],

            // Zone
            ['role_id'=>2, 'permission_id'=>60],
            ['role_id'=>2, 'permission_id'=>61],
            ['role_id'=>2, 'permission_id'=>62],
            ['role_id'=>2, 'permission_id'=>63],
            ['role_id'=>2, 'permission_id'=>64],
            ['role_id'=>2, 'permission_id'=>65],

            // Cartypesetup
            ['role_id'=>2, 'permission_id'=>70],
            ['role_id'=>2, 'permission_id'=>71],
            ['role_id'=>2, 'permission_id'=>72],
            ['role_id'=>2, 'permission_id'=>73],
            ['role_id'=>2, 'permission_id'=>74],
            ['role_id'=>2, 'permission_id'=>75],

            // Product Category
            ['role_id'=>2, 'permission_id'=>80],
            ['role_id'=>2, 'permission_id'=>81],
            ['role_id'=>2, 'permission_id'=>82],
            ['role_id'=>2, 'permission_id'=>83],
            ['role_id'=>2, 'permission_id'=>84],
            ['role_id'=>2, 'permission_id'=>85],

            // Product
            ['role_id'=>2, 'permission_id'=>90],
            ['role_id'=>2, 'permission_id'=>91],
            ['role_id'=>2, 'permission_id'=>92],
            ['role_id'=>2, 'permission_id'=>93],
            ['role_id'=>2, 'permission_id'=>94],
            ['role_id'=>2, 'permission_id'=>95],

            // Package
            ['role_id'=>2, 'permission_id'=>100],
            ['role_id'=>2, 'permission_id'=>101],
            ['role_id'=>2, 'permission_id'=>102],
            ['role_id'=>2, 'permission_id'=>103],
            ['role_id'=>2, 'permission_id'=>104],
            ['role_id'=>2, 'permission_id'=>105],
            ['role_id'=>2, 'permission_id'=>106],
            ['role_id'=>2, 'permission_id'=>107],
            ['role_id'=>2, 'permission_id'=>108],


            // Investigation
            ['role_id'=>2, 'permission_id'=>110],
            ['role_id'=>2, 'permission_id'=>111],
            ['role_id'=>2, 'permission_id'=>112],
            ['role_id'=>2, 'permission_id'=>113],
            ['role_id'=>2, 'permission_id'=>114],
            ['role_id'=>2, 'permission_id'=>115],

            // Physical Examination
            ['role_id'=>2, 'permission_id'=>120],
            ['role_id'=>2, 'permission_id'=>121],
            ['role_id'=>2, 'permission_id'=>122],
            ['role_id'=>2, 'permission_id'=>123],
            ['role_id'=>2, 'permission_id'=>124],
            ['role_id'=>2, 'permission_id'=>125],

            // Service
            ['role_id'=>2, 'permission_id'=>130],
            ['role_id'=>2, 'permission_id'=>131],
            ['role_id'=>2, 'permission_id'=>132],
            ['role_id'=>2, 'permission_id'=>133],
            ['role_id'=>2, 'permission_id'=>134],
            ['role_id'=>2, 'permission_id'=>135],

            // Enquiry
            ['role_id'=>2, 'permission_id'=>140],
            ['role_id'=>2, 'permission_id'=>141],
            ['role_id'=>2, 'permission_id'=>142],
            ['role_id'=>2, 'permission_id'=>143],
            ['role_id'=>2, 'permission_id'=>144],
            ['role_id'=>2, 'permission_id'=>145],
            ['role_id'=>2, 'permission_id'=>146],
            ['role_id'=>2, 'permission_id'=>147],
            ['role_id'=>2, 'permission_id'=>148],

            // Allergy
            ['role_id'=>2, 'permission_id'=>150],
            ['role_id'=>2, 'permission_id'=>151],
            ['role_id'=>2, 'permission_id'=>152],
            ['role_id'=>2, 'permission_id'=>153],
            ['role_id'=>2, 'permission_id'=>154],
            ['role_id'=>2, 'permission_id'=>155],

            // Patient
            ['role_id'=>2, 'permission_id'=>160],
            ['role_id'=>2, 'permission_id'=>161],
            ['role_id'=>2, 'permission_id'=>162],
            ['role_id'=>2, 'permission_id'=>163],
            ['role_id'=>2, 'permission_id'=>164],
            ['role_id'=>2, 'permission_id'=>165],
            ['role_id'=>2, 'permission_id'=>166],
            ['role_id'=>2, 'permission_id'=>167],
            ['role_id'=>2, 'permission_id'=>168],

            // Schedule
            ['role_id'=>2, 'permission_id'=>200],
            ['role_id'=>2, 'permission_id'=>201],
            ['role_id'=>2, 'permission_id'=>202],
            ['role_id'=>2, 'permission_id'=>203],
            ['role_id'=>2, 'permission_id'=>204],
            ['role_id'=>2, 'permission_id'=>205],
            ['role_id'=>2, 'permission_id'=>206],
            ['role_id'=>2, 'permission_id'=>207],

            // Package Sale
            ['role_id'=>2, 'permission_id'=>210],
            ['role_id'=>2, 'permission_id'=>211],
            ['role_id'=>2, 'permission_id'=>212],
            ['role_id'=>2, 'permission_id'=>213],
            ['role_id'=>2, 'permission_id'=>214],
            ['role_id'=>2, 'permission_id'=>215],

            // Family History
            ['role_id'=>2, 'permission_id'=>220],
            ['role_id'=>2, 'permission_id'=>221],
            ['role_id'=>2, 'permission_id'=>222],
            ['role_id'=>2, 'permission_id'=>223],
            ['role_id'=>2, 'permission_id'=>224],
            ['role_id'=>2, 'permission_id'=>225],

            // Family Member
            ['role_id'=>2, 'permission_id'=>230],
            ['role_id'=>2, 'permission_id'=>231],
            ['role_id'=>2, 'permission_id'=>232],
            ['role_id'=>2, 'permission_id'=>233],
            ['role_id'=>2, 'permission_id'=>234],
            ['role_id'=>2, 'permission_id'=>235],

            // Patient Family History
            ['role_id'=>2, 'permission_id'=>240],
            ['role_id'=>2, 'permission_id'=>241],
            ['role_id'=>2, 'permission_id'=>242],
            ['role_id'=>2, 'permission_id'=>243],
            ['role_id'=>2, 'permission_id'=>244],
            ['role_id'=>2, 'permission_id'=>245],

            // Medical History
            ['role_id'=>2, 'permission_id'=>250],
            ['role_id'=>2, 'permission_id'=>251],
            ['role_id'=>2, 'permission_id'=>252],
            ['role_id'=>2, 'permission_id'=>253],
            ['role_id'=>2, 'permission_id'=>254],
            ['role_id'=>2, 'permission_id'=>255],

            // Patient Medical History
            ['role_id'=>2, 'permission_id'=>260],
            ['role_id'=>2, 'permission_id'=>261],
            ['role_id'=>2, 'permission_id'=>262],
            ['role_id'=>2, 'permission_id'=>263],
            ['role_id'=>2, 'permission_id'=>264],
            ['role_id'=>2, 'permission_id'=>265],

            // Patient Surgery History
            ['role_id'=>2, 'permission_id'=>270],
            ['role_id'=>2, 'permission_id'=>271],
            ['role_id'=>2, 'permission_id'=>272],
            ['role_id'=>2, 'permission_id'=>273],
            ['role_id'=>2, 'permission_id'=>274],
            ['role_id'=>2, 'permission_id'=>275],

            // Provisional Diagnosis
            ['role_id'=>2, 'permission_id'=>280],
            ['role_id'=>2, 'permission_id'=>281],
            ['role_id'=>2, 'permission_id'=>282],
            ['role_id'=>2, 'permission_id'=>283],
            ['role_id'=>2, 'permission_id'=>284],
            ['role_id'=>2, 'permission_id'=>285],

            // Route
            ['role_id'=>2, 'permission_id'=>290],
            ['role_id'=>2, 'permission_id'=>291],
            ['role_id'=>2, 'permission_id'=>292],
            ['role_id'=>2, 'permission_id'=>293],
            ['role_id'=>2, 'permission_id'=>294],
            ['role_id'=>2, 'permission_id'=>295],

            //Report Permissions
            ['role_id'=>2, 'permission_id'=>1001],
            ['role_id'=>2, 'permission_id'=>1002],
            ['role_id'=>2, 'permission_id'=>1003],
            ['role_id'=>2, 'permission_id'=>1004],
            ['role_id'=>2, 'permission_id'=>1005],
            ['role_id'=>2, 'permission_id'=>1006],
            ['role_id'=>2, 'permission_id'=>1007],
            ['role_id'=>2, 'permission_id'=>1008],
            ['role_id'=>2, 'permission_id'=>1009],
            ['role_id'=>2, 'permission_id'=>1010],
            ['role_id'=>2, 'permission_id'=>1011],
            ['role_id'=>2, 'permission_id'=>1012],
            ['role_id'=>2, 'permission_id'=>1013],

            //Log Patient Case Summary

            ['role_id'=>2, 'permission_id'=>1014],


            ['role_id'=>2, 'permission_id'=>1015],
            ['role_id'=>2, 'permission_id'=>1016],

            //Income summary report
            ['role_id'=>2, 'permission_id'=>1017],
            ['role_id'=>2, 'permission_id'=>1018],
            ['role_id'=>2, 'permission_id'=>1019],
            ['role_id'=>2, 'permission_id'=>1020],
            ['role_id'=>2, 'permission_id'=>1021],

            //Log Activities
            ['role_id'=>1, 'permission_id'=>300],

            //Import
            ['role_id'=>1, 'permission_id'=>306],
            ['role_id'=>1, 'permission_id'=>307],
            ['role_id'=>2, 'permission_id'=>306],
            ['role_id'=>2, 'permission_id'=>307],

            //Price History
            ['role_id'=>1, 'permission_id'=>311],
            ['role_id'=>1, 'permission_id'=>312],

            //Api List
            ['role_id'=>1, 'permission_id'=>321],
            ['role_id'=>1, 'permission_id'=>322],
            ['role_id'=>1, 'permission_id'=>323],
            ['role_id'=>1, 'permission_id'=>324],
            ['role_id'=>1, 'permission_id'=>325],
            ['role_id'=>1, 'permission_id'=>326],
            ['role_id'=>1, 'permission_id'=>327],

            //Tablet Issues
            ['role_id'=>1, 'permission_id'=>330],

            //Investigation Imaging
            ['role_id'=>1, 'permission_id'=>340],
            ['role_id'=>1, 'permission_id'=>341],
            ['role_id'=>1, 'permission_id'=>342],
            ['role_id'=>1, 'permission_id'=>343],
            ['role_id'=>1, 'permission_id'=>344],
            ['role_id'=>1, 'permission_id'=>345],

            //Addendum
            ['role_id'=>1, 'permission_id'=>346],

            //For MO role to view dashboard
            ['role_id'=>6, 'permission_id'=>16],

            //Patient Visit Report
            ['role_id'=>2, 'permission_id'=>1030],
            ['role_id'=>2, 'permission_id'=>1031],
            ['role_id'=>2, 'permission_id'=>1032],

            //Patient Daily Visit Report
            ['role_id'=>2, 'permission_id'=>1040],
            ['role_id'=>2, 'permission_id'=>1041],
            ['role_id'=>2, 'permission_id'=>1042],
            ['role_id'=>2, 'permission_id'=>1043],

            //Sale Income Report
            ['role_id'=>2, 'permission_id'=>1050],
            ['role_id'=>2, 'permission_id'=>1051],
            ['role_id'=>2, 'permission_id'=>1052],
            // ['role_id'=>2, 'permission_id'=>1053],
            // ['role_id'=>2, 'permission_id'=>1054],

            //MO permissions(role_id = 6)
            //Enquiry
            ['role_id'=>6, 'permission_id'=>140],
            ['role_id'=>6, 'permission_id'=>141],
            ['role_id'=>6, 'permission_id'=>142],
            ['role_id'=>6, 'permission_id'=>143],
            ['role_id'=>6, 'permission_id'=>144],
            ['role_id'=>6, 'permission_id'=>145],
            ['role_id'=>6, 'permission_id'=>146],
            ['role_id'=>6, 'permission_id'=>147],
            ['role_id'=>6, 'permission_id'=>148],

            //Schedule
            ['role_id'=>6, 'permission_id'=>200],
            ['role_id'=>6, 'permission_id'=>201],
            ['role_id'=>6, 'permission_id'=>202],
            ['role_id'=>6, 'permission_id'=>203],
            ['role_id'=>6, 'permission_id'=>204],
            ['role_id'=>6, 'permission_id'=>205],
            ['role_id'=>6, 'permission_id'=>206],
            ['role_id'=>6, 'permission_id'=>207],

            //Patient
            ['role_id'=>6, 'permission_id'=>160],
            ['role_id'=>6, 'permission_id'=>161],
            ['role_id'=>6, 'permission_id'=>162],
            ['role_id'=>6, 'permission_id'=>163],
            ['role_id'=>6, 'permission_id'=>164],
            ['role_id'=>6, 'permission_id'=>165],
            ['role_id'=>6, 'permission_id'=>166],
            ['role_id'=>6, 'permission_id'=>167],
            ['role_id'=>6, 'permission_id'=>168],
            ['role_id'=>6, 'permission_id'=>1024],
            //for patient_detail->invoice & invoice export
            ['role_id'=>6, 'permission_id'=>1012],
            ['role_id'=>6, 'permission_id'=>1013],
            //for patient_detail->addendum_store
            ['role_id'=>6, 'permission_id'=>346],

            //Package Sale
            ['role_id'=>6, 'permission_id'=>210],
            ['role_id'=>6, 'permission_id'=>211],
            ['role_id'=>6, 'permission_id'=>212],
            ['role_id'=>6, 'permission_id'=>213],
            ['role_id'=>6, 'permission_id'=>214],
            ['role_id'=>6, 'permission_id'=>215],
        );

        DB::table('core_permission_role')->insert($roles);
    }
}
