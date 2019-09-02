<?php
include "template/header.inc";
include "template/navbar.inc";

if(!isset($_SESSION['job_type'])){
    echo "<div class='loginAccessDeniedSection'><h5>please Login!!!</h5><img src='template/images/Log%20In.jpg'/></div>";
}else{
if($_SESSION['job_type']!='editor'){
    echo"<div class='loginAccessDeniedSection'><h5>ops access denied !!!</h5><img src='template/images/AccessDenied.png'/></div>";
}else{
?>
<div id="slideshow">
    <div class="h">
        <div class="slidImages">
            <img src="template/images/newspaper-595478_960_720.jpg" alt="">
        </div>
    </div>
</div>
<div id="content">
    <div class="h" id="page_contetnt">

        <div class="data-on-load">
            <img src="template/images/load.gif"/>
            wait .........
        </div>

    </div>
</div>

<?php
}
}
include "template/footer.inc";
?>
