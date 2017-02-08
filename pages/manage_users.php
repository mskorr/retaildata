<!DOCTYPE html>
<html lang="en">
    
    <?php
    include_once './sidebar.php';
    include_once './header.php';

    echo $_SESSION['user_name'];
    ?>
    <body>
        
        <div id="wrapper">
            
            <!-- Navigation -->
            <?php
            ?>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Users</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12"> 
                       
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>User Type</th>
                                        <th></th>
                                        
<!--<td><a>Edit</a></td>-->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $obj = new functions();
                                $obj->get_users();
                                $row = $obj->fetch();
                                while ($row) {
                                    echo " <tr><td>$row[a26code]</td>  
                                             <td>$row[a26firstname]</td>
                                            <td>$row[a26lastname]</td>
                                            <td>$row[a26username]</td> 
                                            <td>$row[a26user_type]</td> 
                                            <td><a data-toggle='modal' data-target='#myModalDelete' >Delete</a></td>  
                                            </tr>";

                                    $row = $obj->fetch();
                                      
                                }  
                        ?> 
                                    
                                    
                                    
                                </tbody>
                            </table>
                      
<!--                        <div class="modal fade" id="myModalDelete" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this user?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Yes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button> 
        </div>
      </div>
    </div>
  </div>-->
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"> Add new user</button>
                        <!--<button type="button" class="btn btn-default">Add new user</button>-->
                    </div>
                    
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                            
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Modal Header</h4>
                                </div>
                                <div class="modal-body">
                                    <form role="form">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Firstname</label>
                                                    <input id="firstname" class="form-control">
                                                </div>
                                                
                                                
                                                
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input id="user_name"class="form-control">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select id="country" class="form-control">
                                                <?php 
                                                $obj = new functions();
                                                $obj->get_countries();
                                                $row = $obj->fetch();
                                                while($row)
                                                {
                                                    echo "<option value = '$row[a17Code]'>$row[a17country_name]</option>";
                                                    $row = $obj->fetch();
                                                }
                                                ?>
                                                        
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Lastname</label>
                                                    <input id="lastname" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>User type</label>
                                                    <select id="user_type" class="form-control">
                                                <?php
                                                $obj = new functions();
                                                $obj->get_user_type();
                                                $row = $obj->fetch();
                                                while($row)
                                                {
                                                    echo "<option value = '$row[a27code]'>$row[a27type]</option>";
                                                    $row = $obj->fetch();
                                                }
                                                ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div>
                                            <pre id="generated_password" style="display: none"></pre>  
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <button type="button" onclick="generate_password()"  class="btn btn-default">Generate Password</button>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="add_user()" class="btn btn-default" data-dismiss="modal">Add</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
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
        
        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>
        
        <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
    
         <script>  
            $(document).ready(function () { 
                $('#dataTables-example').DataTable({
                    responsive: true
                });
                
            }); 
            
             
        </script>
    </body>
    
</html>
