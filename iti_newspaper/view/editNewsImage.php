<?php
include "template/header.inc";
include "template/navbar.inc";

if(!isset($_SESSION['job_type'])){
    echo "<div class='loginAccessDeniedSection'><h5>please Login!!!</h5><img src='template/images/Log%20In.jpg'/></div>";
}else {
    if ($_SESSION['job_type'] != 'photographer') {
        echo "<div class='loginAccessDeniedSection'><h5>ops access denied !!!</h5><img src='template/images/AccessDenied.png'/></div>";
    } else {
        ?>
        <div id="content">
            <div class="h">
                <div class="myForm half">
                    <form action="" method="post">
                        <div class='form-group'>
                            <label for="id_news_ed">news</label>
                            <select name="id_news_ed" id="id_news_ed" class="form-control">
                                <option value="">----- select news -----</option>
                            </select>
                        </div>
                        <h5 id="resultName" class="r"></h5>
                        <input type="hidden" name="id_photographer_ed" value="3" id="id_photographer_ed">
                        <input type="submit" name="sendData" value="apply data" class="btn btn-danger" id="sendData">
                    </form>
                </div>
                <div class='myTable padd'>
                    <table class='table table-bordered'>
                        <thead>
                        <tr>
                            <th>image</th>
                            <th>delete</th>
                            <th>edit</th>
                        </tr>
                        </thead>
                        <tbody id="myNewsImageTbody">

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
                    <div class="deleteConfirm pos">
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
