<!DOCTYPE html>
<html lang="en">
    
    <?php 
    include_once './sidebar.php';
    include_once './header.php';
  
//    echo"onload='showMessage()'";
         $obj_decision = new functions();
    $obj_decision->barcode_detail($_REQUEST['b']);
    $row_decision = $obj_decision->fetch(); 
    
    $obj=new functions();
    $obj->get_count($_REQUEST['b']);
    $row = $obj->fetch();
    
    if($row['count1'] == 1)
    {
        if($row_decision['user_decision'] == 2)
        {
             echo "<BODY onLoad='no(1,0,\"$row_decision[a00retailer_name]\", \"$row_decision[a02shop_name]\", \"none\")'>";  
        }
        else 
        {
         echo "<BODY onLoad='showModal(\"$_REQUEST[b]\", 0,\"$row_decision[a00retailer_name]\", \"$row_decision[a02shop_name]\")'>";
        } 
       
    } 
     
   
    if($row_decision['user_decision'] == 2)
    { 
        echo "<BODY onLoad='no(1,0,\"$row_decision[a00retailer_name]\", \"$row_decision[a02shop_name]\", \"none\")'>";   
    }  
    else  if($row_decision['user_decision'] == 1) 
    { 
        echo "<BODY onLoad='showModal(\"$_REQUEST[b]\", 0,\"$row_decision[a00retailer_name]\", \"$row_decision[a02shop_name]\")'>";   
    } 
     
    ?> 
<!--    <script type="text/javascript">
       
    </script>-->
     
    <body>
        <div id="wrapper">
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Barcode Verification</h1>
                    </div>
                    <!--/.col-lg-12--> 
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!--                        <div class="panel-heading">
                                                        DataTables Advanced Tables
                                                    </div>-->
                            <!-- /.panel-heading -->
                            <div class="panel-body">  
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    
                                    <thead>
                                        <tr>
                                            
                                                                                        <!--<th>Shop_ID</th>-->
                                            <th>Barcode</th>
                                            <th>Item Description</th>
                                            <th></th>
                                        </tr>  
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_REQUEST['b'])) {
                                            $b = $_REQUEST['b'];
                                            $obj = new functions();
                                            $obj->barcode_detail($b);
                                            $row = $obj->fetch();

                                            while ($row) {
                                          if($row["date_modified"] !== null)  
                                          {
                                              echo"<tr style='color:green' class='odd gradeX'>          
                                        <td id='barcode'>$row[BARCODE2]</td>
                                        <td id='item_description'class='center'>$row[ITEM_DESCRIPTION]</td>";
                                      
                                        echo"<td style='display:none; color:green' onclick ='no(1,$row[a08retailer_shop],\"$row[a00retailer_name]\" , \"$row[a02shop_name]\" ,\"$row[ITEM_DESCRIPTION]\")' class='center edit'>Edit</td>"; 
                                       echo" </tr> "; 
                                          }
                                          else
                                          { 
                                              echo"<tr  class='odd gradeX'>          
                                        <td id='barcode'>$row[BARCODE2]</td>
                                        <td id='item_description'class='center'>$row[ITEM_DESCRIPTION]</td>";
                                     
                                        echo"<td style='display:none; color:red' onclick ='no(1,$row[a08retailer_shop],\"$row[a00retailer_name]\" , \"$row[a02shop_name]\" ,\"$row[ITEM_DESCRIPTION]\")' class='center edit'>Edit</td>"; 
                                       echo" </tr> "; 
                                          }
                                       
                                                $row = $obj->fetch();   
                                            } 
                                        }  
                                        ?> 
                                        
                                        <!-- <td id='shop_id'>$row[a08retailer_shop]</td>-->
                                    </tbody> 
                                    
                                </table> 
                                
                                <!--data-target="#myModal"--> 
                                
                                <!-- /.table-responsive -->
                                <p class="help-block">Please indicate if all the barcodes correspond to the same product or not</p>
                                <button id="yes" type="button"class="btn btn-primary" data-toggle="modal"  onclick="showModal(<?php print $_REQUEST['b'] ?>, 0)">Yes</button>
                                <button id="no" onclick="no(1,0, '', '', '')" type="button" class="btn btn-primary" >No</button>
                                
                                <!--modal-->
                                <!--         save chan                  Button trigger modal 
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                  Launch demo modal
                                </button>-->
                                
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" onclick="refresh()" data-dismiss="modal" aria-label="Close">
                                                    <span tabindex="25"aria-hidden="true">&times;</span>
                                                </button> 
                                              
                                                <h4 class="modal-title"> Barcode Details :  </h4> <h4 id="myModalLabel" ><?php print $_REQUEST['b'] ?></h4>
                                                <h4 style="display: none"class="modal-title" id="myModalShop"></h4>
                                                <h4 class="modal-title" id="myModalShopName"></h4>
                                                <h4 class="modal-title" id="myModalRetailerName"></h4>
                                            </div>
                                            <div id ="modal_body" class="modal-body"> 
                                                <!--form-->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="panel panel-default">                 
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <form data-toggle="validator" role="form" >
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <H5>Item type</H5> 
                                                                                        <select tabindex="9" onchange="change_select_item_type(this.value)" id="item_type" class="form-control" data-live-search="true">
                                                                                            <option value='0'>Food item </option>
                                                                                            <option value='1'>Non Food Item</option> 
                                                                                            
                                                                                        </select>  
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-lg-6">
                                                                                    <div class="form-group">
                                                                                        <H5>Is this item on offer?</H5> 
                                                                                        <label class="radio-inline"><input onclick="offerValue(1)" type="radio" id="radio_yes" name="optradio">Yes</label>
                                                                                        <label class="radio-inline"><input onclick="offerValue(2)" type="radio" id="radio_no" name="optradio">No</label> 
<!--                                                                                        <label class="checkbox-inline"><input onclick="offerValue(1)" type="checkbox" id="radio_yes" name="optradio">Yes</label>
                                                                                        <label class="checkbox-inline"><input onclick="offerValue(2)" type="checkbox" id="radio_no" name="optradio">No</label> -->
                                                                                        <input style="display: none" id="offer_value" class="form-control"> 
                                                                                    </div> 
                                                                                    
                                                                               </div>  
                                                                            </div>
                                                                            
                                                                            <br>
                                                                            <div class="col-lg-6">
                                                                                
                                                                                <h4>Old descriptions</h4>
                                                                                <div class="panel panel-default" >
                                                                                    <div class="panel-body pre-scrollable" style="max-height: 109px ; height: 109px">
                                                                                        <ol id="old_description">
                                                                                            <?php
                                                                                            if (isset($_REQUEST['b'])) {
                                                                                                $b = $_REQUEST['b'];
                                                                                                $obj = new functions();
                                                                                                $obj->barcode_detail($b);
                                                                                                $row = $obj->fetch();

                                                                                                while ($row) {
                                                                                                    echo "<li>$row[ITEM_DESCRIPTION]</li>";


                                                                                                    $row = $obj->fetch();
                                                                                                }
                                                                                            }
                                                                                            ?>              
                                                                                        </ol>                                                                                
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                
                                                                                <div class="form-group">
                                                                                    <label style="display: none" id="family_id"></label>
                                                                                    <H4>Family</H4>
                                                                                    <select tabindex="2"    onchange="change_select_family(this.value)" id="family" class="form-control selectpicker" data-live-search="true">
                                                                                        <option value='0'>No family selected</option>
                                                                                        <?php
                                                                                        $obj = new functions();
                                                                                        $obj->get_family();
                                                                                        $row = $obj->fetch(); 

                                                                                        while ($row) {
                                                                                            echo " <option value='$row[FAMILY_ID]'>$row[FAMILY]</option>"; 
                                                                                            $row = $obj->fetch(); 
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div><!--

                                                                                -->
                                                                                <br>
                                                                                
                                                                                 <div class="form-group">
                                                                                    <H4>Brand</H4>
                                                                                    <select tabindex="3" onchange="change_select_brand(this.value)" id="brand" class="form-control selectpicker" data-live-search="true"> 
                                                                                        <option value='0'>No brand selected</option>
                                                                                        <?php
                                                                                        $obj = new functions();
                                                                                        $obj->get_brand();
                                                                                        $row = $obj->fetch();

                                                                                        while ($row) {
                                                                                            echo " <option value='$row[a11code]'>$row[a11brand]</option>";
                                                                                            $row = $obj->fetch();
                                                                                        }
                                                                                        ?>   
                                                                                    </select>
                                                                                </div>
                                                                                <a  id="brand_link" tabindex="23" onclick="hideButton()" href="#collapseExample" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample"> + Add new brand</a>
                                                                                <br>
                                                                                  <br>
                                                                                
                                                                                
                                                                                <div class="form-group">
                                                                                    <H4>Units</H4>
                                                                                    <div class="col-lg-3">
                                                                                        <div class="form-group"> 
                                                                                            
                                                                                            <input tabindex="4" id='unit_value' class="form-control">
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-9">
                                                                                        <select tabindex="5" id="unit" class="form-control" data-live-search="true">
                                                                                            <option value='0'>Cannot be weighted</option>
                                                                                            <?php
                                                                                            $obj = new functions();
                                                                                            $obj->get_units();
                                                                                            $row = $obj->fetch();

                                                                                            while ($row) {
                                                                                                echo " <option value='$row[a25code]'>$row[a25unit]</option>";
                                                                                                $row = $obj->fetch();
                                                                                            }
                                                                                            ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <br>
                                                                                  <br>
                                                                                
                                                                                <div class="form-group">
                                                                                    <H4>Status</H4>
                                                                                    <div class="radio">
                                                                                        <label>
                                                                                            <input  tabindex="8" type="radio" name="optionsRadios" id="radio_ok" value="1" checked>OK
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="radio">
                                                                                        <label>
                                                                                            <input tabindex="11" type="radio" name="optionsRadios" id="radio_not_clear" value="2">Not clear
                                                                                        </label>
                                                                                    </div>   
                                                                                </div>
                                                                                
                                                                                <br>
                                                                          
                                                                            </div>
                                                                            <!--/.col-lg-6 (nested)--> 
                                                                            
                                                                            <div class="col-lg-6">
                                                                                <div class="form-group">
                                                                                    <H4>Item Description(English)</H4>
                                                                                    <textarea tabindex="1" id="description" class="form-control" rows="5"></textarea>
                                                                                </div>
                                                                                <br>
                                                                                
                                                                                <div>
                                                                                    <pre id="family_hierarchy" style="display: none"></pre> 
                                                                                </div>
                                               
                                                                                <!--<div class="form-group">-->
                                                                                <!--                                                                                                                                                                    <H5>Other</H5>
                                                                                                                                                                                                        <input id='brand_other' class="form-control">-->
                                                                                                                                                                                                        <!--<p  class="help-block">Add a new brand if not available in list</p>-->
                                                                                <!--</div>--> 
                                                                               
                                                                               
                                                                               
                                                                                <div class="form-group">
                                                                                    <H4>Quality</H4>
                                                                                    <select tabindex="6" id="quality" class="form-control" data-live-search="true">
                                                                                        <option value='0'>No quality type selected</option>
                                                                                        <?php
                                                                                        $obj = new functions();
                                                                                        $obj->get_quality();
                                                                                        $row = $obj->fetch();

                                                                                        while ($row) {
                                                                                            echo " <option value='$row[a28code]'>$row[a28quality]</option>";
                                                                                            $row = $obj->fetch();
                                                                                        }
                                                                                        ?>   
                                                                                    </select>
                                                                                </div>  
                                                                                <br>
                                                                                <div class="form-group has-feedback">
                                                                                    <H4>Packaging</H4>
                                                                                    <input tabindex="7" pattern="^[0-9]*(\.[0-9]{1,2})?$" id="packaging" class="form-control">
                                                                                    <p  class="help-block">format: ####.## eg: 1.00</p>
                                                                                </div>
                                                                                <br> 
                                                                                
                                                                                
                                                                                
                                                                                <div class="form-group">
                                                                                    <H4>Comments</H4>
                                                                                    <textarea tabindex="11" id="comment" class="form-control" rows="3"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            
                                                                            <!--                                                                            <button type="submit" class="btn btn-default">Submit Button</button>
                                                                                                                                                        <button type="reset" class="btn btn-default">Reset Button</button>-->
                                                                        </form>  
                                                                        <!--/.col-lg-6 (nested)--> 
                                                                        <!--                                                                        <div class="col-lg-4">
                                                                                                                                                                    
                                                                                                                                                                 
                                                                                                                                                        
                                                                                                                                                        </div>-->
                                                                    </div>
                                                                    <!-- /.row (nested) -->
                                                                </div> 
                                                                <!-- /.panel-body -->
                                                                
                                                                
                                                            </div>
                                                            <!-- /.panel -->
                                                        </div>
                                                        <!-- /.col-lg-12 --> 
                                                    </div>
                                                </div>
                                                
                                                <div class="panel panel-default collapse" id="collapseExample">
                                                    <div class="panel-body"> 
                                                        <div >
                                                            <div class="card card-block">
                                                                <div class="row"> 
                                                                    
                                                                    <div class="col-lg-6">
                                                                        <form role="form"> 
                                                                            <div class="form-group">
                                                                                <H5>Manufacturer</H5>
                                                                                <select  id="manufacturer" onchange="change_select_m(this.value)" class="form-control" data-live-search="true">
                                                                                    <option value='0'>No manufacturer  selected</option>
                                                                                    <?php
                                                                                    $obj = new functions();
                                                                                    $obj->get_manufacturer();
                                                                                    $row = $obj->fetch(); 
 
                                                                                    while ($row) {
                                                                                        echo " <option value='$row[a12Code]'>$row[manufacturer]</option>";
                                                                                        $row = $obj->fetch();
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <br>
                                                                                <a onclick="change_select_manufacturer()"> + Add new manufacturer</a> 
                                                                            </div> 
                                                                            <div class="form-group">
                                                                                <H5>Brand</H5> 
                                                                                <input id='brand_other' class="form-control">
                                                                                <!--<p class="help-block">Add a new brand if not available in list</p>-->
                                                                            </div>
                                                                             <button href="#collapseExample" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" type="button" id="brand_add" onclick="add_brand()" class="btn btn-primary">Add</button> 
                                                                             
                                                                        </form>   
                                                                    </div>  
                                                                    <div class="col-lg-6">
                                                                        <form role="form" class="collapse" id="add_manufacturer">
                                                                            <div class="form-group">                             
                                                                                 <H5>Add Manufacturer</H5>
                                                                                <input  class="form-control" id="manufacturer_other"> 
                                                                                <!--<p class="help-block">Add a new brand if not available in list</p>-->
                                                                            </div>
                                                                            <button type="button" onclick="add_manufacturer()" class="btn btn-primary">Add</button> 
                                                                            
                                                                            
                                                                            <!--                                                                            <div  class="collapse">
                                                                                                                                                            This div (Foo) is hidden by default
                                                                                                                                                        </div> -->
                                                                        </form> 
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <div class="modal-footer">
                                                    <!--<button onclick="refresh()"class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                                                    <a tabindex="10" onclick="saveDetail('<?php echo $_REQUEST['b'] ?>')">  <button type="button" class="btn btn-primary" id="save_changes" data-dismiss="modal">Save changes</button></a>
                                                </div> 
                                                
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!--                            <div class="well">
                                                <h4>DataTables Usage Information</h4>
                                                <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                                                <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                                            </div>-->
                                </div>
                                <!--end modal-->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                <!-- /.row -->
                
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->
        </div>  
        
        <!-- /#wrapper -->
        
        <!-- jQuery -->
        <script src="../vendor/jquery/jquery.min.js"></script>
        
        <!-- Bootstrap Core JavaScript -->
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Metis Menu Plugin JavaScript -->
        <script src="../vendor/metisMenu/metisMenu.min.js"></script>
        
        <!-- DataTables JavaScript -->
        <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.3/js/bootstrap-select.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>
        
        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>  
            $(document).ready(function () { 
                $('#dataTables-example').DataTable({
                    responsive: true
                });
                
                $('.selectpicker').selectpicker();
                
                 $('#brand_add').prop('disabled', true); 
                 $('#brand_other').prop('disabled', true);
                    $('#brand_other').val(''); 
            }); 
            
             
        </script>
        
    </body> 
    
</html>
