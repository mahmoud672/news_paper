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
                <div class="myForm half padd">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="categoryName">category name</label>
                            <input type="text" name="categoryName" id="categoryName" value="" class="form-control"
                                   required>
                        </div>

                        <h5 id="resultName" class="r"></h5>

                        <div class="form-group">
                            <label for="id_manager">category manager</label>
                            <select name="id_manager" id="id_manager" class="form-control" required>
                                <option value="">------ select ------</option>
                            </select>
                        </div>

                        <h5 id="resultEmail" class="r"></h5>

                        <h5 id="resultPhone" class="r">insert phone</h5>
                        <input type="submit" name="addCategory" value="add category" class="btn btn-danger"
                               id="addCategory">
                    </form>
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
