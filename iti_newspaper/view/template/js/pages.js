///------------ get pages --------///
//---------- admin pages ------//
$("#nav-addEmployee-tab").click(function(e){
    e.preventDefault();
    $("body").load("addEmployee.php");
    $(this).toggleClass('active');

});
$("#nav-editEmployee-tab").click(function(e){
    e.preventDefault();
    $("body").load("editEmployee.php");
    $(this).toggleClass('active');
});


$("#nav-home-tab").click(function(e){
    e.preventDefault();
    $("body").load("adminPage.php");
    $(this).toggleClass('active');
});
$("#nav-addCategory-tab").click(function(e){
    e.preventDefault();
    $("body").load("addCategory.php");
    $(this).toggleClass('active');
});
$("#nav-editCategory-tab").click(function(e){
    e.preventDefault();
    $("body").load("editCategory.php");
    $(this).toggleClass('active');
});
///-----------------
//------- editor pages ------------
$("#nav-editorPage-tab").click(function(e){
    e.preventDefault();
    $("body").load("editorPage.php");
    $(this).toggleClass('active');
});
$("#nav-addNews-tab").click(function(e){
    e.preventDefault();
    $("body").load("addNews.php");
    $(this).toggleClass('active');
});
$("#nav-editNews-tab").click(function(e){
    e.preventDefault();
    $("body").load("editNews.php");
    $(this).toggleClass('active');
});
//------------//

//-----------photographer pages
$("#nav-photographerPage-tab").click(function(e){
    e.preventDefault();
    $("body").load("photographerPage.php");
    $(this).toggleClass('active');
});
$("#nav-addNewsImage-tab").click(function(e){
    e.preventDefault();
    $("body").load("addNewsImage.php");
    $(this).toggleClass('active');
});
$("#nav-editNewsImage-tab").click(function(e){
    e.preventDefault();
    $("body").load("editNewsImage.php");
    $(this).toggleClass('active');
});
////-----------------//
//---------- reader pages ----------------//
$("#nav-readerPage-tab").click(function(e){
    e.preventDefault();
    $("body").load("index.php");
    $(this).toggleClass('active');
});
$("#nav-newsCategoryPage-tab").click(function(e){
    e.preventDefault();
    $("body").load("newsCategoryPage.php");
    $(this).toggleClass('active');
});
$("#nav-register-tab").click(function(e){
    e.preventDefault();
    $("body").load("register.php");
    $(this).toggleClass('active');
});

//-----------------------//
//------login page
$("#nav-login-tab").click(function(e){
    e.preventDefault();
    $("body").load("login.php");

});

//-----profile page----------//
$("#nav-profilePage-tab").click(function(e){
    e.preventDefault();
    $("body").load("profilePage.php");

})
