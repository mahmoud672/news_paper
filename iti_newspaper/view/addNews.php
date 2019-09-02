<?php
    include "template/header.inc";
    include "template/navbar.inc";
if(!isset($_SESSION['job_type'])){
    echo "<div class='loginAccessDeniedSection'><h5>please Login!!!</h5><img src='template/images/Log%20In.jpg'/></div>";
}else {
    if ($_SESSION['job_type'] != 'editor') {
        echo "<div class='loginAccessDeniedSection'><h5>ops access denied !!!</h5><img src='template/images/AccessDenied.png'/></div>";
    } else {
        ?>
        <div id="content">
            <div class="h">
                <div class="myForm half">
                    <form action="" method="post">
                        <div class='form-group'>
                            <label for="title">news title</label>
                            <input type="text" name="title" id="title" value="" class="form-control" required>
                        </div>

                        <h5 id="resultName" class="r"></h5>

                        <div class="form-group">
                            <label for="description">news description</label>
                            <textarea name='description' id='description' class="form-control"></textarea>
                        </div>

                        <h5 id="resultEmail" class="r"></h5>

                        <div class="form-group">
                            <label for="id_category">category</label>
                            <select name="id_category" id="id_category" class="form-control">
                                <option value="">----------- select category ------------</option>
                            </select>
                        </div>
                        <h5 id="resultPassword" class="r"></h5>
                        <input type="hidden" name="id_editor" value="2" class="btn btn-danger" id="id_editor">
                        <input type="submit" name="addNews" value="add news" class="btn btn-danger" id="addNews">
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
