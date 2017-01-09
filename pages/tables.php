<!DOCTYPE html>
<html lang="en">

<?php
//session_start();
include_once './header.php';
include_once './sidebar.php'; 
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
       
           
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Barcode Verification</h1>
                </div>
                <!-- /.col-lg-12 -->
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
//                                    echo "tables";
                                    $obj = new functions();
                                    $obj->show_barcodes();
                                    $row = $obj->fetch();
                                   
                                    while ($row)
                                    { 
                                     echo"<tr class='odd gradeX'>        
                                        
                                        <td>$row[BARCODE2]</td>
                                        <td class='center'>$row[ITEM_DESCRIPTION]</td>
                                        <td class='center'><a href='barcode_check.php?b=$row[BARCODE2]'>edit</a></td>
                                    </tr> "; 
                                      $row = $obj->fetch();
                                    }                     
                                ?>
  <!--<td>$row[a08retailer_shop]</td>-->
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
<!--                            <div class="well">
                                <h4>DataTables Usage Information</h4>
                                <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                                <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                            </div>-->
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
