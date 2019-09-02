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
                    <form id="newsImagePho" action="<?= $_SERVER['PHP_SELF'] ?>" method="post"
                          enctype="multipart/form-data">
                        <div class='form-group'>
                            <label for="category">category</label>
                            <select name="id_category_pho" id="id_category_pho" class="form-control">
                                <option value="">------- select category ----------</option>
                            </select>
                        </div>

                        <h5 id="resultName" class="r"></h5>

                        <div class="form-group">
                            <label for="id_news_pho">news title</label>
                            <select name="id_news_pho" id="id_news_pho" class="form-control">
                                <option value="">------- select news ----------</option>
                            </select>
                        </div>

                        <h5 id="resultEmail" class="r"></h5>

                        <div class="form-group">
                            <label for="imageName">news image</label>
                            <input type="file" name="imageName[]" id="imageName" class="form-control-file" multiple>
                        </div>
                        <h5 id="resultPassword" class="r"></h5>
                        <input type="hidden" name="id_photographer" value="<?=$_SESSION['id']?>" class="btn btn-danger"
                               id="id_photographer">
                        <input type="hidden" name="addNewsImage" value="addNewsImage" id="addNewsImage">
                        <input type="submit" name="addNewsImage" value="add image" class="btn btn-danger"
                               id="addNewsImage">
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
