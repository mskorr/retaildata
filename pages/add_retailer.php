<!DOCTYPE html>
<html lang="en">
    
<?php
include_once './header.php';
include_once './sidebar.php'; 

?>
    
    <body>
        
        <div id="wrapper">
            
            <!-- Navigation -->
            
            
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Add Retailer / Shop</h1>
                            <!--style="display: none"-->
                            <label  id="insert_retailer"></label> 
                        </div>
                        <!-- /.col-lg-12 -->
                    </div> 
                    <h3>Retailer information</h3>
                    <div class="row">
                        <div class="col-lg-4">
                            
                            
                            <div class="form-group">
                                <h5>Shop Owner Name:</h5>
                                <input class="form-control" id="add_shop_owner_name" type="text" placeholder="" >
                            </div>
                            <br> 
                            <div class="form-group"> 
                                <h5>Shop Name:</h5>
                                <input class="form-control" id="add_shop_name" type="text" placeholder="" >
                            </div>
                            <br>
                            <div class="form-group"> 
                                <h5>Owner Contact:</h5> 
                                <input class="form-control" id="add_owner_contact" type="text" placeholder="" >
                            </div>
                            
                            <br>
                            <div class="form-group"> 
                                <h5>Owner Nationality:</h5>
                                <input class="form-control" id="add_owner_nationality" type="text" placeholder="" >
                            </div>
                            
                            
                            
                        </div>
                        <div class="col-lg-2">
                        </div>
                        <div class="col-lg-4">
                            
                            
                            
                            <div class="form-group"> 
                                <h5>Chain:</h5>
                                <select   id="add_chain" class="form-control">
                                 <option value='N'>No</option>
                                 <option value='Y'>Yes</option>  
                                     
                                </select>
                            </div>
                            <br> 
                            <div class="form-group">
                              
                                <h5>Country:</h5>
                                <select   id="add_country" class="form-control selectpicker" data-live-search="true">
                                    
                                     <?php
                                       $obj = new functions();
                                       $obj->get_shop_countries(2);
                                       $row = $obj->fetch(); 

                                       while ($row) 
                                           {
                                       echo "<option value='$row[a17Code]'>$row[a17country_name]</option>"; 
                                       $row = $obj->fetch(); 
                                         }
                                    ?> 
                                </select>
                            </div>
                            <br> 
                            
                            <div class="form-group"> 
                                <h5>Retailer ID:</h5>
                                <input class="form-control" id="add_retailer_id" type="text" placeholder="" >
                            </div>
                            
                            <br>
                            <!--                            <div class="form-group"> 
                                                            <h5>POS system:</h5>
                                                            <input class="form-control" id="add_retailer_pos" type="text" placeholder="" >
                                                        </div> -->
                            
                        </div>
                    </div>
                    
                    <div class='row'>
                        <div class='col-lg-12'>
  <a  data-toggle="collapse" data-target="#add_new_shop_form">+ Add a new shop for this retailer</a>
  <div id="add_new_shop_form" class="collapse">
  <br>
   <div class="row">
<div class="col-lg-4">
       <h5>Shop Status:</h5>
 <div class="form-group"> 
     
     <select id="add_shop_status" class="form-control" data-live-search="true">
          <?php
            $obj= new functions(); 
            $obj->get_kazaa_village_governorate(4);
            $row = $obj->fetch();
            while($row)
            {
              echo "<option value ='$row[code]'>$row[name] </option>";  
               $row = $obj->fetch();
            }
            ?>
     </select>
   </div>
       
        <br> 
       
    <div class="form-group">
        <h5>Shop  Name:</h5>
        <input class="form-control" id="add_shop" type="text" value="" >
    </div>
    <br> 
    <div class="form-group"> 
        <h5>Shop Manager Name:</h5>
        <input class="form-control" id="add_manager_name" type="text" value="" >
    </div>
    
    <br>
    <div class="form-group">  
        <h5>Shop Manager Contact:</h5>
        <input class="form-control" id="add_manager_contact" type="text" value="" >
    </div>
        
    <br>
    <div class="form-group"> 
        <h5>Shop Landline:</h5>
        <input class="form-control" id="add_landline" type="text" value="" >
    </div>
        
    <br>
    <div class="form-group"> 
        <h5>Shop Email:</h5>
        <input class="form-control" id="add_email" type="text" value="" >
    </div>
    
     <br>
    <div class="form-group"> 
      <h5>POS Company:</h5>
      <select  id="add_pos" class="form-control selectpicker" data-live-search="true">
          <?php
            $obj= new functions();
            $obj->get_kazaa_village_governorate(3);
            $row = $obj->fetch();
            while($row)
            {
              echo "<option value ='$row[code]'>$row[name] </option>";  
               $row = $obj->fetch();
            }
            ?>
      </select>
   </div> 
       </div>
       
      
<div class="col-lg-2">
    
</div>
    
<div class="col-lg-4">
    
     <div class="form-group">
        <h5>Merchant Number:</h5>  
        <input class="form-control" id="add_merchant_number" type="text" value="" >
    </div>
    <br> 
        
    <div class="form-group"> 
        <h5>Shop Location.:</h5>
        <input class="form-control" id="add_location" type="text" value="" >
    </div>
        
     <br> 
        
 <div class="form-group"> 
      <h5>Governorate:</h5>
      <select  id="add_governorate" class="form-control selectpicker" data-live-search="true">
          <?php
            $obj= new functions();
            $obj->get_kazaa_village_governorate(3);
            $row = $obj->fetch();
            while($row)
            {
              echo "<option value ='$row[code]'>$row[name] </option>";  
               $row = $obj->fetch();
            }
            ?>
      </select>
   </div>    
       
<br>
   
    <div class="form-group"> 
        
        <h5>Kazaa:</h5> 
        <select id="add_kazaa" class="form-control selectpicker" data-live-search="true">
            <?php
            $obj= new functions();
            $obj->get_kazaa_village_governorate(1);
            $row = $obj->fetch();
            while($row)
            {
              echo "<option value ='$row[code]'>$row[name] </option>";  
               $row = $obj->fetch(); 
            }
            ?>
        </select>
   </div>    
       
    <br> 
    
    <div class="form-group"> 
        <h5>Village:</h5>
        <select id="add_village" class="form-control selectpicker" data-live-search="true">
             <?php
            $obj= new functions();
            $obj->get_kazaa_village_governorate(2);
            $row = $obj->fetch();
            while($row)
            {
              echo "<option value ='$row[code]'>$row[name] </option>";  
               $row = $obj->fetch(); 
            } 
            ?> 
        </select>
   </div>   
       
    <br>
    <div class="form-group"> 
        <h5>Longitude:</h5>
        <input class="form-control" id="add_longitude" type="text" value="" >
    </div>
        
    <br> 
    <div class="form-group"> 
        <h5>Latitude:</h5>
        <input class="form-control" id="add_latitude" type="text" value="" >
    </div> 
    <br>
        
    <button href="#add_new_shop_form" data-toggle="collapse" aria-expanded="false" aria-controls="add_new_shop_form"  id="save_retailer" onclick="add_new_retailer(0)"type="button" class="btn btn-primary">Save</button>
   
        
</div>  
    </div>
  </div>
                        </div>
                    </div>
                    
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
            
        </div>
        <!-- /#wrapper -->
        <?php
//        function set_retailer_id($id)
//        {
//            $_SESSION['retailer'] = '';
//        }
//        ?>
        <!-- jQuery -->
        <script src="../vendor/jquery/jquery.min.js"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Metis Menu Plugin JavaScript -->
        <script src="../vendor/metisMenu/metisMenu.min.js"></script>
        
        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.3/js/bootstrap-select.min.js"></script>
        <script>  
            $(document).ready(function () { 
               
                 
                $('.selectpicker').selectpicker();
                
//                 $('#brand_add').prop('disabled', true); 
//                 $('#brand_other').prop('disabled', true);
//                    $('#brand_other').val(''); 
            }); 
            
             
        </script>
    </body>
    
</html>
