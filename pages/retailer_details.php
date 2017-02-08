<!DOCTYPE html>
<html lang="en">
    
 <?php
    include_once './sidebar.php';
    include_once './header.php';


    $obj = new functions();
    $obj->get_retailer_per_id($_REQUEST['cmd']);
    $row = $obj->fetch();        
    ?>
    
    <body>
        
        <div id="wrapper">
            
            <!-- Navigation -->
            
            
            <!-- Page Content --> 
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php print $row['a00RETAILER_ID']?></h1>
                        </div> 
                    </div>
                    <h3>Retailer information</h3> 
                    <div class="row">
                        <div class="col-lg-4">
                            
                            
                            <div class="form-group">
                                <h5>Shop Owner Name:</h5>
                                <input class="form-control" id="shop_owner_name" type="text" value="<?php  print $row['a00SHOP_OWNER_NAME']?>" disabled>
                            </div>
                            <br> 
                            <div class="form-group"> 
                                <h5>Shop Name:</h5>
                                <input class="form-control" id="shop_name" type="text" value="<?php  print $row['a00SHOP_NAME']?>" disabled>
                            </div>
                            <br>
                             <div class="form-group"> 
                                <h5>Retailer ID:</h5>
                                <input class="form-control" id="retailer_id" type="text" value="<?php  print $row['a00RETAILER_ID']?>" disabled>
                            </div> 
                           
                        </div>
                        <div class="col-lg-2">
                        </div> 
                        
                        <div class="col-lg-4">
                            
                          <div class="form-group"> 
                                <h5>Owner Contact:</h5> 
                                <input class="form-control" id="owner_contact" type="text" value="<?php  print $row['a00SHOP_OWNER_CONTACT_NO']?>" disabled>
                            </div>
                            
                            <br>
                            <div class="form-group"> 
                                <h5>Owner Nationality:</h5>
                                <input class="form-control" id="owner_nationality" type="text" value="<?php  print $row['Shop_owner_nationality']?>" disabled>
                            </div>  
                            
                            
                            <a href="#"  id="update_retailer" onclick="update_retailer()">+ Edit retailer details</a> 
                            <a href="#" style="display: none" id= "save_retailer_changes" onclick="save_retailer_changes(<?php print $_REQUEST['cmd'] ?>)">Save changes made</a> 
                             <br>  
                              <br> 
                            <a data-toggle="modal" href="#" data-target="#myModal">+ Add new Shop</a> 
                        </div>
                        
                        
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-lg">
                                
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Modal Header</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Some text in the modal.</p> 
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
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
                                            
                                            
<!--                                            <div class="col-lg-2">
                                                
                                            </div>-->
                                            
                                            <div class="col-lg-6">
                                                
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
                                                
                                                <button href="#add_new_shop_form" data-toggle="collapse" aria-expanded="false" aria-controls="add_new_shop_form"  id="save_retailer" onclick="add_new_retailer(<?php print $_REQUEST['cmd'] ?>)"type="button" class="btn btn-primary">Save</button>
                                                
                                                
                                            </div>  
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div> 
                        <br>
                        <br>
                        <!--                        <div class="row">
                                                    <div class="col-lg-12">
                                                       
                                                        
                                                    </div>
                                                </div>   -->
                        <div class="row">  
                            <div class="col-lg-12"> 
                                <br>
                                <h4>Shop Information :</h4>
                                <div class="panel-group" id="accordion">
                                    <?php
                                    $obj = new functions();
                                    $obj->get_shops_per_retailer_id($_REQUEST['cmd'], 0);
                                    $row = $obj->fetch();
                                    $i = 1;
                                    while($row)
                                    {
                                        echo "<div class='panel panel-default'>
                                        <div class='panel-heading'>
                                            <h4 class='panel-title'>
                                                <a onclick='toggle_fields($row[a02Code],true)' data-toggle='collapse' data-parent='#accordion' href='#collapse$i'>
                                                   $row[a02Name]</a> 
                                            </h4>
                                        </div> 
                                        <div id='collapse$i' class='panel-collapse collapse'>
                                            <div class='panel-body'>";
                                        include_form($row['a02Code']);   
                                                echo"</div> 
                                        </div>
                                    </div>";
                                        $i++;
                                         $row = $obj->fetch();
                                    }
                                    ?>
                                    
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
            
            <!--            <br>
                <div class='form-group'> 
                    <h5>Shop Manager Tel.:</h5>
                    <input class='form-control' id='manager_tel$id' type='text' value='$row[Shop_manager_telephone]' disabled>
                </div>
                 
                <br>--> 
            <?php
            function include_form($id) 
            {
                $obj = new functions();
                $obj ->get_shops_per_retailer_id(0, $id);  
                $row = $obj->fetch();
//print_r($row);
                print"<div class='row'>
<div class='col-lg-4'>
    
 <div class='form-group'> 
        <h5>Shop  Status:</h5>
        <input class='form-control' id='shop_status$id' type='text' value='$row[a30status]' disabled>
    </div>  

<div class='form-group'>  
     
    <select style='display:none' id='shop_status_select$id' class='form-control' data-live-search='true'></select>
   </div>  
   <br> 
       
    <div class='form-group'>
        <h5>Shop  Name:</h5>
        <input class='form-control' id='shop_name$id' type='text' value=' $row[a02Name]' disabled>
    </div>
    <br> 
    <div class='form-group'> 
        <h5>Shop Manager Name:</h5>
        <input class='form-control' id='manager_name$id' type='text' value=' $row[a02SHOP_MANAGER_NAME]' disabled>
    </div>
    <br>
    <div class='form-group'>  
        <h5>Shop Manager Contact:</h5>
        <input class='form-control' id='manager_contact$id' type='text' value='$row[a02SHOP_MANAGER_CONTACT_NO]' disabled>
    </div>
        
    <br>
    <div class='form-group'> 
        <h5>Shop Landline:</h5>
        <input class='form-control' id='landline$id' type='text' value='$row[a02SHOP_LANDLINE]' disabled>
    </div>
        
    <br>
    <div class='form-group'> 
        <h5>Shop Email:</h5>
        <input class='form-control' id='email$id' type='text' value='$row[a02SHOP_EMAIL]' disabled>
    </div>
        
        
        
        
</div>
<div class='col-lg-2'>
    
</div>
    
<div class='col-lg-4'>
    
     <div class='form-group'>
        <h5>Merchant Number:</h5>  
        <input class='form-control' id='merchant_number$id' type='text' value='$row[a02Merchant_number_bank]' disabled>
    </div>
    <br> 
        
    <div class='form-group'> 
        <h5>Shop Location.:</h5>
        <input class='form-control' id='location$id' type='text' value='$row[a02Location]' disabled>
    </div>
        
     <br> 
    <div class='form-group'>
        <h5>Governorate:</h5>
        <input class='form-control' id='governorate$id' type='text' value='$row[a02GOVERNORATE]' disabled>
    </div>
        
 <div class='form-group'> 
    <select style='display:none' id='governorate_select$id' class='form-control' data-live-search='true'></select>
   </div>    
       
<br>
    <div class='form-group'> 
        <h5>Kazaa:</h5>
  <input class='form-control' id='kazaa$id' type='text' value='$row[a02KAZAA]' disabled>
    </div>
    <div class='form-group'> 
    <select style='display:none' id='kazaa_select$id' class='form-control' data-live-search='true'></select>
   </div>    
       
    <br> 
    <div class='form-group'> 
        <h5>Village:</h5>
        <input class='form-control' id='village$id' type='text' value='$row[a02VILLAGE]' disabled>
    </div>  
    <div class='form-group'> 
    <select style='display:none' id='village_select$id' class='form-control' data-live-search='true'></select>
   </div>   
       
    <br>
    <div class='form-group'> 
        <h5>Longitude:</h5>
        <input class='form-control' id='longitude$id' type='text' value='$row[a02LONGITUDE]' disabled>
    </div>
        
    <br>
    <div class='form-group'> 
        <h5>Latitude:</h5>
        <input class='form-control' id='latitude$id' type='text' value='$row[a02LATITUDE]' disabled>
    </div> 
    <br>
        
    <button id='edit_button' onclick='edit_shop_details($id)'type='button' class='btn btn-primary'>Edit</button>
    <button id='save_button' onclick='save_shop_details($id)'style='display:none' type='button' class='btn btn-secondary'>Save</button> 
        
</div> 
    </div>";
                
                
//                <button type="button" class="btn btn-primary">Primary</button>
                
               
            } 
            ?>
            <!-- jQuery -->
            <script src="../vendor/jquery/jquery.min.js"></script>
            
            <!-- Bootstrap Core JavaScript -->
            <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
            
            <!--<s!-- Metis Menu Plugin JavaScript -->-->
            <script src="../vendor/metisMenu/metisMenu.min.js"></script>
            
            <!-- Custom Theme JavaScript -->
            <script src="../dist/js/sb-admin-2.js"></script>
            
            <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
            <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
            <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.3/js/bootstrap-select.min.js"></script>
            <script>  
                $(document).ready(function () { 
               
                
                    $('.selectpicker').selectpicker();
                
                
                }); 
            
             
            </script> 
    <!--            <script>
                     
    function shop_details(id)
    {
        alert("this is the id");
    }
                    </script>
            -->
    </body>
    
</html>
