<?php
    
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
     
/**
 * 
 *
 * @author Miss
 */
include_once 'adb.php';
    
//include_once("http://212.71.238.208/Barcode_Verification/functions/adb.php");
    
class functions extends adb {
    
    function functions() {
        adb::adb();
    }
        
    function log_in($user, $pass) {
//        $p = sha1($pass); 
        $query = "Select * from t26users u where u.a26username ='$user' and u.a26password = HASHBYTES('SHA1' , '$pass')";
//        print  $query;
        if ($this->query($query)) {
            $row = $this->fetch();
            if ($row) {
                session_start();
                $_SESSION['user_id'] = $row['a26code'];
                $_SESSION['user_name'] = $row['a26username'];
                $_SESSION['firstname'] = $row['a26firstname'];
                $_SESSION['lastname'] = $row['a26lastname'];
                $_SESSION['user_type'] = $row['a26user_type'];
                return $row;
            } else {
                return false; 
            }
        }
        return $this->query($query);
    }
        
    function barcode_mapping($barcode,$shop_id) {
        if($shop_id == 0)
    {
        $shop = 'null';  
        $cat = 1;
                $query = "delete b
            from t03_staging_bk b 
            where b.BARCODE2 =  '$barcode' 
            and b.a03Code not in  
            (
            Select max(b.a03Code) 
            from t03_staging_bk b
            where b.BARCODE2 = '$barcode'  
            );  
            delete bm
            from t10_barcode_mapping_staging bm 
            where bm.a10Barcode =  '$barcode'
            and bm.a10Barcode_Id not in 
            ( 
            Select max(b.a03Code)  
            from t03_staging_bk b
            where b.BARCODE2 = '$barcode'
            );
            update bm  
            set bm.a10sku_category = 1,
            bm.a10shop_id = null 
            from t10_barcode_mapping_staging bm where bm.a10Barcode =  '$barcode'; 
            update s
            set s.a08barcode_code = b.a03Code
            from t08sale_transactions s 
            inner join t03_staging_bk b
            on b.BARCODE2 = s.BARCODE2
            where s.BARCODE2 = '$barcode'"; 
    }
    else
    {
     $shop = $shop_id;  
     $cat = 2;
         
       $query = "update bm  
            set bm.a10sku_category = $cat,
            bm.a10shop_id = $shop 
            from t10_barcode_mapping_staging bm where bm.a10Barcode =  '$barcode' and a10shop_id = $shop"; 
    }
        
        
        return $this->query($query); 
    } 
        
//    function barcode_mapping_update($barcode)
//    {
//        
//    }
    function get_family_hierarchy($id)
    {
        $query = "Select * from v_categories c where c.family_id =$id"; 
//            print($query_clean);
            $this->query($query);   
    }
    
    function save_details($item_description, $unit_id, $unit, $family_id, $brand_id,$packaging, $quality_id, $offer,$offer_value, $user_id, $status, $comment, $barcode, $shop_id, $clean) {
$offer_string = " '" . $offer_value . "'"; 
        if($unit == '' || $unit == 0)
    {
        $unit = 'null';
    } 
    
    if($offer == 0) 
    {
        $offer = 'null';
    }
    
    if($offer_value == '') 
    {
        $offer_value = null;
        $offer_string = 'null';
    }
    
      if($packaging == '' || $packaging == 0 ) 
    {
        $packaging = 'null';
    }  
     
        if($family_id == 0)
    {
        $family_id = 'null';
    } 
     
        if($brand_id == 0)
    { 
        $brand_id = 'null';
    } 
    
     if($quality_id == 0)
    { 
        $quality_id = 'null';
    } 
    
        if($unit_id == 0) 
    {
        $unit_id = 'null'; 
    }   
    
    $item_description = strtoupper($item_description); 
//     print "thshi si slean" . $clean;
    if($shop_id == 0)
    {
        
//        $shop = 'null';
//        $cat = 1;
        $query= " update b
            set b.a03Retailer_shop = null, 
            b.a03sku_category = 1,
            b.a03offer = $offer,
            b.a03offer_value = $offer_string,
            b.a03family_id = $family_id,
            b.a03brand_id = $brand_id,
            b.ITEM_DESCRIPTION_ENGLISH = '$item_description', 
            b.a03packaging_units = $packaging,
            b.a03units = $unit,
            b.a03unit_of_measure = $unit_id,
            b.a03item_type = 'FOOD ITEM',
            b.a03user_id = $user_id,
            b.a03quality_id = $quality_id,
            b.a03date_modified = getdate()
            from t03_staging_bk b
            where b.BARCODE2 = '$barcode'";   
                
         if($clean == 1)
        {
            $query_clean = "Delete l from t23_staging l where l.barcode2 = '$barcode'";
//            print($query_clean);
            $this->query($query_clean); 
        }
        else
        {
            $query_update = "update s 
            set s.brand_id = $brand_id,
            s.a08retailer_shop = null,
            s.family_id = $family_id,
            s.offer = $offer,
            s.offer_value = $offer_string, 
            s.comment = '$comment',
            s.date_modified = GETDATE(),
            s.user_id = $user_id,
            s.quality_id = $quality_id,
            s.packaging = $packaging,
            s.item_description_english = '$item_description',
            s.item_type = 'FOOD ITEM', 
            s.[status] = $status,
            s.unit = $unit,
            s.unit_of_measure = $unit_id
            from t23_staging s where s.BARCODE2 = '$barcode'";
//                
//            print $query_update;  
    
             $this->query($query_update);  
        }
    }
        
        
    else
    {
     $shop = $shop_id;  
//     $cat = 2;
     $query= " update b
            set b.a03Retailer_shop = $shop,
            b.a03sku_category = 2,
            b.a03family_id = $family_id,
            b.a03offer = $offer,
            b.a03offer_value = $offer_string, 
            b.a03brand_id = $brand_id,
            b.a03packaging_units = $packaging,
            b.ITEM_DESCRIPTION_ENGLISH = '$item_description', 
            b.a03unit_of_measure = $unit_id,
            b.a03units= $unit,
            b.a03quality_id = $quality_id,
            b.a03user_id = $user_id,
            b.a03date_modified = getdate(),
            b.a03item_type = 'FOOD ITEM'
            from t03_staging_bk b
            where b.BARCODE2 = '$barcode' and b.a03retailer_shop = $shop";    
                
                
      if($clean == 1)
        {
            $query_clean = "Delete l from t23_staging l where l.barcode2 = '$barcode' and l.a08retailer_shop = $shop ";
//            print($query_clean);
            $this->query($query_clean); 
        }
        else
        {
            $query_update = "update s
            set s.brand_id = $brand_id,
            s.family_id = $family_id,
            s.comment = '$comment',
            s.offer = $offer,
            s.offer_value = $offer_string,    
            s.date_modified = GETDATE(),
            s.user_id = $user_id,
            s.packaging = $packaging,
            s.quality_id = $quality_id,
            s.item_description_english = '$item_description',
            s.item_type = 'FOOD ITEM', 
            s.[status] = $status,
            s.unit = $unit,
            s.unit_of_measure = $unit_id
            from t23_staging s where s.BARCODE2 = '$barcode' and s.a08retailer_shop = $shop";
                
//            print $query_update;
    
             $this->query($query_update);  
        }
    } 
        
        
//        print $query; 
    
    
    
//        
//        $query = "Update s"
//                . " set s.item_description_english = '$item_description',"
//                . "s.unit_of_measure = $unit_id,"
//                . "s.unit = '$unit',"
//                . "s.family_id = $family_id,"
//                . "s.brand_id = $brand_id,"
//                . "s.user_id = $user_id,"
//                . "s.date_modified = getdate(),"
//                . "s.item_type = 'Food Item',"
//                . "s.status = $status,"
//                . "s.comment = '$comment'"
//                . " from t23_staging s "
//                . " where s.barcode2 = '$barcode'"; 
//       print $query;
        return $this->query($query);
    }
        
    function clean_staging_table()
    {
//        query
    }
        
    function get_units() { 
        
        $query = "Select * from t25units_of_measure";
        return $this->query($query);
    }
        
    function create_user($user, $pass, $fname, $lname, $type) {
       
//        $p1 = sha1($pass);   
//        echo'<br>';
//                echo 'passsha' . $p;
//                echo'<br>';
        $query = "Insert into t26users (a26username, a26password, a26firstname,a26lastname, a26user_type) values ('$user', HASHBYTES('SHA1' , '$pass'),'$fname', '$lname', $type )";
//        print $query;    
        return $this->query($query); 
    }
        
    function add_family($family) {
        $query = "insert into t16family (a16family) values ($family)";
        return $this->query($query);
    }
        
    function update_user_decision($barcode, $dec)
    {
         $query = "update t set t.user_decision = $dec from t23_staging t where t.BARCODE2 = '$barcode'";  
             
        return $this->query($query); 
    } 
        
//    function check_user_decision($barcode)
//    {
//          $query = " ";  
//         
//        return $this->query($query); 
//    }
    
    
    function show_barcodes() {
        $query = "select top 50 st.BARCODE2, max(st.ITEM_DESCRIPTION) as ITEM_DESCRIPTION
                from t23_staging st
                where st.assigned_user_id = $_SESSION[user_id]
                group by st.BARCODE2, st.priority_rank 
		order by st.priority_rank, st.barcode2";   
 
//        $query = "select * from t23_staging st
//                    where BARCODE2 in
//                            (
//                            select  st.barcode2 
//                            from t23_staging st
//                            group by st.barcode2
//                            having count(1) > 1
//                            )
//                            and st.assigned_user_id = $_SESSION[user_id]"
//                . "and st.date_modified is null ";
        return $this->query($query);
    } 
        
    function get_count($barcode) {
        $query = "select count(1) as count1 from t23_staging st where st.BARCODE2 = '$barcode'";
        return $this->query($query);
    }
        
    function get_barcode_info($barcode, $shop_id)
    {
        if($shop_id == 0)
        {
           
             $query = "Select top 1 * from t23_staging bv left join v_categories v on v.FAMILY_ID = bv.family_id left join t11_staging b on b.a11code = bv.brand_id
where bv.Barcode2 ='$barcode' and bv.a08retailer_shop is null
";
        }
        else 
        {
             $query = "Select top 1 * from t23_staging bv left join v_categories v on v.FAMILY_ID = bv.family_id left join t11_staging b on b.a11code = bv.brand_id where bv.Barcode2 ='$barcode' and bv.a08retailer_shop = $shop_id"; 
        }
             
       
//        print $query;
        return $this->query($query);
    } 
    
    function barcode_detail($bc) {
        $query = "Select * from t23_staging bv where bv.Barcode2 ='$bc'";
        return $this->query($query);
    }
    function get_last_id() {
        $query = "Select scope_identity() as 'identity' ";
        return $this->query($query);
    }
        
    function get_family() {
        $query = "Select * from v_categories where FAMILY <> 'NON AVAILABLE' order by FAMILY asc"; 
        return $this->query($query);
    }
        
    function save_non_food_item($b, $user_id, $shop_id) {
        if($shop_id == 0)
        {
            $query="update b
                set b.a03item_type = 'NON-FOOD ITEM',
                b.a03Retailer_shop = null,
                b.a03sku_category = 1,
                b.a03user_id = $user_id,
                b.a03date_modified = getdate()
                from t03_staging_bk b
                where b.BARCODE2 ='$b';"
                . "Delete l "
                . " from t23_staging l"
                . " where l.barcode2 = '$b'";
        }
        else
        {  
             $query="update b
                set b.a03item_type = 'NON-FOOD ITEM',
                b.a03Retailer_shop = $shop_id,
                b.a03sku_category = 1,
                b.a03user_id = $user_id,
                b.a03date_modified = getdate()
                from t03_staging_bk b
                where b.BARCODE2 ='$b' and b.a03Retailer_shop = $shop_id;"
                . "Delete l "
                . " from t23_staging l"
                . " where l.barcode2 = '$b' and l.a08retailer_shop = $shop_id"; 
        }
       
//        $query = "update s"
//                . " set s.status=0,"
//                . " s.item_type = 'Non food Item',"
//                . " s.user_id = $user_id,"
//                . "s.date_modified = getdate()"
//                . " from t23_staging s"
//                . " where s.barcode2 = '$b'";
//         print $query; 
        return $this->query($query);
    }
        
    function get_manufacturer_by_id($id) {
        $query = "Select * from t12_staging where a12code = $id";
        return $this->query($query);
    }
        
    function add_brand($brand, $man_id) {
        $query = "insert into t11_staging (a11brand ,a11manufacturer_id) OUTPUT INSERTED.a11code values ('$brand',$man_id)";
        return $this->query($query);
    }
        
    function get_brand_by_id($id) {
        $query = "Select * from t11_staging where a11code = $id";
        return $this->query($query);
    }
        
    function add_manufacturer($manufacturer) {
        $query = "insert into t12_staging (manufacturer) OUTPUT INSERTED.a12code values ('$manufacturer')";
        return $this->query($query);
    }
        
    function get_last_insert() {
        $query1 = "Select scope_identity() as 'identity'";
        return $this->query($query1);
    }
        
    function get_manufacturer() {
        $query = "Select * from t12_staging order by manufacturer asc ";
        return $this->query($query);
    }
        
    function get_quality()
    {
        $query = "Select * from t28quality"; 
        return $this->query($query);
    }
    function get_brand() {
        $query = "Select * from v_brand order by a11brand asc ";
        return $this->query($query);
    }
        
    function get_users() {
        $query = "Select * from t26users ";
//        print $query;
        return $this->query($query);
    }
        
    function get_user_type() {
        $query = "Select * from t27_user_type ";
        return $this->query($query);
    }
        
//    function get_all_delegates() {
//        $query = "Select * from delegate_table_mw";
//        return $this->query($query);
//    }
//
//    function add_meeting($sid, $name, $description, $date) {
//        $query = "Insert into meeting_table_mw (name, description, date, sid) values ('$name', '$description', '$date', '$sid')";
//        return $this->query($query);
//    }
//
//    function return_last_support_staff() {
//        $query = "Select Max(sid) from support_table";
//        return $this->query($query);
//    }
//
//    function log_in_support($username, $password) {
//        $query = "Select * , count(*) as c from support_table where username= '$username'  and password = '$password'";
////        print $query;
//        return $this->query($query);
//    }
//
//    function check_in_delegate($did, $mid, $qr_code) {
//        $query = "Update delegate_meeting_table set qr_code = $qr_code where mid = $mid and did=$did";
//        return $this->query($query);
//    }
//
//    function get_attendance_by_meeting_id($mtid) {
//        $query = "Select count(*) as c from delegate_meeting_table where mid = $mtid and qr_code > 0";
//        return $this->query($query);
//    }
//
//    function get_all_meetings() {
//        $query = "Select * from support_table inner join meeting_table_mw on support_table.sid = meeting_table_mw.sid";
//        return $this->query($query);
//    }
//
//    function get_meetings() {
//        $query = "Select * from meeting_table_mw";
//        return $this->query($query);
//    }
//
//    function add_delegate($name, $username, $password, $email, $phone_number, $organisation, $code) {
//        $query = "Insert into delegate_table_mw (name,username,password,email,phone_number,organisation,sms_code) values ('$name', '$username', '$password' , '$email', $phone_number, '$organisation', $code)";
////                        print $query;
//        return $this->query($query);
//    }
//
//    function return_last_id() {
//        $query = "Select Max(did) from delegate_table_mw";
//        return $this->query($query);
//    }
//
//    function get_mid_from_sid($sid) {
//        $query = "Select * from meeting_table_mw where sid = $sid";
//        return $this->query($query);
//    }
//
//    function confirm_registration($code) {
//        $query = "Update delegate_table_mw set registered = 'yes' where sms_code = $code";
//        return $this->query($query);
//    }
//
//    function get_meeting_by_delegate_id($id) {
//        $query = "Select * from delegate_meeting_table inner join meeting_table_mw on mid = mtid  where did = $id";
//        return $this->query($query);
//    }
//
////    function update_qr_code_by_ids($code, $did, $mid)
////    {
////        $query = "Update ";
////        return $this->query($query);
////    }  
//
//    function login_delegate_data($username, $password) {
//        $query = "Select * from delegate_table_mw where username= '$username'  and password = '$password'";
//        return $this->query($query);
//    }
//
//    function login_delegate($username, $password) {
//        $query = "Select  count(*) as c from delegate_table_mw where username= '$username'  and password = '$password'";
////                    print $query;
//        $this->query($query);
//        $row = $this->fetch();
//        if ($row['c'] == 1) {
//            return true;
//        } else {
//            return false;
//        }
//
//        return $this->query($query);
//    }
//
//    funcsavetion add_delegate_meeting($did, $mid) {
//
//        $query = "Insert into delegate_meeting_table (did,mid) values ($did, $mid)";
//        return $this->query($query);
//    }
//
//    function get_delegate_by_sms($sms) {
//        $query = "Select * from delegate_table_mw where sms_code = $sms";
//        return $this->query($query);
//    }
    
    /**
     * updates the record identified by id 
     */
//		function update_applicant($applicant_id,$firstname,$lastname,$othernames,$address,$residence,$relationahip_to_child,$workplace,$consent_id){
//			//write the SQL query and call $this->query()
//			$query="update applicant set firstname='$firstname',lastname='$lastname',othernames='$othernames',
//			address='$address',residence='$residence',relationahip_to_child='$relationahip_to_child',workplace='$workplace',consent_id='$consent_id',
//			last_modified=now()	where applicant_id=$applicant_id";
//			return $this->query($query);
//		}
//		/**
//		*query to delete a applicant 	
//		*@return if successful true else false
//		*/
//		function delete_applicant($applicant_id){
//			$query="Delete from applicant where applicant_id=$applicant_id";
//			return $this->query($query);
//		}
//		
//		function get_applicant_byID($applicant_id){
//			$query="Select * from applicant where applicant_id=$applicant_id";
//			return $this->query($query);
//		}
    //put your code here
}
    
// $obj = new category();
// 
// if($obj->get_all_categories())
// {
//     echo"cannot find categories";
// }
// 
//  echo"fetching";
//     $row = $obj->fetch();
//     while ($row)
//     {
//         echo $row['name'];
//     }
// else
// {  
//      
// }
// ecdeleteho"fetching";
//  
?>  