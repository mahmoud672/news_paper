<?php
include "template/header.inc";
include "template/navbar.inc";


if(isset($_SESSION['job_type'])){
    //echo $_SESSION['job_type'];
    if($_SESSION['job_type']=='reader') {


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
                <div class="sliderNews" id="sliderNews">

                </div>
                <button class="leftSlide l"> <</button>
                <button class="rightSlide r"> ></button>



                <div id="readerPage-content">

                    <div id="readerPage-contentNews">

                    </div>

                </div>
                <div id="menue">
                    <div id="menue_head">
                        <h2>categories</h2>
                    </div>
                </div>
                <div class="profileResult">
                    <img src=""/>
                </div>
                <div class="data-on-load">
                    <img src="template/images/load.gif"/>
                    wait .........
                </div>

            </div>
        </div>

        <?php
    }else{
        echo"forbiden acceess";
    }
}else {
    echo"please login";
}
include "template/footer.inc";
?>
