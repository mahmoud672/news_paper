<?php
    include "template/header.inc";
    include "template/navbar.inc";
?>
<div id="content">
    <div class="h">
        <div class="myForm half">
            <form action=""method="post" >
                <div class="form-group">
                    <label for="name">user name</label>
                    <input type="text"name="name"id="name"value=""class="form-control"required>
                </div>

                    <h5 id="resultName"class="r">insert name</h5>

                <div class="form-group">
                    <label for="email">user email</label>
                    <input type="text"name="email"id="email"value=""class="form-control"required>
                </div>

                    <h5 id="resultEmail"class="r">insert eamil</h5>

                <div class="form-group">
                    <label for="password">user password</label>
                    <input type="password"name="password"id="password"value=""class="form-control"required>
                </div>
                <h5 id="resultPassword"class="r">insert password</h5>
                <div class="form-group">
                    <input type="hidden"name="job_type"value="reader"id="job_type">
                    <h5 id="resultJob_type"class="r"></h5>
                </div>
                <div class="form-group">
                    <label for="address">user address</label>
                    <input type="text"name="address"id="address"value=""class="form-control"required>
                </div>
                <h5 id="resultAddress"class="r">insert address</h5>
                <div class="form-group">
                    <label for="phone">user phone</label>
                    <input type="text"name="phone"id="phone"value=""class="form-control"required>
                </div>
                <h5 id="resultPhone"class="r">insert phone</h5>
                <input type="submit"name="register"value="register"class="btn btn-danger"id="register">
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
