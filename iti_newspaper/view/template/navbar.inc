<div id="navbar">
    <div class="h n">
        <?php
            session_start();
            if(isset($_SESSION['job_type'])){
                //echo$_SESSION['job_type'] ;
                if($_SESSION['job_type']=='editor'){
                    echo'<nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link " id="nav-editorPage-tab" data-toggle="tab" href="editorPage.php" role="tab" aria-controls="nav-editorPage" aria-selected="true">Home</a>
                                <a class="nav-item nav-link " id="nav-addNews-tab" data-toggle="tab" href="addNews.php" role="tab" aria-controls="nav-addNews" aria-selected="false">Add News</a>
                                <a class="nav-item nav-link" id="nav-editNews-tab" data-toggle="tab" href="editNews.php" role="tab" aria-controls="nav-editNews" aria-selected="false">Edit News</a>
                                <a class="nav-item nav-link " id="nav-profilePage-tab" data-toggle="tab" href="profilePage.php" role="tab" aria-controls="nav-profilePage" aria-selected="true">profile</a>
                            </div>
                            
                        </nav>

                        ';
                }elseif($_SESSION['job_type']=='photographer'){
                    echo'<nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link " id="nav-photographerPage-tab" data-toggle="tab" href="photographerPage.php" role="tab" aria-controls="nav-editorPage" aria-selected="true">Home</a>
                                <a class="nav-item nav-link " id="nav-addNewsImage-tab" data-toggle="tab" href="addNewsImage.php" role="tab" aria-controls="nav-addNews" aria-selected="false">Add Image</a>
                                <a class="nav-item nav-link" id="nav-editNewsImage-tab" data-toggle="tab" href="editNewsImage.php" role="tab" aria-controls="nav-editNews" aria-selected="false">Edit Image</a>
                                <a class="nav-item nav-link " id="nav-profilePage-tab" data-toggle="tab" href="profilePage.php" role="tab" aria-controls="nav-profilePage" aria-selected="true">profile</a>
                            </div>
                        </nav>
                        ';
                }elseif ($_SESSION['job_type']=='admin'){
                    echo'<nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="adminPage.php" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                                <a class="nav-item nav-link " id="nav-addEmployee-tab" data-toggle="tab" href="addEmployee.php" role="tab" aria-controls="nav-addEmployee" aria-selected="false">Add Employee</a>
                                <a class="nav-item nav-link" id="nav-editEmployee-tab" data-toggle="tab" href="editEmployee.php" role="tab" aria-controls="nav-editEmployee" aria-selected="false">Edit Employee</a>
                                <a class="nav-item nav-link" id="nav-addCategory-tab" data-toggle="tab" href="addCategory.php" role="tab" aria-controls="nav-addCategory" aria-selected="false">Add Category</a>
                                <a class="nav-item nav-link" id="nav-editCategory-tab" data-toggle="tab" href="editCategory.php" role="tab" aria-controls="nav-editCategory" aria-selected="false">Edit Category</a>
                                <a class="nav-item nav-link " id="nav-profilePage-tab" data-toggle="tab" href="profilePage.php" role="tab" aria-controls="nav-profilePage" aria-selected="true">profile</a>
                            </div>
                        </nav>';
                }elseif ($_SESSION['job_type']=='reader'){
                    echo'<nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link " id="nav-readerPage-tab" data-toggle="tab" href="index.php" role="tab" aria-controls="nav-readerPage" aria-selected="true">Home</a>
                            <a class="nav-item nav-link " id="nav-newsCategoryPage-tab" data-toggle="tab" href="newsCategoryPage.php" role="tab" aria-controls="nav-newsCategoryPage" aria-selected="true">Category</a>
                            <a class="nav-item nav-link " id="nav-profilePage-tab" data-toggle="tab" href="profilePage.php" role="tab" aria-controls="nav-profilePage" aria-selected="true">profile</a>
                        </div>
                    </nav>
                    ';
                }

            }else{
                echo'<div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link " id="nav-register-tab" data-toggle="tab" href="register.php" role="tab" aria-controls="nav-readerPage" aria-selected="true">Register</a>
                     </div>
                ';
            }

        ?>
        <div class="log_in_out right">
            <?php
                if(isset($_SESSION['job_type'])){
                    echo "<a href='#'class='btn'id='nav-logout-tab'>log out</a>";
                }else{
                    echo "<a href='#'class='btn'id='nav-login-tab'>log in</a>";
                }
            ?>

        </div>
    </div>
</div>
<!---<div id="slideshow">
    <div class="h">
    </div>
</div>---->