<?php
include "template/header.inc";
include "template/navbar.inc";
?>
<div id="content">
    <div class="h">
        <div class="myForm half">
            <form action=""method="post" >
                <div class="form-group">
                    <label for="email">user email</label>
                    <input type="text"name="email"id="email"value=""class="form-control"required>
                </div>
                <h5 id="resultName"class="r">insert name</h5>
                <div class="form-group">
                    <label for="password">user password</label>
                    <input type="password"name="password"id="password"value=""class="form-control"required>
                </div>
                <h5 id="resultEmail"class="r">insert eamil</h5>
                <input type="submit"name="login"value="login"class="btn btn-danger"id="login">
            </form>
        </div>
        <div class="data-on-load">
            <img src="template/images/load.gif"/>
            wait .........
        </div>

    </div>
</div>

<?php
include "template/footer.inc";
?>
