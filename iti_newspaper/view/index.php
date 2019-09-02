<?php
include "template/header.inc";
include "template/navbar.inc";

if(!isset($_SESSION['job_type'])){
    echo "<div class='loginAccessDeniedSection'><h5>please Login!!!</h5><img src='template/images/Log%20In.jpg'/></div>";
}else{
    if($_SESSION['job_type']!='reader'){
        echo"<div class='loginAccessDeniedSection'><h5>ops access denied !!!</h5><img src='template/images/AccessDenied.png'/></div>";
    }else{


?>
<!---<div id="slideshow">
    <div class="h">
        <div class="slidImages">
            <img src="template/images/typewriter-1227357_960_720.jpg" alt="">
        </div>
    </div>
</div>---->
<div id="content">
    <div class="h" id="page_contetnt">
        <div class="sliderNews"id="sliderNews">
            <!--<div class="sliderNewsBlock">

                <div class="newsHead">
                    <h5 data-id="">title</h5>
                </div>
                <img src="template/images/typewriter-1227357_960_720.jpg"">
            </div>
            <div class="sliderNewsBlock">
                <div class="newsHead">
                    <h5 data-id="">title</h5>
                </div>
            </div>
            <div class="sliderNewsBlock">
                <div class="newsHead">
                    <h5 data-id="">title</h5>
                </div>
            </div>
            <div class="sliderNewsBlock">
                <div class="newsHead">
                    <h5 data-id="">title</h5>
                </div>
            </div>--->

        </div>
        <button class="leftSlide l"> < </button>
        <button class="rightSlide r"> > </button>
        <div id="mostRecentlyNews">
            <div id="mostRecentlyNews-head">
                <h4>the most recently news </h4>
            </div>


           <!----->
            </div>
        </div>
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
