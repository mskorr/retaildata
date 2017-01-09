<?php

include_once './gen.php';
include_once './adb.php';

$cmd = get_datan("cmd");


switch ($cmd) {

    case 1:
        //get promotion based on idhealth promotion
        get_details();
        break;

    case 2:
        //get all promotions 
        get_family();
        break;

    case 3:
        get_brand();
        break;

    case 4:
        //update promotion
        save_details();
        break;

    case 5:
        //g
        create_user();
        break;

    case 6;
        add_manufacturer();
        break;

    case 7;
        // get idcho from health promotion
        login();
        break;


    case 8;
        add_brand();
        break;

    case 9;
        save_non_food_item();
        break;
    
     case 10;
        save_user_decision();
        break;
    
    case 11;
        get_family_hierarchy();
        break;

     case 12;
        get_barcode_info();
        break;
    
    default:
        echo "{";
//      json_encode($cmd);
        echo jsonn("result", 0);
        echo ",";
        echo jsons("message", "not a recognised command");
        echo "}";
}

//function add_ass_to_students(){
//   include_once './classes/student_has_assignement_class.php';
//   $p = new teacher_login_class();
//   $date_due = get_data("date");
//   $teacher_id = get_datan("teacher_id");
//   $school_id = get_datan("school_id");
//   $class_id = get_datan("class_id");
//   $subject_id = get_datan("subject_id");
//   $ass = get_data("ass");
//}

function login() {
    include_once './functions.php';
//    session_start();
    $user = get_data('user');
    $pass = get_data('pass');
    $obj = new functions();
    if ($obj->log_in($user, $pass)) {
//        $row = $obj->fetch();
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsonn("id",  $_SESSION['user_id']) . ",";
        echo jsons("username",  $_SESSION['user_name']) . ",";
        echo jsons("firstname",  $_SESSION['firstname']) . ",";
        echo jsonn("user_type",  $_SESSION['user_type']) . ",";
        echo jsons("lastname",  $_SESSION['lastname']);
        echo "}";
    } else {  
        echo "{";
        echo jsonn("result", 0);
//        echo jsons("id", $row["u00code"]) . ",";
//        echo jsons("username", $row["u00username"]) . ",";
//        echo jsons("firstname", $row["u00firstname"]) . ",";
//        echo jsons("lastname", $row["u00lastname"]);
        echo "}";
    }
}

function get_barcode_info()
{
     include_once './functions.php';
    $obj = new functions();
    $barcode = get_data("barcode");
    $shop_id = get_datan("shop_id");
    
    $obj->get_barcode_info($barcode, $shop_id);
    if($row = $obj->fetch())
    {
        $offer_val = $row["offer_value"];
        $family_id = $row["family_id"];
        $unit_id = $row["unit_of_measure"];
        $brand_id = $row["brand_id"];
        $unit = $row["unit"];
        $quality_id = $row["quality_id"];
        $packaging = $row["packaging"];
        if($offer_val == '') 
        {
            $offer_val = 'null';
//            print $offer_val;
        }
        if($family_id == '')
        {
           $family_id = 0;
        }
        if($unit_id == '')
        {
            $unit_id = 0;
        }
        if($brand_id == '')
        {
            $brand_id = 0;
        }
        if ($quality_id ==  '')
        {
            $quality_id = 0;
        }
        if($unit == '')
        {
            $unit = 0;
        }
        if($packaging == '')
        {
            $packaging = 0;
        }
        
    
      echo "{";
       echo jsonn("result", 1) . ",";
       echo jsonn("family", $family_id) . ",";
       echo jsons("family_value", $row["FAMILY"]). ",";
       echo jsons("brand_value", $row["a11brand"]). ","; 
       echo jsonn("brand", $brand_id) . ",";
       echo jsonn("unit",$unit) . ",";
       echo jsonn("unit_id", $unit_id) . ",";
       echo jsons("comment", $row["comment"]) . ","; 
       echo jsonn("packaging", $packaging) . ",";
       echo jsonn("quality_id", $quality_id) . ","; 
       echo jsons("offer_value", $offer_val) . ",";   
       echo jsons("item_description", $row["item_description_english"]);  
        
       echo "}"; 
    }
    else
    {
        echo "{";
       echo jsonn("result", 2);
      
       echo "}";  
    }
}

function get_family_hierarchy()
{
    include_once './functions.php';
    $obj = new functions();
    $obj->get_family_hierarchy(get_datan('id'));
    if($row = $obj->fetch())
    {
       echo "{";
       echo jsonn("result", 1) . ",";
       echo jsons("type", $row["TYPE"]) . ",";
       echo jsons("category", $row["CATEGORY"]) . ",";
       echo jsons("subcategory", $row["SUB_CATEGORY"]); 
       echo "}";  
    } 
}
function save_user_decision()
{
     include_once './functions.php';
     
     $b = get_data('barcode');
     $dec = get_datan("decision");
     $obj = new functions();
    if($obj->update_user_decision($b,$dec ))  
    {
      echo "{";
        echo jsonn("result", 1);  
        echo "}";
    } 
     
} 


function save_non_food_item()
{
    session_start();
    
     include_once './functions.php';
     $user_id = $_SESSION['user_id'];
     $b = get_data('barcode');
     $shop_id = get_datan('shop_id');
     $obj = new functions();
     $obj_map = new functions();
     if($obj->save_non_food_item($b, $user_id, $shop_id))
     {
       
        echo "{";
        echo jsonn("result", 1);  
        echo "}";
        
       
     }
      $obj_map->barcode_mapping($b, $shop_id);   
     
      
     
}
function add_brand() {
    include_once './functions.php';
    $obj = new functions();
    $obj_brand = new functions();
    $brand = get_data('brand');
    $man_id = get_datan('man_id');
    $obj->add_brand($brand, $man_id);
    if ($row = $obj->fetch()) {
        $obj_brand->get_brand_by_id($row["a11code"]);
        $row_brand = $obj_brand->fetch();
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsonn("insert_id", $row_brand["a11code"]) . ",";
        echo jsons("brand", $row_brand["a11brand"]);
        echo "}";  
    }
}

function add_manufacturer() {
    include_once './functions.php';
    $obj = new functions();
    $obj_man = new functions();

    $b = new functions();
    $man = get_data('manufacturer');
    $obj->add_manufacturer($man);
    if ($row = $obj->fetch()) {
        $obj_man->get_manufacturer_by_id($row['a12code']);
        $row_man = $obj_man->fetch();
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsonn("insert_id", $row_man["a12Code"]) . ",";
        echo jsons("manufacturer", $row_man["manufacturer"]);
        echo "}";
    }


//    $b->get_last_insert();
////    $b = new functions();
////    $this->get_last_id(); 
//    $row=$b->fetch();  
//      print_r($row);    
//    $b->query("Select SCOPE_IDENTITY() as 'identity'");
//    $row = $b->fetch();    
//    $row = $obj->fetch();
//     echo "this is the last id" +$row ;  
//    print_r($row);
}

function create_user() {
    include_once './functions.php';
    $obj = new functions();
    $user = get_datan("u_type");
    $fname = get_data("fname");
    $lname = get_data("lname");
    $uname = get_data("uname");
    $pass = get_data("pass");
    if ($obj->create_user($uname, $pass, $fname, $lname, $user)) {
        echo "{";
        echo jsonn("result", 1);
        echo "}";  
    }
}

function save_details() {
    session_start();
    include_once './functions.php';
    $packaging = get_datan("packaging");  
    $obj = new functions();
    $quality_id = get_datan("quality");
    $shop_id = get_datan("shop_id");
    $family_id = get_datan('family');  
    $brand_id = get_datan('brand'); 
    $barcode = get_data('barcode');
    $user_id = $_SESSION['user_id'];    
    $item_des = get_data('des');
    $unit = get_data('unit_v');
    $unit_id = get_datan("unit_id");
    $status = get_datan('status');
    $comment = get_data('comment');
    $offer = get_datan('offer');
    $offer_value = get_data('offer_value');
//    echo "this is the family" + $family_id; 
    $clean = 1;    
//   echo "you are too";  
if($item_des == '' ||  $unit == '' || $family_id == '' || $brand_id == '' || $status == 2) 
    {
        $clean = 0; 
//        echo "you are too";  
    }   
////    family 
//       
//        $obj->save_details($item_des, $unit_id, $unit, $family_id, $brand_id, $user_id, $status, $comment, $barcode, $clean);
    
        if ($obj->save_details($item_des, $unit_id, $unit, $family_id, $brand_id, $packaging, $quality_id, $offer, $offer_value, $user_id, $status, $comment, $barcode, $shop_id, $clean))
    { 
        echo "{";
        echo jsonn("result", 1);  
        echo "}";
    } 
////
//////    delete the barcodes
    $obj_map = new functions();
    $obj_map->barcode_mapping($barcode,$shop_id);
    $obj_map->fetch();  
//    
}

function get_details() {
    include_once './functions.php';

    $bc = get_data('bc');

    $obj = new functions();
    $obj->barcode_detail($bc);
    $row = $obj->fetch();
    while ($row) {
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsonn("shop_id", $row["a08retailer_shop"]) . ",";
        echo jsons("barcode", $row["BARCODE2"]) . ",";
        echo jsons("item_description", $row["ITEM_DESCRIPTION"]);
        echo "}";

        $row = $obj->fetch();
    } print_r($row);
}

function get_family() {
    include_once './functions.php';
    $obj = new functions();
    $obj->get_family();

    if ($row = $obj->fetch()) {
        echo "[";
        echo "{";
        echo jsonn("result", 1);
        echo "},";
        while ($row) {
            echo "{";
            echo jsonn("result", 1) . ",";
            echo jsonn("famiy_id", $row["a16Code"]) . ",";
            echo jsons("family", $row["a16family"]);

            echo "}";
            $row = $obj->fetch();
            if ($row) {
                echo ',';
            }
        }
        echo "]";
        return json_encode($row);
    }
}

function get_brand() {
    include_once './functions.php';
    $obj = new functions();
    $obj->get_brand();

    if ($row = $obj->fetch()) {
        echo "[";
        echo "{";
        echo jsonn("result", 1);
        echo "},";
        while ($row) {
            echo "{";
            echo jsonn("result", 1) . ",";
            echo jsonn("brand_id", $row["a11code"]) . ",";
            echo jsons("brand", $row["a11brand"]);

            echo "}";
            $row = $obj->fetch();
            if ($row) {
                echo ',';
            }
        }
        echo "]";
        return json_encode($row);
    }
}

function pay_some() {
    include_once './debt_class.php';

    $student_id = get_datan('student_id');
    $amount_paid = get_data('amount_paid');

    $debt_obj = new debt_class();

    if (!$debt_obj->pay_some($student_id, $amount_paid)) {

        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "No person exsists with this id");
        echo "}";
        return;
    } else {
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsons("message", "Successful");
        echo "}";
        return;
    }
}

function owe_more() {
    include_once './debt_class.php';

    $student_id = get_datan('student_id');
    $owe_more = get_data('owe_more');

    $debt_obj = new debt_class();

    if (!$debt_obj->owe_more($student_id, $owe_more)) {

        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "No person exsists with this id");
        echo "}";
        return;
    } else {
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsons("message", "Successful");
        echo "}";
        return;
    }
}

function add_stud() {
    include_once './debt_class.php';

    $student_id = get_datan('stud_id');
    $name = get_data('name');

    $debt_obj = new debt_class();

    if (!$debt_obj->add_student($student_id, $name)) {

        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Could not add person");
        echo "}";
        return;
    } else {
        echo "{";
        echo jsonn("result", 1) . ",";
        echo jsons("message", "Person added");
        echo "}";
        return;
    }
}

function get_all_subjects() {
    include_once '../hw_tracker_teacher/classes/subject_class.php';

    $schools_obj = new subject_class();
    if (!$schools_obj->get_all_details()) {

        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("subjects", "No class found");
        echo "}";
        return;
    }
    $row = $schools_obj->fetch();
    if (!$row) {

        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("subjects", "No class found1d");
        echo "}";
        return;
    } else {
        echo "{";
        echo jsonn("result", 1);
        echo ',"subjects":';
        echo "[";

        while ($row) {
            echo "{";
            echo jsonn("id", $row["subject_id"]) . ",";
            echo jsons("subject_name", $row["subject_name"]);
            echo "}";

            $row = $schools_obj->fetch();
            if ($row) {
                echo ",";
            }
        }
        echo "]}";
    }
}

function get_all_classes() {
    include_once '../hw_tracker_teacher/classes/class_class.php';

    $schools_obj = new class_class();
    if (!$schools_obj->get_all_details()) {

        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("schools", "No class found");
        echo "}";
        return;
    }
    $row = $schools_obj->fetch();
    if (!$row) {

        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("classes", "No class found1d");
        echo "}";
        return;
    } else {
        echo "{";
        echo jsonn("result", 1);
        echo ',"classes":';
        echo "[";

        while ($row) {
            echo "{";
            echo jsonn("id", $row["class_id"]) . ",";
            echo jsons("class_number", $row["class_number"]);
            echo "}";

            $row = $schools_obj->fetch();
            if ($row) {
                echo ",";
            }
        }
        echo "]}";
    }
}

function send_message() {
    $date_due = get_data("date");
    $teacher_id = get_datan("teacher_id");
    $url = "https://api.smsgh.com/v3/messages/send?"
            . "From=%2B233244813169"
            . "&To=%2B233502128010"
            . "&Content=Teacher+with+id:+$teacher_id+just+posted+an+assignment+due+$date_due"
            . "&ClientId=odfbifrp"
            . "&ClientSecret=rktegnml"
            . "&RegisteredDelivery=true";
// Fire the request and wait for the response
    $response = file_get_contents($url);
    print($response);
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message sent", "d1d");
    echo "}";
    return;
}

function get_all_schools() {
//   session_start();
//   $_SESSION['paid']=0;


    include_once '../hw_tracker_teacher/classes/school_class.php';

    $teacher_id = get_datan("teacher_id");

    $schools_obj = new school_class();
    if (!$schools_obj->get_all_sch_teacher_teaches($teacher_id)) {

        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("schools", "No school found");
        echo "}";
        return;
    }
    $row = $schools_obj->fetch();
    if (!$row) {

        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("schools", "No school found1d");
        echo "}";
        return;
    } else {
        echo "{";
        echo jsonn("result", 1);
        echo ',"schools":';
        echo "[";

        while ($row) {
            echo "{";
            echo jsonn("id", $row["school_id"]) . ",";
            echo jsons("school_name", $row["school_name"]);
            echo "}";

            $row = $schools_obj->fetch();
            if ($row) {
                echo ",";
            }
        }
        echo "]}";
    }
}

function transact() {
    session_start();
//   $_SESSION['paid']=0;


    $last_inserted_id = $_SESSION['last_insert_id'];

    $id = get_datan('user_id');
    $new_amount = get_datan('new_amount');
    $amount_before = get_datan('amount_before');
    $fare = get_datan('fare');
    $ticket = get_datan('ticket_num');
    $pick_up_location = get_datan("location");

    if ($id == 0) {
        return;
    }

    include_once './transaction_class.php';
    include_once './user_class.php';
    include_once './details_class.php';

    $p = new user_class();
    $q = new transaction_class();
    $d = new deatils_class();

    $row3 = 0;

//   print($d->get_isert_id($d));


    if ($d->get_details($last_inserted_id)) {
        $row3 = $d->fetch();
    }

    if ($row3 == 0 || $row3['seatsLeft'] == 0) {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "No seats left");
        echo "}";
        return;
    }

//   $already_reserved = 0;
    if ($q->search_transactions($id)) {
        $already_reserved = $q->fetch();
    }
//   print_r( $already_reserved);
    if ($already_reserved['c'] != 0) {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo '"trans":{';
        echo jsons("message", "Already Reserved") . ",";
        echo jsons("ticket_num", $already_reserved['c']);
        echo "}";
        echo "}";
//      $_SESSION['paid'] = 1;
        return;
    }

    $row = $p->deduction($id, $new_amount);
    $row2 = $q->transaction($id, $fare, $ticket, $new_amount, $pick_up_location);

    $row4 = $d->update_info($row3['info_id'], $row3['seatsLeft'] - 1, $row3['numOfPssngrsReserved'] + 1, $row3['numOfSeats'], $row3['numOfPssngrsBus'], $row3['longitude'], "\"" . $row3['locationAddress'] . "\"", $row3['latitude']);

    if (!$row || !$row2 || !$row4) {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Not saved");
        echo "}";
        return;
    }

    echo "{";
    echo jsonn("result", 1) . ",";
    echo '"user":{';
    echo jsons("tran", "transaction successful");
    echo "}";
    echo "}";

//    $_SESSION['paid'] = 1;
//    print $_SESSION['paid'];
}

//function login() {
//    include_once './classes/teacher_login_class.php';
////   include_once './details_class.php';
////   $details_obj = new deatils_class();
////   if (!$details_obj->get_all_details()) {
////      
////   } else {
////      $details_row = $details_obj->fetch();
////   }
////   session_start();
//    $user = get_data('user');
//    $pass = get_data('pass');
//    $p = new teacher_login_class();
//    $val = $p->loginAsTeach($user, $pass);
////   $row = 0;
//    if ($val) {
//        $row = $p->loadProfile($user);
//        if ($row) {
//            echo "{";
//            echo jsonn("result", 1);
//            echo ',"user":';
//            echo "{"; 
//            echo jsons("id", $row["teacher_id"]) . ",";
//            echo jsons("username", $row["username"]) . ",";
//            echo jsons("firstname", $row["firstname"]) . ",";
//            echo jsons("lastname", $row["lastname"]);
//            echo "}";
//            print "}";
//            return;
//        }
//    } else {
//        echo "{";
//        echo jsonn("result", 0) . ",";
//        echo jsons("message", "error, no record retrieved");
//        echo "}";
//    }
////   if it's a new day - reset all values
////   include_once './details_class.php';
////   $det_obj = new deatils_class();
////   if (!$det_obj->get_all_details()) {
////      echo "{";
////      echo jsonn("result", 0) . ",";
////      echo jsons("message", "error, no record retrieved2");
////      echo "}";
////      return;
////   }
////   $last_inserted_id = 0;
////   $row2 = $det_obj->fetch();
//////   print_r($row2);
////   $row3 = $row2;
////   while ($row2) {
//////      $row3 = $row2;
////
////      $last_inserted_id = $row2['info_id'];
////      $_SESSION['last_insert_id'] = $last_inserted_id;
////
////      $row2 = $det_obj->fetch();
////   }
////   print_r($_SESSION);
////
////   $det_obj2 = new deatils_class();
////
//////   print_r ($row3);
//////   print $row3['date_created'];
////
////   $dt = new DateTime($row3['date_created']);
////
////   $dt1 = $dt->format('d-m-Y');
//////   print "---------------" . ($row3['date_created']);
////   $dt2 = date('d-m-Y');
//////           
//////   print "dt1 " . ($dt1);
//////   print "dt2 " . ($dt2);
//////   print ($dt1 === $dt2);
//////   
//////exit();
////
////   if ($dt1 == $dt2) {
//////      print "here";
////      return;
////   } else {
//////      exit();
////      // create a new info row
////      if (!$det_obj->add_info($row3['numOfSeats'], 0, $row3['numOfSeats'], 0, $row3['longitude'], $row3['locationAddress'], $row3['latitude'])) {
//////       this should be concatenated witht the top
////         echo "{";
////         echo jsonn("result", 0) . ",";
////         echo jsons("message", "error, could not create new tuple");
////         echo "}";
//////         exit();
////      }
////      $_SESSION['last_insert_id'] = $det_obj->get_insert_id($det_obj);
//////      print "created";
////   }
////   echo jsons("last_insert_id", $_SESSION['last_insert_id']);
////   echo "}";
////   print "}";
////   return;
//}

function diver_update_bus_location() {
    $info_id = 1;
    $longitude = get_data('long');
    $latitude = get_data('lat');

    include_once './details_class.php';
    $update = new deatils_class();

    if (!$update->update_location($longitude, $latitude, $info_id)) {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "error, Unsuccesful");
        echo "}";
        return;
    }
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message", "Succesful");
    echo "}";
}

function get_bus_loca() {
    include_once './details_class.php';
    $det = new deatils_class();
    if (!$det->get_all_details()) {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "error, Unsuccesful");
        echo "}";
        return;
    }
    $row = $det->fetch();
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("x", $row['longitude']) . ",";
    echo jsons("y", $row['latitude']);
    echo "}";
    return;
}

function increase() {

    session_start();
    $last_inserted_id = $_SESSION['last_insert_id'];
    $seats_left = get_data("seats_left");
    $pass_res = get_data('pass_res');
    $pass_on = get_data('pass_on');

    include_once './details_class.php';
    $d = new deatils_class();
//exit();
    $row4 = $d->update_pass($seats_left, $pass_res, $pass_on, $last_inserted_id);

    if (!$row4) {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "error, Unsuccesful");
        echo "}";
        return;
    }
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message", "Successful");
    echo "}";
}

function decrease() {
    session_start();
//   $_SESSION['paid']=0;


    $last_inserted_id = $_SESSION['last_insert_id'];
}
