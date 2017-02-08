<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//session_start(); 

//echo 'helplo thererkhzdkjfhasfsf';
//$_SESSION['cmd'] = 1;
if(!isset($_SESSION['cmd']))
{
    $_SESSION['cmd'] = 111;
}
$cmd = $_SESSION['cmd'];

$obj= new functions();
$obj->get_retailer_per_country($cmd); 
 $row = $obj->fetch(); 
?>
<h3 class="page-header"><br><br><br><?php print $row['a17country_name']?></h3> 
 <a href="add_retailer.php"><button  type = "button" class = "btn btn-primary btn-sm">
   Add new retailer
   </button></a> 
<br>
<br>
<table class="table table-striped table-bordered table-hover" id = "shop_details">
                                    <thead>
                                        <tr>
                                             <th>#</th>
                                            <th>Retailer Id</th>
                                              <th>Shop Name</th> 
<!--                                            <th>Owner Name</th>-->
                                            <th>Chain</th>
                                             <th>NO. shops</th>
                                               <th></th>
                                              
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <!--<td>$row[a00SHOP_OWNER_NAME]</td>-->
                                        <?php
                                        
                                        while($row)
                                        {
                                            echo " <tr>
                                            <td>$row[a00code]</td>
                                            <td>$row[a00RETAILER_ID]</td>
                                             <td>$row[a00SHOP_NAME]</td>                                       
                                            <td>$row[a00Chain]</td>
                                            <td>$row[number_of_shops]</td>  
                                            <td><a href='retailer_details.php?cmd=$row[a00code]'>View More</a></td> 
                                        </tr>"; 
                                             $row = $obj->fetch();
                                        }
                                         
                                        ?>
                                       
 </table>

