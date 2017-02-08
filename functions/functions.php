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
                $_SESSION['country_id'] = $row['a26country_id']; 
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
    
    function save_retailer_and_shop(
            $insert_retailer,$shop_name_shop,	
            $shop_status, $governorate,	$kazaa,	
            $village, $location, $manager_name,	
            $manager_contact, $email, $longitude, $latitude,
            $landline, $chain, $merchant_number_edited,	
            $merchant_code, $merchant_no, $retailer_id, $country, $shop_name, $shop_owner_name, $owner_contact, $owner_nationality
)
    {
//        NULLIF('TechOnTheNet.com', 'TechOnTheNet.com')
        if($insert_retailer === '' || $insert_retailer === ' ')
        {
            $query = "insert into t00retailers_testing (a00RETAILER_ID, a00COUNTRY_ID,a00SHOP_NAME, a00SHOP_OWNER_NAME,a00SHOP_OWNER_CONTACT_NO,
a00Chain, Shop_owner_nationality)  OUTPUT INSERTED.a00code values 
(
	nullif('$retailer_id',''),$country,nullif('$shop_name',''), nullif('$shop_owner_name',''), nullif('$owner_contact',''), nullif('$chain',''), nullif('$owner_nationality', '')
) ;";
            
            $this->query($query);
            $row = $this->fetch();
            
//            $query = "insert into t00retailers_testing (a00RETAILER_ID, a00COUNTRY_ID,a00SHOP_NAME, a00SHOP_OWNER_NAME,a00SHOP_OWNER_CONTACT_NO,
//a00Chain, Shop_owner_nationality)  OUTPUT INSERTED.a00code values 
//(
//	'$retailer_id',$country,'$shop_name', '$shop_owner_name', '$owner_contact', '$chain', '$owner_nationality'
//) ;";
////            PRINT $query; 
//            $this->query($query);
//            $row = $this->fetch();
            
         $query =   "insert into t02retailer_shops_testing (a02Retailer, a02Name, a02Shop_Status,a02GOVERNORATE,
a02KAZAA, a02VILLAGE, a02Location,a02SHOP_MANAGER_NAME, a02SHOP_MANAGER_CONTACT_NO, a02SHOP_EMAIL,
a02LONGITUDE,a02LATITUDE, a02SHOP_LANDLINE, a02Merchant_number_bank, a02Merchant_Code, a02MARCHANT_NO
) 
values
(
	$row[a00code],
	nullif('$shop_name_shop',''),
	$shop_status,
	nullif('$governorate', ''),
	nullif('$kazaa', ''),
	nullif('$village',''),
	nullif('$location',''),
	nullif('$manager_name',''),
	nullif('$manager_contact', ''),
	nullif('$email',''),
	nullif('$longitude',''),
	nullif('$latitude',''),
        nullif('$landline',''),
	nullif('$merchant_number_edited', ''),
	nullif('$merchant_code', ''),
	nullif('$merchant_no','')
) ";  
//         print $query;
           $this->query($query); 
//           $row = $this->fetch();
            return ($row['a00code']);     
        }
        else
        {
            $query="insert into t02retailer_shops_testing (a02Retailer, a02Name, a02Shop_Status,a02GOVERNORATE,
a02KAZAA, a02VILLAGE, a02Location,a02SHOP_MANAGER_NAME, a02SHOP_MANAGER_CONTACT_NO, a02SHOP_EMAIL,
a02LONGITUDE,a02LATITUDE, a02SHOP_LANDLINE, a02Merchant_number_bank, a02Merchant_Code, a02MARCHANT_NO
) 
values
(
	$insert_retailer,
	nullif('$shop_name_shop',''),
	$shop_status,
	nullif('$governorate', ''),
	nullif('$kazaa', ''),
	nullif('$village',''),
	nullif('$location',''),
	nullif('$manager_name',''),
	nullif('$manager_contact', ''), 
	nullif('$email',''),
	nullif('$longitude',''),
	nullif('$latitude',''),
        nullif('$landline',''),
	nullif('$merchant_number_edited', ''),
	nullif('$merchant_code', ''),
	nullif('$merchant_no','')
)";
            return $this->query($query);  
        }
//       print $query; 
       
        
    }
    function get_kazaa_village_governorate($id)
    {
//        if 1 then kazaa, 2 then village, 3 then governorate, 4 then shop statuses
        if ($id === 1)
        {
            $query = "select distinct(r.a02KAZAA) as name,  1 as code
                        from t02retailer_shops_testing r 
                        where r.a02KAZAA <> ''
                        order by r.a02KAZAA";
             return $this->query($query);
                 
        }
        elseif ($id ===2) 
            { 
                $query = "select distinct(r.a02VILLAGE) as name, 1 as code
                            from t02retailer_shops_testing r 
                            where r.a02VILLAGE <> ''
                            order by r.a02VILLAGE";
                 return $this->query($query);
            }
                
                
            elseif ($id ===3) 
            {
                $query = "select distinct(r.a02GOVERNORATE) as name, 1 as code
                            from t02retailer_shops_testing r 
                            where r.a02GOVERNORATE <> ''
                            order by r.a02GOVERNORATE";
                 return $this->query($query);
            }
            
                elseif ($id ===4) 
            {
                $query = "select r.a30status as name, r.a30Code as code
                            from t30shop_status r";          
                 return $this->query($query); 
            }
                
                
    }
        
    function get_countries($id)
    {
       
             $query = "Select * from t17countries s where s.a17code in (106,125,111)";
        return $this->query($query);
       
        
       
       
    }
    function barcode_mapping($barcode,$shop_id) {
        if($shop_id == 0)
    {
        $shop = 'null';  
        $cat = 1;
//        
       
                $query = "exec [dbo].[sp_retail_tool_mapping] @barcode = '$barcode';
                         update s 
                        set s.a08barcode_code = tt.barcode_id
                        from t08sale_transactions s, 
                        (
                        Select max(b.a03Code) barcode_id
                         from t03barcodes b 
                         where b.BARCODE2 = '$barcode'
                        ) tt
                        WHERE s.BARCODE2 = '$barcode';
                            
                        delete b 
                        from t03barcodes b
                        where b.BARCODE2 = '$barcode'
                        and b.a03Code not in 
                        (
                         Select max(b.a03Code)
                         from t03barcodes b 
                         where b.BARCODE2 = '$barcode'
                        );

                        update bm 
                        set bm.a10sku_category = 1, 
                        bm.a10shop_id = null 
                        from t10_barcode_mapping bm
                        where bm.a10Barcode_Id in
                        (
                        Select max(b.a03Code)
                        from t03barcodes b 
                        where b.BARCODE2 = '$barcode'
                     ); 
                 exec [dbo].[sp_BarcodesDeleteT10duplicates];"; 
    }
    else
    {
     $shop = $shop_id;  
     $cat = 2;
         
       $query = "update bm  
            set bm.a10sku_category = $cat,
            bm.a10shop_id = $shop 
            from t10_barcode_mapping bm where bm.a10Barcode =  '$barcode' and a10shop_id = $shop"; 
    }
         
//        print $query;
        return $this->query($query); 
    } 
        
        
//    function barcode_mapping_update($barcode)
//    {
//        
//    }]
    function get_shops_per_retailer_id($retailer_id, $shop_id)
    {
        if($shop_id === 0)
        {
            $query = "select * from t02retailer_shops_testing s where s.a02Retailer = $retailer_id"; 
//            print $query;
           return $this->query($query); 
        }
            
        else
        {
             $query = "select *  
                    from t02retailer_shops_testing s 
                    inner join t30shop_status r
                    on r.a30code = a02Shop_Status 
                    where s.a02code = $shop_id
";   
           return $this->query($query); 
        }
    }
        
    function get_retailer_per_id($id)
    {
        $query = "select * 
                  from t00retailers_testing r
                  where r.a00code = $id"; 
        return $this->query($query); 
    }
        
    function update_retailer_per_id($retailer_id, $shop_name, $owner_name, $owner_contact, $owner_nationality, $id)
    { 
                $query="update s
        set s.a00RETAILER_ID =nullif('$retailer_id', '') ,
        s.a00SHOP_NAME = nullif('$shop_name' , ''),
        s.a00SHOP_OWNER_NAME = nullif('$owner_name', ''),
        s.a00SHOP_OWNER_CONTACT_NO = nullif('$owner_contact', ''),
        s.Shop_owner_nationality =  nullif('$owner_nationality', '')
        from t00retailers_testing s
        where s.a00code = $id";   
         
         return $this->query($query); 
    }
    
    
    function update_retailer_shops($village,$kazaa,$shop_status,$governate,$location,
            $landline,$longitude,$latitude,$merchant_no,$merchant_code,$merchant_number_edited, $email, $manager_contact,
            $shop_name, $manager_name, $id)
                
     { 
//        echo 'this is the shop status' .$shop_status; 
        $merchant_number_edited_s = " '" . $merchant_number_edited . "'";
        $shop_status_s =  " '" . $shop_status . "'";
        $kazaa_s = " '" . $kazaa . "'"; 
         $location_s = " '" . $location . "'"; 
        $governate_s = " '" . $governate. "'";   
        $village_s = " '" . $village . "'"; 
        $landline_s = " '" . $landline. "'"; 
        $longitude_s = " '" . $longitude. "'";
        $latitude_s = " '" . $latitude. "'"; 
        $merchant_code_s = " '" . $merchant_code. "'";
        $merchant_no_s = " '" . $merchant_no. "'"; 
        $email_s = " '" . $email. "'";  
        $manager_contact_s = " '" . $manager_contact. "'"; 
        $shop_name_s = " '" . $shop_name. "'"; 
        $manager_name_s = " '" . $manager_name. "'"; 
//        $manager_tel_s = " '" . $manager_tel. "'"; 
     
        if($shop_status === 'undefined' || $shop_status === '')
            { 
             $shop_status = null; $shop_status_s = 'null'; 
            }  
        else
        {
            $shop_status_s = $shop_status;
        }
        if($kazaa === 'undefined' || $kazaa == '' ) { $kazaa = null; $kazaa_s = 'null';    }           
        if($governate === 'undefined' || $governate == '') {   $governate = null; $governate_s = 'null'; }
        if($village === 'undefined' || $village == '')  { $village = null; $village_s = "null"; }
        if($landline=== '') { $landline= null;  $landline_s= 'null'; }      
        if($longitude=== '') {$longitude= null;  $longitude_s= 'null'; }      
        if($latitude=== '') {$latitude = null; $latitude_s= 'null'; }
        if($location=== '') {   $location = null;  $location_s = 'null'; }
        if($merchant_no === '') {$merchant_number_edited = null; $merchant_number_edited_s = 'null'; $merchant_code = null; $merchant_code_s = 'null'; $merchant_no= null;  $merchant_no_s= 'null'; }
        if($email === '') {$email = null ; $email_s= 'null'; }
        if($manager_contact=== '') {$manager_contact = null;  $manager_contact_s= 'null'; }
        if($shop_name === '') {$shop_name = null;  $shop_name_s= 'null'; }           
        if($manager_name === '') {$manager_name = null; $manager_name_s= 'null'; }     
//        if($manager_tel === '') { $manager_tel = null; $manager_tel_s= 'null'; }
            
     
        $query="update t
                set t.a02KAZAA = $kazaa_s ,  
                t.a02GOVERNORATE = $governate_s,
                t.a02VILLAGE = $village_s,
                t.a02SHOP_LANDLINE = $landline_s,
                t.a02Location = $location_s, 
                t.a02LONGITUDE = $longitude_s,
                t.a02MARCHANT_NO = $merchant_number_edited_s,  
                t.a02Merchant_number_bank = $merchant_no_s  ,
                t.a02LATITUDE = $latitude_s,  
                t.a02shop_status = $shop_status_s, 
                t.a02Merchant_Code = $merchant_code_s,  
                t.a02SHOP_EMAIL = $email_s,
                t.a02SHOP_MANAGER_CONTACT_NO = $manager_contact_s,
                t.a02SHOP_MANAGER_NAME = $manager_name_s,
                t.a02Name = $shop_name_s
                from t02retailer_shops_testing t 
                where t.a02Code =$id"; 
                     
//        print $query;
//         t.Shop_manager_telephone = $manager_tel_s,
        return $this->query($query); 
    }    
        
        
    function get_retailer_per_country($id) 
    {
        
        $query = "select tt.a00code,tt.a00SHOP_NAME,tt.a00RETAILER_ID, tt.a00SHOP_OWNER_NAME, tt.a00Chain, t.number_of_shops, tt.a17country_name
                    from 
                    (
                    select *
                    from t00retailers_testing r
                    inner join t17countries ct
                    on r.a00COUNTRY_ID = ct.a17Code
                    where r.a00COUNTRY_ID = $id 		
                    )tt 
                    inner join 
                    (
                    select t.a02Retailer, COUNT(1) as number_of_shops 
                    from t02retailer_shops_testing t
                    group by t.a02Retailer
                    )t
                    on tt.a00code = t.a02Retailer";
//             $query = "select tt.a00code,tt.a00RETAILER_ID, tt.a00SHOP_OWNER_NAME, tt.a00Chain, t.number_of_shops 
//                        from  
//                        (
//                        select *
//                        from t00retailers_testing r
//                        inner join t02retailer_shops_testing c
//                        on r.a00code = c.a02Retailer 
//                        where r.a00COUNTRY_ID = $id
//                        )tt
//                        inner join 
//                        (
//                        select t.a02Retailer, COUNT(1) as number_of_shops 
//                        from t02retailer_shops_testing t
//                        group by t.a02Retailer
//                        )t
//                        on tt.a00code = t.a02Retailer"; 
    
//             $query = "select *
//            from  t02retailer_shops_testing c
//            where c.a02Retailer = $id ";
    
    
    
          return $this->query($query);  
    }
        
    function get_shop_countries($id)
    {
        if($id === 1)
        {
        $query = 'select distinct(c.a17country_name), c.a17Code
                    from t00retailers_testing r
                    inner join t17countries c
                    on c.a17Code = r.a00COUNTRY_ID';
                        
        return $this->query($query);  
        }
         else if($id ===2)
        { 
               $query = "Select * from t17countries s";
        return $this->query($query); 
        }
            
    }
    function get_num_duplicates_t03()
    {
        $query = "select count(1) as num_duplicates
                from  
                (
                select b.BARCODE2, count(1) as count1
                from t03barcodes_testing b
                where b.a03Retailer_shop is null
                group by b.BARCODE2 
                having  count(1) > 1
                )tt
                "; 
//            print($query_clean);
            $this->query($query); 
    }
        
    function get_num_barcodes_per_user($id)
    {
        if($id == 1)
        {
            $query = "select b.a03user_id,u.a26firstname, u.a26lastname, count(1) as num_barcodes_per_user
            from t03barcodes b 
            inner join t26users u 
            on u.a26code = b.a03user_id
            where b.a03date_modified is not null
            and u.a26country_id = $_SESSION[country_id]
            group by b.a03user_id,u.a26firstname, u.a26lastname
            order by num_barcodes_per_user desc";
        }
        
        else if($id == 3)
        {
             $query = "select b.a03user_id,u.a26firstname, u.a26lastname, count(1) as num_barcodes_per_user
            from t03barcodes b 
            inner join t26users u 
            on u.a26code = b.a03user_id
            where b.a03date_modified is not null
            group by b.a03user_id,u.a26firstname, u.a26lastname
            order by num_barcodes_per_user desc"; 
        }
        return  $this->query($query);   
    }
    
       function get_num_partially_qualified($id)
    {
        if($id == 1) 
        {
            $query = "select count(1) as num_partially_qualified
                    from t03barcodes b
                    inner join t26users u
                    on u.a26code = b.a03user_id 
                    where b.a03date_modified is not null
                    and
                    (
                            b.a03brand_id is null
                            or b.ITEM_DESCRIPTION_ENGLISH is null
                            or b.a03family_id is null
                    )
                    and u.a26country_id = $_SESSION[country_id]";
              return  $this->query($query);   
        }
        
        else if($id == 3)
        {
            
        }
    }
    
     function get_percentage_qualified($id)
    {
        if($id == 1)
        {
             $query= "select count(1) as percentage_fully_categorised 
                        from t03barcodes b
			inner join t26users u
			on u.a26code = b.a03user_id
                        where b.a03date_modified is not null
                        and b.a03family_id is not null
                        and b.a03brand_id is not null
			and u.a26country_id = $_SESSION[country_id]";  
        }
        
        else if($id == 3) 
        {
             $query = "select cast(
        (
        select (count(1)+ 0.00)
        from t03barcodes b
        where b.a03family_id is not null
        and b.a03brand_id is not null
        and b.ITEM_DESCRIPTION_ENGLISH is not null
        )
        /
        (
        select (count(1)+0.00)
        from t03barcodes b
        )
        *
        100
         as numeric(3,2)) as percentage_fully_categorised "; 
        } 
      
//            print($query_clean);
            $this->query($query);   

    } 
    function get_num_barcodes_today($id)  
    {
        if($id == 3)
        {
            $query = "select count(1) as num_barcodes_categorised
                        from t03barcodes b
                        where CONVERT (date,b.a03date_modified  ) =  CONVERT (date, SYSDATETIME()) "; 
        }
        else if($id == 1)
        {
            
            $query =   "select count(1) as num_barcodes_categorised 
                        from t03barcodes b
                        inner join t26users u
                        on u.a26code = b.a03user_id
                        where CONVERT (date,b.a03date_modified  ) =  CONVERT (date, SYSDATETIME()) 
			and u.a26country_id = $_SESSION[country_id]";   
        }
                   
//            print($query_clean);
            $this->query($query);   

    }
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
            from t03barcodes_testing b
            where b.BARCODE2 = '$barcode'";   
                
         if($clean == 1)
        {
            $query_clean = "Delete l from t23_staging_testing l where l.barcode2 = '$barcode'";
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
            from t23_staging_testing s where s.BARCODE2 = '$barcode'";
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
            from t03barcodes_testing b
            where b.BARCODE2 = '$barcode' and b.a03retailer_shop = $shop";    
                
                
      if($clean == 1)
        {
            $query_clean = "Delete l from t23_staging_testing l where l.barcode2 = '$barcode' and l.a08retailer_shop = $shop ";
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
            from t23_staging_testing s where s.BARCODE2 = '$barcode' and s.a08retailer_shop = $shop";
                
//           print $query_update;
    
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
//                . " from t23_staging_testing s "
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
        
    function create_user($user, $pass, $fname, $lname, $type, $country_id) {
        
//        $p1 = sha1($pass);   
//        echo'<br>';
//                echo 'passsha' . $p;
//                echo'<br>';
        $query = "Insert into t26users (a26username, a26password, a26firstname,a26lastname, a26user_type, a26country_id) values ('$user', HASHBYTES('SHA1' , '$pass'),'$fname', '$lname', $type, $country_id )";
//        print $query;    
        return $this->query($query); 
    }
        
    function add_family($family) {
        $query = "insert into t16family (a16family) values ($family)";
        return $this->query($query);
    }
        
    function update_user_decision($barcode, $dec)
    {
         $query = "update t set t.user_decision = $dec from t23_staging_testing t where t.BARCODE2 = '$barcode'";  
             
        return $this->query($query); 
    } 
        
//    function check_user_decision($barcode)
//    {
//          $query = " ";  
//          
//        return $this->query($query); 
//    }
    
    
    function show_barcodes() {
        $query = "
select top 50 st.BARCODE2, max(st.ITEM_DESCRIPTION) as ITEM_DESCRIPTION, max(st.date_modified) as date_modified
                from t23_staging_testing st
                where st.assigned_user_id = $_SESSION[user_id]
                group by st.BARCODE2, st.priority_rank 
		order by st.priority_rank, st.barcode2";    
                    
//        $query = "select * from t23_staging_testing st
//                    where BARCODE2 in
//                            (
//                            select  st.barcode2 
//                            from t23_staging_testing st
//                            group by st.barcode2
//                            having count(1) > 1
//                            )
//                            and st.assigned_user_id = $_SESSION[user_id]"
//                . "and st.date_modified is null ";
        return $this->query($query);
    } 
        
    function get_count($barcode) {
        $query = "select count(1) as count1 from t23_staging_testing st where st.BARCODE2 = '$barcode'";
        return $this->query($query);
    }
        
    function get_barcode_info($barcode, $shop_id)
    {
        if($shop_id == 0)
        {
            
             $query = "Select top 1 * from t23_staging_testing bv left join v_categories v on v.FAMILY_ID = bv.family_id left join t11brands_testing b on b.a11code = bv.brand_id
where bv.Barcode2 ='$barcode' and bv.a08retailer_shop is null
";
        }
        else 
        {
             $query = "Select top 1 * from t23_staging_testing bv left join v_categories v on v.FAMILY_ID = bv.family_id left join t11brands_testing b on b.a11code = bv.brand_id where bv.Barcode2 ='$barcode' and bv.a08retailer_shop = $shop_id"; 
        }
            
            
//        print $query; 
        return $this->query($query);
    } 
        
    function barcode_detail($bc) {
        $query = "Select * from t23_staging_testing bv where bv.Barcode2 ='$bc'";
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
                from t03barcodes_testing b
                where b.BARCODE2 ='$b';"
                . "Delete l "
                . " from t23_staging_testing l" 
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
                from t03barcodes_testing b
                where b.BARCODE2 ='$b' and b.a03Retailer_shop = $shop_id;"
                . "Delete l "
                . " from t23_staging_testing l"
                . " where l.barcode2 = '$b' and l.a08retailer_shop = $shop_id"; 
        }
            
//        $query = "update s"
//                . " set s.status=0,"
//                . " s.item_type = 'Non food Item',"
//                . " s.user_id = $user_id,"
//                . "s.date_modified = getdate()"
//                . " from t23_staging_testing s"
//                . " where s.barcode2 = '$b'";
//         print $query; 
        return $this->query($query);
    }
        
    function get_manufacturer_by_id($id) {
        $query = "Select * from t12manufacturer_testing where a12code = $id";
        return $this->query($query);
    }
        
    function add_brand($brand, $man_id) {
        $brand = strtoupper($brand);  
        $query = "insert into t11brands_testing (a11brand ,a11manufacturer_id) OUTPUT INSERTED.a11code values ('$brand',$man_id)";
        return $this->query($query);
    }
        
    function get_brand_by_id($id) {
        $query = "Select * from t11brands_testing where a11code = $id";
        return $this->query($query);
    } 
        
    function add_manufacturer($manufacturer) {
        $manufacturer = strtoupper($manufacturer);  
        $query = "insert into t12manufacturer_testing (manufacturer) OUTPUT INSERTED.a12code values ('$manufacturer')";
        return $this->query($query);
    }
        
    function get_last_insert() {
        $query1 = "Select scope_identity() as 'identity'";
        return $this->query($query1);
    }
        
    function get_manufacturer() {
        $query = "Select * from t12manufacturer_testing order by manufacturer asc ";
        return $this->query($query);
    }
        
    function get_quality()
    {
        $query = "Select * from t28quality"; 
        return $this->query($query);
    }
    function get_brand() {
        $query = "Select * from t11brands_testing order by a11brand asc ";
        return $this->query($query);
    }
        
    function get_users() {
        $query = "Select * from t26users_ "; 
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