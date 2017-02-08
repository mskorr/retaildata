<?php
$obj = new functions();
$obj ->get_shops_per_retailer_id(0, $row['a02Code']);  
$row = $obj->fetch();
//print_r($row);
?>
     
<div class="row">
<div class="col-lg-4">
    <div class="form-group">
        <h5>Shop  Name:</h5>
        <input class="form-control" id="shop_name" type="text" placeholder="<?php print $row['a02Name']?>" disabled>
    </div>
    <br> 
    <div class="form-group"> 
        <h5>Shop Manager Name:</h5>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php print $row['a02SHOP_MANAGER_NAME']?>" disabled>
    </div>
    <br>
    <div class="form-group">  
        <h5>Shop Manager Contact:</h5>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php print $row['a02SHOP_MANAGER_CONTACT_NO']?>" disabled>
    </div>
                                
    <br>
    <div class="form-group"> 
        <h5>Shop Landline:</h5>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php print $row['a02SHOP_LANDLINE']?>" disabled>
    </div>
    
    <br>
    <div class="form-group"> 
        <h5>Shop Email:</h5>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php print $row['a02SHOP_EMAIL']?>" disabled>
    </div>
    
    <br>
    <div class="form-group"> 
        <h5>Shop Manager Tel.:</h5>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php print $row['Shop_manager_telephone']?>" disabled>
    </div>
                                
</div>
<div class="col-lg-2">
    
</div>
 
<div class="col-lg-4">
    <div class="form-group">
        <h5>Governorate:</h5>
        <input class="form-control" id="shop_name" type="text" placeholder="<?php print $row['a02GOVERNORATE']?>" disabled>
    </div>
    <br> 
    <div class="form-group"> 
        <h5>Village:</h5>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php print $row['a02VILLAGE']?>" disabled>
    </div>
    <br>
    <div class="form-group"> 
        <h5>Kazaa:</h5>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php print $row['a02KAZAA']?>" disabled>
    </div>
                                
    <br>
    <div class="form-group"> 
        <h5>Longitude:</h5>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php print $row['a02LONGITUDE']?>" disabled>
    </div>
    
    <br>
    <div class="form-group"> 
        <h5>Latitude:</h5>
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php print $row['a02LATITUDE']?>" disabled>
    </div>
    
    <br>
    <div class="form-group"> 
        <h5>Chain:</h5> 
        <input class="form-control" id="disabledInput" type="text" placeholder="<?php print $row['a02Chain']?>" disabled>
    </div>
                                
</div> 
    </div> 