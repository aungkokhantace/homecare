<?php
/**
 * Created by PhpStorm.
 * Author: Wai Yan Aung
 * Date: 7/4/2016
 * Time: 3:03 PM
 */
use Illuminate\Database\Seeder;
class Default_PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('core_permissions')->delete();
        $existingPermissions = DB::select('SELECT id FROM core_permissions');

        $permissions = array(

            // Roles
            ['id'=>1,'module'=>'Role','name'=>'Listing','description'=>'Role Listing','url'=>'role'],
            ['id'=>2,'module'=>'Role','name'=>'New','description'=>'Role New','url'=>'role/create'],
            ['id'=>3,'module'=>'Role','name'=>'Store','description'=>'Role Store','url'=>'role/store'],
            ['id'=>4,'module'=>'Role','name'=>'Edit','description'=>'Role Edit','url'=>'role/edit'],
            ['id'=>5,'module'=>'Role','name'=>'Update','description'=>'Role Update','url'=>'role/update'],
            ['id'=>6,'module'=>'Role','name'=>'Destroy','description'=>'Role Destroy','url'=>'role/destroy'],
            ['id'=>7,'module'=>'Role','name'=>'Permission View','description'=>'Role Permission View','url'=>'rolePermission'],
            ['id'=>8,'module'=>'Role','name'=>'Permission Assign','description'=>'Role Permission Assign','url'=>'rolePermissionAssign'],

            // Users
            ['id'=>10,'module'=>'User','name'=>'Listing','description'=>'User Listing','url'=>'user'],
            ['id'=>11,'module'=>'User','name'=>'New','description'=>'User New','url'=>'user/create'],
            ['id'=>12,'module'=>'User','name'=>'Store','description'=>'User Store','url'=>'user/store'],
            ['id'=>13,'module'=>'User','name'=>'Edit','description'=>'User Edit','url'=>'user/edit'],
            ['id'=>14,'module'=>'User','name'=>'Update','description'=>'User Update','url'=>'user/update'],
            ['id'=>15,'module'=>'User','name'=>'Destroy','description'=>'User Destroy','url'=>'user/destroy'],
            ['id'=>16,'module'=>'User','name'=>'Auth','description'=>'Getting Auth User','url'=>'userAuth'],
            ['id'=>17,'module'=>'User','name'=>'Profile','description'=>'User Profile','url'=>'user/profile'],
            ['id'=>18,'module'=>'User','name'=>'Disable','description'=>'User Disable','url'=>'user/disable'],
            ['id'=>19,'module'=>'User','name'=>'Enable','description'=>'User Enable','url'=>'user/enable'],

            // Permissions
            ['id'=>20,'module'=>'Permission','name'=>'Listing','description'=>'Permission Listing','url'=>'permission'],
            ['id'=>21,'module'=>'Permission','name'=>'New','description'=>'Permission New','url'=>'permission/create'],
            ['id'=>22,'module'=>'Permission','name'=>'Store','description'=>'Permission Store','url'=>'permission/store'],
            ['id'=>23,'module'=>'Permission','name'=>'Edit','description'=>'Permission Edit','url'=>'permission/edit'],
            ['id'=>24,'module'=>'Permission','name'=>'Update','description'=>'Permission Update','url'=>'permission/update'],
            ['id'=>25,'module'=>'Permission','name'=>'Destroy','description'=>'Permission Destroy','url'=>'permission/destroy'],

            // Configs
            ['id'=>26,'module'=>'Config','name'=>'View','description'=>'Editing','url'=>'config'],

            // City
            ['id'=>30,'module'=>'City','name'=>'Listing','description'=>'City Listing','url'=>'city'],
            ['id'=>31,'module'=>'City','name'=>'New','description'=>'City New','url'=>'city/create'],
            ['id'=>32,'module'=>'City','name'=>'Store','description'=>'City Store','url'=>'city/store'],
            ['id'=>33,'module'=>'City','name'=>'Edit','description'=>'City Edit','url'=>'city/edit'],
            ['id'=>34,'module'=>'City','name'=>'Update','description'=>'City Update','url'=>'city/update'],
            ['id'=>35,'module'=>'City','name'=>'Destroy','description'=>'City Destroy','url'=>'city/destroy'],

            // Township
            ['id'=>40,'module'=>'Township','name'=>'Listing','description'=>'Township Listing','url'=>'township'],
            ['id'=>41,'module'=>'Township','name'=>'New','description'=>'Township New','url'=>'township/create'],
            ['id'=>42,'module'=>'Township','name'=>'Store','description'=>'Township Store','url'=>'township/store'],
            ['id'=>43,'module'=>'Township','name'=>'Edit','description'=>'Township Edit','url'=>'township/edit'],
            ['id'=>44,'module'=>'Township','name'=>'Update','description'=>'Township Update','url'=>'township/update'],
            ['id'=>45,'module'=>'Township','name'=>'Destroy','description'=>'Township Destroy','url'=>'township/destroy'],

            // Cartype
            ['id'=>50,'module'=>'Cartype','name'=>'Listing','description'=>'Cartype Listing','url'=>'cartype'],
            ['id'=>51,'module'=>'Cartype','name'=>'New','description'=>'Cartype New','url'=>'cartype/create'],
            ['id'=>52,'module'=>'Cartype','name'=>'Store','description'=>'Cartype Store','url'=>'cartype/store'],
            ['id'=>53,'module'=>'Cartype','name'=>'Edit','description'=>'Cartype Edit','url'=>'cartype/edit'],
            ['id'=>54,'module'=>'Cartype','name'=>'Update','description'=>'Cartype Update','url'=>'cartype/update'],
            ['id'=>55,'module'=>'Cartype','name'=>'Destroy','description'=>'Cartype Destroy','url'=>'cartype/destroy'],

            // Zone
            ['id'=>60,'module'=>'Zone','name'=>'Listing','description'=>'Zone Listing','url'=>'zone'],
            ['id'=>61,'module'=>'Zone','name'=>'New','description'=>'Zone New','url'=>'zone/create'],
            ['id'=>62,'module'=>'Zone','name'=>'Store','description'=>'Zone Store','url'=>'zone/store'],
            ['id'=>63,'module'=>'Zone','name'=>'Edit','description'=>'Zone Edit','url'=>'zone/edit'],
            ['id'=>64,'module'=>'Zone','name'=>'Update','description'=>'Zone Update','url'=>'zone/update'],
            ['id'=>65,'module'=>'Zone','name'=>'Destroy','description'=>'Zone Destroy','url'=>'zone/destroy'],

            // Cartypesetup
            ['id'=>70,'module'=>'Cartypesetup','name'=>'Listing','description'=>'Cartypesetup Listing','url'=>'cartypesetup'],
            ['id'=>71,'module'=>'Cartypesetup','name'=>'New','description'=>'Cartypesetup New','url'=>'cartypesetup/create'],
            ['id'=>72,'module'=>'Cartypesetup','name'=>'Store','description'=>'Cartypesetup Store','url'=>'cartypesetup/store'],
            ['id'=>73,'module'=>'Cartypesetup','name'=>'Edit','description'=>'Cartypesetup Edit','url'=>'cartypesetup/edit'],
            ['id'=>74,'module'=>'Cartypesetup','name'=>'Update','description'=>'Cartypesetup Update','url'=>'cartypesetup/update'],
            ['id'=>75,'module'=>'Cartypesetup','name'=>'Destroy','description'=>'Cartypesetup Destroy','url'=>'cartypesetup/destroy'],

            // Product Category
            ['id'=>80,'module'=>'Product Category','name'=>'Listing','description'=>'Product Category Listing','url'=>'productcategory'],
            ['id'=>81,'module'=>'Product Category','name'=>'New','description'=>'Product Category New','url'=>'productcategory/create'],
            ['id'=>82,'module'=>'Product Category','name'=>'Store','description'=>'Product Category Store','url'=>'productcategory/store'],
            ['id'=>83,'module'=>'Product Category','name'=>'Edit','description'=>'Product Category Edit','url'=>'productcategory/edit'],
            ['id'=>84,'module'=>'Product Category','name'=>'Update','description'=>'Product Category Update','url'=>'productcategory/update'],
            ['id'=>85,'module'=>'Product Category','name'=>'Destroy','description'=>'Product Category Destroy','url'=>'productcategory/destroy'],

            // Product
            ['id'=>90,'module'=>'Product','name'=>'Listing','description'=>'Product Listing','url'=>'product'],
            ['id'=>91,'module'=>'Product','name'=>'New','description'=>'Product New','url'=>'product/create'],
            ['id'=>92,'module'=>'Product','name'=>'Store','description'=>'Product Store','url'=>'product/store'],
            ['id'=>93,'module'=>'Product','name'=>'Edit','description'=>'Product Edit','url'=>'product/edit'],
            ['id'=>94,'module'=>'Product','name'=>'Update','description'=>'Product Update','url'=>'product/update'],
            ['id'=>95,'module'=>'Product','name'=>'Destroy','description'=>'Product Destroy','url'=>'product/destroy'],

            // Package
            ['id'=>100,'module'=>'Package','name'=>'Listing','description'=>'Package Listing','url'=>'package'],
            ['id'=>101,'module'=>'Package','name'=>'New','description'=>'Package New','url'=>'package/create'],
            ['id'=>102,'module'=>'Package','name'=>'Store','description'=>'Package Store','url'=>'package/store'],
            ['id'=>103,'module'=>'Package','name'=>'Edit','description'=>'Package Edit','url'=>'package/edit'],
            ['id'=>104,'module'=>'Package','name'=>'Update','description'=>'Package Update','url'=>'package/update'],
            ['id'=>105,'module'=>'Package','name'=>'Destroy','description'=>'Package Destroy','url'=>'package/destroy'],
            ['id'=>106,'module'=>'Package','name'=>'Edit Promotion','description'=>'Package Promotion Edit','url'=>'package/promotion'],
            ['id'=>107,'module'=>'Package','name'=>'Create Promotion','description'=>'Package Promotion Create','url'=>'package/createPromotion'],
            ['id'=>108,'module'=>'Package','name'=>'Update Promotion','description'=>'Package Promotion Update','url'=>'package/updatePromotion'],

            // Investigation
            ['id'=>110,'module'=>'Investigation','name'=>'Listing','description'=>'Investigation Listing','url'=>'investigation'],
            ['id'=>111,'module'=>'Investigation','name'=>'New','description'=>'Investigation New','url'=>'investigation/create'],
            ['id'=>112,'module'=>'Investigation','name'=>'Store','description'=>'Investigation Store','url'=>'investigation/store'],
            ['id'=>113,'module'=>'Investigation','name'=>'Edit','description'=>'Investigation Edit','url'=>'investigation/edit'],
            ['id'=>114,'module'=>'Investigation','name'=>'Update','description'=>'Investigation Update','url'=>'investigation/update'],
            ['id'=>115,'module'=>'Investigation','name'=>'Destroy','description'=>'Investigation Destroy','url'=>'investigation/destroy'],

            // Physical Examination
            ['id'=>120,'module'=>'Physical Examination','name'=>'Listing','description'=>'Physical Examination Listing','url'=>'physicalexam'],
            ['id'=>121,'module'=>'Physical Examination','name'=>'New','description'=>'Physical Examination New','url'=>'physicalexam/create'],
            ['id'=>122,'module'=>'Physical Examination','name'=>'Store','description'=>'Physical Examination Store','url'=>'physicalexam/store'],
            ['id'=>123,'module'=>'Physical Examination','name'=>'Edit','description'=>'Physical Examination Edit','url'=>'physicalexam/edit'],
            ['id'=>124,'module'=>'Physical Examination','name'=>'Update','description'=>'Physical Examination Update','url'=>'physicalexam/update'],
            ['id'=>125,'module'=>'Physical Examination','name'=>'Destroy','description'=>'Physical Examination Destroy','url'=>'physicalexam/destroy'],

            // Service
            ['id'=>130,'module'=>'Service','name'=>'Listing','description'=>'Service Listing','url'=>'service'],
            ['id'=>131,'module'=>'Service','name'=>'New','description'=>'Service New','url'=>'service/create'],
            ['id'=>132,'module'=>'Service','name'=>'Store','description'=>'Service Store','url'=>'service/store'],
            ['id'=>133,'module'=>'Service','name'=>'Edit','description'=>'Service Edit','url'=>'service/edit'],
            ['id'=>134,'module'=>'Service','name'=>'Update','description'=>'Service Update','url'=>'service/update'],
            ['id'=>135,'module'=>'Service','name'=>'Destroy','description'=>'Service Destroy','url'=>'service/destroy'],

            // Enquiry
            ['id'=>140,'module'=>'Enquiry','name'=>'Listing','description'=>'Enquiry Listing','url'=>'enquiry'],
            ['id'=>141,'module'=>'Enquiry','name'=>'New','description'=>'Enquiry New','url'=>'enquiry/create'],
            ['id'=>142,'module'=>'Enquiry','name'=>'Store','description'=>'Enquiry Store','url'=>'enquiry/store'],
            ['id'=>143,'module'=>'Enquiry','name'=>'Edit','description'=>'Enquiry Edit','url'=>'enquiry/edit'],
            ['id'=>144,'module'=>'Enquiry','name'=>'Update','description'=>'Enquiry Update','url'=>'enquiry/update'],
            ['id'=>145,'module'=>'Enquiry','name'=>'Destroy','description'=>'Enquiry Destroy','url'=>'enquiry/destroy'],
            ['id'=>146,'module'=>'Enquiry','name'=>'Confirm','description'=>'Enquiry Confirm','url'=>'enquiry/confirm'],
            ['id'=>147,'module'=>'Enquiry','name'=>'Cancel','description'=>'Enquiry Cancel','url'=>'enquiry/cancel'],
            ['id'=>148,'module'=>'Enquiry','name'=>'Search By Filter','description'=>'Enquiry Search','url'=>'enquiry/search/{enquiry_status?}/{enquiry_case_type?}/{from_date?}/{to_date?}'],

            // Allergy
            ['id'=>150,'module'=>'Allergy','name'=>'Listing','description'=>'Allergy Listing','url'=>'allergy'],
            ['id'=>151,'module'=>'Allergy','name'=>'New','description'=>'Allergy New','url'=>'allergy/create'],
            ['id'=>152,'module'=>'Allergy','name'=>'Store','description'=>'Allergy Store','url'=>'allergy/store'],
            ['id'=>153,'module'=>'Allergy','name'=>'Edit','description'=>'Allergy Edit','url'=>'allergy/edit'],
            ['id'=>154,'module'=>'Allergy','name'=>'Update','description'=>'Allergy Update','url'=>'allergy/update'],
            ['id'=>155,'module'=>'Allergy','name'=>'Destroy','description'=>'Allergy Destroy','url'=>'allergy/destroy'],

            // Patient
            ['id'=>160,'module'=>'Patient','name'=>'Listing','description'=>'Patient Listing','url'=>'patient'],
            ['id'=>161,'module'=>'Patient','name'=>'New','description'=>'Patient New','url'=>'patient/create'],
            ['id'=>162,'module'=>'Patient','name'=>'Store','description'=>'Patient Store','url'=>'patient/store'],
            ['id'=>163,'module'=>'Patient','name'=>'Edit','description'=>'Patient Edit','url'=>'patient/edit'],
            ['id'=>164,'module'=>'Patient','name'=>'Update','description'=>'Patient Update','url'=>'patient/update'],
            ['id'=>165,'module'=>'Patient','name'=>'Destroy','description'=>'Patient Destroy','url'=>'patient/destroy'],
            ['id'=>166,'module'=>'Patient','name'=>'Check Zone','description'=>'Patient Check Zone','url'=>'patient/checkzone'],
            ['id'=>167,'module'=>'Patient','name'=>'Detail','description'=>'Patient Detail','url'=>'patient/detail'],
            ['id'=>168,'module'=>'Patient','name'=>'Patient Detail','description'=>'Patient Detail','url'=>'patient/patient_detail'],

            // Patient
            ['id'=>170,'module'=>'Patient','name'=>'Profile','description'=>'Patient Profile','url'=>'patient/profile'],
            ['id'=>171,'module'=>'Patient','name'=>'Case Summary','description'=>'Patient Case Summary','url'=>'patient/case'],
            ['id'=>172,'module'=>'Patient','name'=>'Export','description'=>'Patient Export','url'=>'patient/export'],
            ['id'=>173,'module'=>'Patient','name'=>'Schedule History','description'=>'Patient Schedule History','url'=>'patient/schedule'],
            ['id'=>174,'module'=>'Patient','name'=>'Service History','description'=>'Patient Service History','url'=>'patient/service'],
            ['id'=>175,'module'=>'Patient','name'=>'Package History','description'=>'Patient Package History','url'=>'patient/package'],
            ['id'=>176,'module'=>'Patient Booking Request','name'=>'Booking Request','description'=>'Patient Booking Request','url'=>'patient/bookingrequest'],
            ['id'=>177,'module'=>'Patient Booking Request','name'=>'Booking Request Store','description'=>'Patient Booking Request Store','url'=>'patient/bookingrequest/store'],
            ['id'=>178,'module'=>'Patient Invoice','name'=>'Invoice','description'=>'Patient Invoice','url'=>'patient/invoice'],
            ['id'=>179,'module'=>'Patient Invoice Detail','name'=>'Invoice Detail','description'=>'Patient Invoice Detail','url'=>'patient/invoicedetail'],
            ['id'=>180,'module'=>'Patient Invoice Export','name'=>'Invoice Export','description'=>'Patient Invoice Export','url'=>'patient/invoice_export'],
            ['id'=>181,'module'=>'Patient Present Medication','name'=>'Present Medication','description'=>'Patient Present Medication','url'=>'patient/medication'],

            // Schedule
            ['id'=>200,'module'=>'Schedule','name'=>'Listing','description'=>'Schedule Listing','url'=>'schedule'],
            ['id'=>201,'module'=>'Schedule','name'=>'New','description'=>'Schedule New','url'=>'schedule/create'],
            ['id'=>202,'module'=>'Schedule','name'=>'Store','description'=>'Schedule Store','url'=>'schedule/store'],
            ['id'=>203,'module'=>'Schedule','name'=>'Edit','description'=>'Schedule Edit','url'=>'schedule/edit'],
            ['id'=>204,'module'=>'Schedule','name'=>'Update','description'=>'Schedule Update','url'=>'schedule/update'],
            ['id'=>205,'module'=>'Schedule','name'=>'Destroy','description'=>'Schedule Destroy','url'=>'schedule/destroy'],
            ['id'=>206,'module'=>'Schedule','name'=>'Search','description'=>'Schedule Search','url'=>'schedule/search/{schedule_status?}/{from_date?}/{to_date?}'],
            ['id'=>207,'module'=>'Schedule','name'=>'Cancel','description'=>'Schedule Cancel','url'=>'schedule/cancel'],

            // Package Sale
            ['id'=>210,'module'=>'Package Sale','name'=>'Listing','description'=>'Package Sale Listing','url'=>'packagesale'],
            ['id'=>211,'module'=>'Package Sale','name'=>'New','description'=>'Package Sale New','url'=>'packagesale/create'],
            ['id'=>212,'module'=>'Package Sale','name'=>'Store','description'=>'Package Sale Store','url'=>'packagesale/store'],
            ['id'=>213,'module'=>'Package Sale','name'=>'Invoice','description'=>'Package Sale Edit','url'=>'packagesale/invoice'],
            ['id'=>214,'module'=>'Package Sale','name'=>'Export','description'=>'Package Sale Update','url'=>'packagesale/export'],
            ['id'=>215,'module'=>'Package Sale','name'=>'Schedule','description'=>'Package Sale Destroy','url'=>'packagesale/schedule'],

            // Family History
            ['id'=>220,'module'=>'Family History','name'=>'Listing','description'=>'Family History Listing','url'=>'familyhistory'],
            ['id'=>221,'module'=>'Family History','name'=>'New','description'=>'Family History New','url'=>'familyhistory/create'],
            ['id'=>222,'module'=>'Family History','name'=>'Store','description'=>'Family History History Store','url'=>'familyhistory/store'],
            ['id'=>223,'module'=>'Family History','name'=>'Edit','description'=>'Family History Edit','url'=>'familyhistory/edit'],
            ['id'=>224,'module'=>'Family History','name'=>'Update','description'=>'Family History Update','url'=>'familyhistory/update'],
            ['id'=>225,'module'=>'Family History','name'=>'Destroy','description'=>'Family History Destroy','url'=>'familyhistory/destroy'],

            // Family Member
            ['id'=>230,'module'=>'Family Member','name'=>'Listing','description'=>'Family Member Listing','url'=>'familymember'],
            ['id'=>231,'module'=>'Family Member','name'=>'New','description'=>'Family Member New','url'=>'familymember/create'],
            ['id'=>232,'module'=>'Family Member','name'=>'Store','description'=>'Family Member History Store','url'=>'familymember/store'],
            ['id'=>233,'module'=>'Family Member','name'=>'Edit','description'=>'Family Member Edit','url'=>'familymember/edit'],
            ['id'=>234,'module'=>'Family Member','name'=>'Update','description'=>'Family Member Update','url'=>'familymember/update'],
            ['id'=>235,'module'=>'Family Member','name'=>'Destroy','description'=>'Family Member Destroy','url'=>'familymember/destroy'],

            // Patient Family History
            ['id'=>240,'module'=>'Patient Family History','name'=>'Listing','description'=>'Patient Family History Listing','url'=>'patientfamilyhistory'],
            ['id'=>241,'module'=>'Patient Family History','name'=>'New','description'=>'Patient Family History New','url'=>'patientfamilyhistory/create'],
            ['id'=>242,'module'=>'Patient Family History','name'=>'Store','description'=>'Patient Family History History Store','url'=>'patientfamilyhistory/store'],
            ['id'=>243,'module'=>'Patient Family History','name'=>'Edit','description'=>'Patient Family History Edit','url'=>'patientfamilyhistory/edit'],
            ['id'=>244,'module'=>'Patient Family History','name'=>'Update','description'=>'Patient Family History Update','url'=>'patientfamilyhistory/update'],
            ['id'=>245,'module'=>'Patient Family History','name'=>'Destroy','description'=>'Patient Family History Destroy','url'=>'patientfamilyhistory/destroy'],

            // Medical History
            ['id'=>250,'module'=>'Medical History','name'=>'Listing','description'=>'Medical History Listing','url'=>'medicalhistory'],
            ['id'=>251,'module'=>'Medical History','name'=>'New','description'=>'Medical History New','url'=>'medicalhistory/create'],
            ['id'=>252,'module'=>'Medical History','name'=>'Store','description'=>'Medical History History Store','url'=>'medicalhistory/store'],
            ['id'=>253,'module'=>'Medical History','name'=>'Edit','description'=>'Medical History Edit','url'=>'medicalhistory/edit'],
            ['id'=>254,'module'=>'Medical History','name'=>'Update','description'=>'Medical History Update','url'=>'medicalhistory/update'],
            ['id'=>255,'module'=>'Medical History','name'=>'Destroy','description'=>'Medical History Destroy','url'=>'medicalhistory/destroy'],

            // Patient Medical History
            ['id'=>260,'module'=>'Patient Medical History','name'=>'Listing','description'=>'Patient Medical History Listing','url'=>'patientmedicalhistory'],
            ['id'=>261,'module'=>'Patient Medical History','name'=>'New','description'=>'Patient Medical History New','url'=>'patientmedicalhistory/create'],
            ['id'=>262,'module'=>'Patient Medical History','name'=>'Store','description'=>'Patient Medical History History Store','url'=>'patientmedicalhistory/store'],
            ['id'=>263,'module'=>'Patient Medical History','name'=>'Edit','description'=>'Patient Medical History Edit','url'=>'patientmedicalhistory/edit'],
            ['id'=>264,'module'=>'Patient Medical History','name'=>'Update','description'=>'Patient Medical History Update','url'=>'patientmedicalhistory/update'],
            ['id'=>265,'module'=>'Patient Medical History','name'=>'Destroy','description'=>'Patient Medical History Destroy','url'=>'patientmedicalhistory/destroy'],

            // Patient Surgery History
            ['id'=>270,'module'=>'Patient Surgery History','name'=>'Listing','description'=>'Patient Surgery History Listing','url'=>'patientsurgeryhistory'],
            ['id'=>271,'module'=>'Patient Surgery History','name'=>'New','description'=>'Patient Surgery History New','url'=>'patientsurgeryhistory/create'],
            ['id'=>272,'module'=>'Patient Surgery History','name'=>'Store','description'=>'Patient Surgery History Store','url'=>'patientsurgeryhistory/store'],
            ['id'=>273,'module'=>'Patient Surgery History','name'=>'Edit','description'=>'Patient Surgery History Edit','url'=>'patientsurgeryhistory/edit'],
            ['id'=>274,'module'=>'Patient Surgery History','name'=>'Update','description'=>'Patient Surgery History Update','url'=>'patientsurgeryhistory/update'],
            ['id'=>275,'module'=>'Patient Surgery History','name'=>'Destroy','description'=>'Patient Surgery History Destroy','url'=>'patientsurgeryhistory/destroy'],

            // Provisional Diagnosis
            ['id'=>280,'module'=>'Provisional diagnosis','name'=>'Listing','description'=>'Provisional diagnosis Listing','url'=>'provisionaldiagnosis'],
            ['id'=>281,'module'=>'Provisional diagnosis','name'=>'New','description'=>'Provisional diagnosis New','url'=>'provisionaldiagnosis/create'],
            ['id'=>282,'module'=>'Provisional diagnosis','name'=>'Store','description'=>'Provisional diagnosis Store','url'=>'provisionaldiagnosis/store'],
            ['id'=>283,'module'=>'Provisional diagnosis','name'=>'Edit','description'=>'Provisional diagnosis Edit','url'=>'provisionaldiagnosis/edit'],
            ['id'=>284,'module'=>'Provisional diagnosis','name'=>'Update','description'=>'Provisional diagnosis Update','url'=>'provisionaldiagnosis/update'],
            ['id'=>285,'module'=>'Provisional diagnosis','name'=>'Destroy','description'=>'Provisional diagnosis Destroy','url'=>'provisionaldiagnosis/destroy'],


            // Route
            ['id'=>290,'module'=>'Route','name'=>'Listing','description'=>'Route Listing','url'=>'route'],
            ['id'=>291,'module'=>'Route','name'=>'New','description'=>'Route New','url'=>'route/create'],
            ['id'=>292,'module'=>'Route','name'=>'Store','description'=>'Route Store','url'=>'route/store'],
            ['id'=>293,'module'=>'Route','name'=>'Edit','description'=>'Route Edit','url'=>'route/edit'],
            ['id'=>294,'module'=>'Route','name'=>'Update','description'=>'Route Update','url'=>'route/update'],
            ['id'=>295,'module'=>'Route','name'=>'Destroy','description'=>'Route Destroy','url'=>'route/destroy'],

            // Reports
            // Car Usage Report
            ['id'=>1001,'module'=>'Report','name'=>'Car Usage Report','description'=>'Car Usage Report Listing','url'=>'carusagereport'],
            ['id'=>1002,'module'=>'Report','name'=>'Car Usage Report Search','description'=>'Car Usage Report Search','url'=>'carusagereport/search/{from_date?}/{to_date?}'],
            ['id'=>1003,'module'=>'Report','name'=>'Car Usage Report Export Excel','description'=>'Car Usage Report Export Excel','url'=>'carusagereport/exportexcel/{from_date?}/{to_date?}'],

            // Visit Report
            ['id'=>1004,'module'=>'Report','name'=>'Visit Report','description'=>'Visit Report Listing','url'=>'visitreport'],
            ['id'=>1005,'module'=>'Report','name'=>'Visit Report Search','description'=>'Visit Report Search','url'=>'visitreport/search/{type?}/{from_date?}/{to_date?}'],
            ['id'=>1006,'module'=>'Report','name'=>'Visit Report Export Excel','description'=>'Visit Report Export Excel','url'=>'visitreport/exportexcel/{type?}/{from_date?}/{to_date?}'],

            // Schedule Status Report
            ['id'=>1007,'module'=>'Report','name'=>'Schedule Status Report','description'=>'Schedule Status Report Listing','url'=>'schedulestatusreport'],
            ['id'=>1008,'module'=>'Report','name'=>'Schedule Status Report Search','description'=>'Schedule Status Report Search','url'=>'schedulestatusreport/search/{from_date?}/{to_date?}'],


            // Sale Summary Report
            ['id'=>1009,'module'=>'Report','name'=>'Sale Summary Report','description'=>'Sale Summary Report Listing','url'=>'salesummaryreport'],
            ['id'=>1010,'module'=>'Report','name'=>'Sale Summary Report Search','description'=>'Sale Summary Report Search','url'=>'salesummaryreport/search/{from_date?}/{to_date?}'],
            ['id'=>1011,'module'=>'Report','name'=>'Sale Summary Report Export Excel','description'=>'Sale Summary Report Export Excel','url'=>'salesummaryreport/exportexcel/{from_date?}/{to_date?}'],
            ['id'=>1012,'module'=>'Report','name'=>'Sale Summary Report Invoice Detail','description'=>'Sale Summary Report Invoice Detail','url'=>'salesummaryreport/invoicedetail/{id}'],
            ['id'=>1013,'module'=>'Report','name'=>'Sale Summary Report Invoice Export','description'=>'Sale Summary Report Invoice Export','url'=>'salesummaryreport/invoice_export/{id}'],

            // Log Patient Case Summary

            ['id'=>1014,'module'=>'Patient','name'=>'Log Patient Case Summary','description'=>'Log Patient Case Summary Listing','url'=>'patient/log'],

            ['id'=>1015,'module'=>'Patient','name'=>'Log Patient Case Summary','description'=>'Log Patient Case Summary Listing','url'=>'patient/log'],
            ['id'=>1016,'module'=>'Patient','name'=>'Search Log Patient Case Summary','description'=>'Search Log Patient Case Summary Listing','url'=>'patient/log/search'],

            //Income Summary Report
            ['id'=>1017,'module'=>'Report','name'=>'Income Summary Report','description'=>'Income Summary Report Listing','url'=>'incomesummaryreport'],
            ['id'=>1018,'module'=>'Report','name'=>'Income Summary Report Search','description'=>'Income Summary Report Search','url'=>'incomesummaryreport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}'],
            ['id'=>1019,'module'=>'Report','name'=>'Income Summary Report Export Excel','description'=>'Income Summary Report Export Excel','url'=>'incomesummaryreport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}'],
            ['id'=>1020,'module'=>'Report','name'=>'Income Summary Report Graph','description'=>'Income Summary Report Graph','url'=>'incomesummaryreportbygraph'],
            ['id'=>1021,'module'=>'Report','name'=>'Income Summary Report Graph Search','description'=>'Income Summary Report Graph Search','url'=>'incomesummaryreportbygraph/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}'],

            //car usage report
            ['id'=>1022,'module'=>'Report','name'=>'Car Usage Report Graph','description'=>'Car Usage Report Graph','url'=>'carusagereportbygraph'],
            ['id'=>1023,'module'=>'Report','name'=>'Car Usage Report Graph Search','description'=>'Car Usage Report Graph Search','url'=>'carusagereportbygraph/search/{from_date?}/{to_date?}'],

            //Log Activities
            ['id'=>300,'module'=>'Log','name'=>'Activities','description'=>'Activities','url'=>'activities'],

            //Import
            ['id'=>306,'module'=>'Import','name'=>'New','description'=>'CSV Import New','url'=>'import'],
            ['id'=>307,'module'=>'Import','name'=>'Store','description'=>'CSV Import Store','url'=>'import/store'],

            //Price History
            ['id'=>311,'module'=>'Price History','name'=>'Single Price History','description'=>'Single Price History List Page','url'=>'pricehistory/{type?}/{id?}'],
            ['id'=>312,'module'=>'Price History','name'=>'Multiple Price History','description'=>'Multiple Price History List Page','url'=>'multiplepricehistory/{type?}/{id?}'],

            //Api List
            ['id'=>321,'module'=>'Api List','name'=>'Sync Down Api Detail','description'=>'Sync Down Api Detail','url'=>'apilist/syncdownapi'],
            ['id'=>322,'module'=>'Api List','name'=>'Invoice Api Detail','description'=>'Invoice Api Detail','url'=>'apilist/invoiceapi'],
            ['id'=>323,'module'=>'Api List','name'=>'Enquiry Api Detail','description'=>'Enquiry Api Detail','url'=>'apilist/enquiryapi'],
            ['id'=>324,'module'=>'Api List','name'=>'Schedule Api Detail','description'=>'Schedule Api Detail','url'=>'apilist/scheduleapi'],
            ['id'=>325,'module'=>'Api List','name'=>'Patientpackage Api Detail','description'=>'Patientpackage Api Detail','url'=>'apilist/patientpackageapi'],
            ['id'=>326,'module'=>'Api List','name'=>'Waytracking Api Detail','description'=>'Waytracking Api Detail','url'=>'apilist/waytrackingapi'],
            ['id'=>327,'module'=>'Api List','name'=>'Patient Api Detail','description'=>'Patient Api Detail','url'=>'apilist/patientapi'],

            //Tablet Issues
            ['id'=>330,'module'=>'Tablet Issues','name'=>'Tablet Issues','description'=>'Tablet Issues','url'=>'tabletissues/{type?}'],

            //Investigation Imaging
            ['id'=>340,'module'=>'Investigation Imaging','name'=>'List','description'=>'Investigation Imaging List','url'=>'investigationimaging'],
            ['id'=>341,'module'=>'Investigation Imaging','name'=>'New','description'=>'Investigation Imaging Entry','url'=>'investigationimaging/create'],
            ['id'=>342,'module'=>'Investigation Imaging','name'=>'Store','description'=>'Investigation Imaging Store','url'=>'investigationimaging/store'],
            ['id'=>343,'module'=>'Investigation Imaging','name'=>'Edit','description'=>'Investigation Imaging Edit','url'=>'investigationimaging/edit'],
            ['id'=>344,'module'=>'Investigation Imaging','name'=>'Update','description'=>'Investigation Imaging Update','url'=>'investigationimaging/update'],
            ['id'=>345,'module'=>'Investigation Imaging','name'=>'Destroy','description'=>'Investigation Imaging Destroy','url'=>'investigationimaging/destroy'],

            //Addendum
            ['id'=>346,'module'=>'Addendum','name'=>'Store','description'=>'Addendum Store','url'=>'addendum/store'],

            //Patient Visit Report
            ['id'=>1030,'module'=>'Report','name'=>'Patient Visit Report','description'=>'Patient Visit Report Listing','url'=>'patientvisitreport'],
            ['id'=>1031,'module'=>'Report','name'=>'Patient Visit Report Search','description'=>'Patient Visit Report Search','url'=>'patientvisitreport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}'],
            ['id'=>1032,'module'=>'Report','name'=>'Patient Visit Report Export Excel','description'=>'Patient Visit Report Export Excel','url'=>'patientvisitreport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}'],

            //Patient Daily Visit Report
            ['id'=>1040,'module'=>'Report','name'=>'Patient Daily Visit Report','description'=>'Patient Daily Visit Report Listing','url'=>'patientdailyvisitreport'],
            ['id'=>1041,'module'=>'Report','name'=>'Patient Daily Visit Report Search','description'=>'Patient Daily Visit Report Search','url'=>'patientdailyvisitreport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}'],
            ['id'=>1042,'module'=>'Report','name'=>'Patient Daily Visit Report Export Excel','description'=>'Patient Daily Visit Report Export Excel','url'=>'patientdailyvisitreport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}'],
            ['id'=>1043,'module'=>'Report','name'=>'Patient Daily Visit Report Detail','description'=>'Patient Daily Visit Report Detail','url'=>'patientvisitreportdetail'],

            //New Sale Income Report
            ['id'=>1050,'module'=>'Report','name'=>'Sale Income Report','description'=>'Sale Income Report Listing','url'=>'saleincomereport'],
            ['id'=>1051,'module'=>'Report','name'=>'Sale Income Report Search','description'=>'Sale Income Report Search','url'=>'saleincomereport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}'],
            ['id'=>1052,'module'=>'Report','name'=>'Sale Income Report Export Excel','description'=>'Sale Income Report Export Excel','url'=>'saleincomereport/exportexcel/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}'],
            ['id'=>1053,'module'=>'Report','name'=>'Sale Income Report InvoiceList','description'=>'Sale Income Report InvoiceList','url'=>'saleincomereport/invoicelist/{date?}'],
            // ['id'=>1054,'module'=>'Report','name'=>'Sale Income Report Graph','description'=>'Sale Income Report Graph','url'=>'saleincomereport'],
            // ['id'=>1055,'module'=>'Report','name'=>'Sale Income Report Graph Search','description'=>'Sale Income Report Graph Search','url'=>'saleincomereport/search/{type?}/{from_date?}/{to_date?}/{from_month?}/{to_month?}/{from_year?}/{to_year?}'],

        );


        if(isset($existingPermissions) && count($existingPermissions)>0){

            $newPermissions = array();

            foreach ($permissions as $defaultPermission) {

                $existFlag = 0;
                foreach($existingPermissions as $existPermission) {

                    if($defaultPermission['id'] == $existPermission->id) {
                        $existFlag++;
                        break;
                    }
                }
                if($existFlag == 0) {
                    array_push($newPermissions, $defaultPermission);
                }

            }

            if(count($newPermissions)>0){
                DB::table('core_permissions')->insert($newPermissions);
            }
        }
        else{
            DB::table('core_permissions')->insert($permissions);
        }
        
        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Core Permission Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}