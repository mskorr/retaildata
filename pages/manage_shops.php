<!DOCTYPE html>
<html lang="en">

<?php 
    include_once './sidebar.php';
    include_once './header.php';
  
    ?> 
 
<body>

    <div id="wrapper">
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2">
                        <h1 class="page-header">Retailers</h1>
                         <div class="list-group"> 
                        <?php   
                        $obj = new functions();
                        $obj->get_shop_countries(1);  
                        $row = $obj->fetch();
                        while($row)
                        { 
                            echo"<a href='#' onclick='set_country_id($row[a17Code])' class='list-group-item list-group-item-action'>$row[a17country_name]</a>" ;
                            $row = $obj->fetch();       
                        }
                        ?>
                       </div>  
<!--                        <a href="#" class="list-group-item active">  Cras  </a>
                        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>-->
                       
                       
                    </div>
                    
                     <div class="col-lg-10">
                      <?php
   
                      include_once './shop_tables.php';  
                      ?>
                    </div> 
                    
                    
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    
     <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
    
         <script>  
            $(document).ready(function () { 
                $('#shop_details').DataTable({
                    responsive: true 
                }); 
                
            }); 
            
             
        </script>

</body>

</html>
