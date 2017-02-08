<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
body { background-color:#fafafa;}
.m-progress-bar {
    min-height: 1em;
    background: #c12d2d;
    width: 5%;
}
</style>
<title>jQuery Multi-Step Modal Plugin Examples</title>
</head>
<body>

<form class="modal multi-step" id="demo-modal-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
            $p = 1;
            $c = 1;
            while($c < 5)
            {
                echo "<div class='modal-header'>
                <h4 class='modal-title step-$c' data-step='$c'>Step $c</h4> </div>";
                
                echo "<div class='modal-body step step-$c'> 
                This is step $c.
            </div>";
                $c++;
            }
            ?>
             
              
            
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary step step-1" data-step="<?php print $p ?>" onclick="sendEvent('#demo-modal-1', <?php print $p+1 ?>)">Continue</button>
            </div>
        </div>
    </div>
</form>

<div class="container">
<h1>jQuery Multi-Step Modal Plugin Examples</h1>
<div class="jquery-script-ads" style="margin:30px auto;"><script type="text/javascript"><!--
google_ad_client = "ca-pub-2783044520727903";
/* jQuery_demo */
google_ad_slot = "2780937993";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
    <div class="row">
        <h2>
            Basic Demo
        </h2>
        <button class="btn btn-default" data-toggle="modal" data-target="#demo-modal-1">Show</button>
    </div>
</div>
<script src="multi-step-modal.js"></script>
<script>
sendEvent = function(sel, step) {
    $(sel).trigger('next.m.' + step);
}
</script> 
</body>
</html>
 