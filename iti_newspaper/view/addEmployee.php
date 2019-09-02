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
                <div class="myForm half">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">user name</label>
                            <input type="text" name="name" id="name" value="" class="form-control" required>
                        </div>

                        <h5 id="resultName" class="r">insert name</h5>

                        <div class="form-group">
                            <label for="email">user email</label>
                            <input type="text" name="email" id="email" value="" class="form-control" required>
                        </div>

                        <h5 id="resultEmail" class="r">insert eamil</h5>

                        <div class="form-group">
                            <label for="password">user password</label>
                            <input type="password" name="password" id="password" value="" class="form-control" required>
                        </div>
                        <h5 id="resultPassword" class="r">insert password</h5>
                        <div class="form-group">
                            <label for="job_type">user job type</label>
                            <select name="job_type" id="job_type" class="form-control" required>
                                <option value="editor">Editor</option>
                                <option value="photographer">Photographer</option>
                            </select>
                            <h5 id="resultJob_type" class="r">select job type</h5>
                        </div>
                        <div class="form-group">
                            <label for="address">user address</label>
                            <input type="text" name="address" id="address" value="" class="form-control" required>
                        </div>
                        <h5 id="resultAddress" class="r">insert address</h5>
                        <div class="form-group">
                            <label for="phone">user phone</label>
                            <input type="text" name="phone" id="phone" value="" class="form-control" required>
                        </div>
                        <h5 id="resultPhone" class="r">insert phone</h5>
                        <input type="submit" name="addEmployee" value="add employee" class="btn btn-danger"
                               id="addEmployee">
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
