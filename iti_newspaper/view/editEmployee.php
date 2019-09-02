<?php
    include "template/header.inc";
    include "template/navbar.inc";

if(!isset($_SESSION['job_type'])){
    echo "<div class='loginAccessDeniedSection'><h5>please Login!!!</h5><img src='template/images/Log%20In.jpg'/></div>";
}else {
    if ($_SESSION['job_type'] != 'admin') {
        echo "<div class='loginAccessDeniedSection'><h5>ops access denied !!!</h5><img src='template/images/AccessDenied.png'/></div>";
    } else {
        ?>
        <div id="content">
            <div class="h">
                <div class='myTable'>
                    <table class='table table-bordered'>
                        <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>job type</th>
                            <th>address</th>
                            <th>hire date</th>
                            <th>phone</th>
                            <th>delete</th>
                            <th>edit</th>
                        </tr>
                        </thead>
                        <tbody id="myTbody">

                        </tbody>
                    </table>
                </div>
                <div class="data-on-load">
                    <img src="template/images/load.gif"/>
                    wait .........
                </div>
                <div id="formResult">
                    <div class="myEditForm">

                    </div>
                    <div class="deleteConfirm">
                        <h4>confirm</h4>
                        <span>Are you sure you want to delete this record ?</span>
                        <center>
                            <button class="del_confirm_no btn btn-primary">no</button>
                            <button class="del_confirm_yes btn btn-danger">yes</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
include "template/footer.inc";
?>
