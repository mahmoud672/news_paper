$("document").ready(function(){

    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "allCategoriesData":"allCategoriesData"
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            $("#id_category_pho").append(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
    var id_category=0;
    $("#id_category_pho").click(function(){
        id_category=$("#id_category_pho").val();
        getNewsByCategory(id_category);
    })
    $("#newsImagePho").on("submit",function(e){
        e.preventDefault();
        var id_news=$("#id_news_pho").val();
        var id_photographer=$("#id_photographer").val();
        var imageName=$("#imageName").val();
        var status=validateNewsImage(id_category,id_news,imageName,id_photographer);
        if(status=="invalid"){

        }else if(status=="valid"){
            var form=$(this);
            var form_data=new FormData(form[0]);
            addNewsImage(form_data);
            //alert(id_photographer);
            $("#id_news_pho").val("");
            $("#imageName").val("");
        }
        //alert(id_category+" "+id_news+" "+id_photographer+" "+imageName);
    })
    //---------------------//
    getAllNewstoFillOptions();
    $("#sendData").click(function(e){
        e.preventDefault();
        var id_photographer_ed=$("#id_photographer_ed").val();
        var id_news_ed=$("#id_news_ed").val();
        if(id_photographer_ed==""){
           alert("this can`t happened");
        }else if(isNaN(id_photographer_ed)){
            alert("invalid value for this field");
        }else if(id_news_ed==""){
            $("#resultName").show();
            $("#resultName").html("please select news to display image(s) !");
        }else if(isNaN(id_news_ed)){
            $("#resultName").show();
            $("#resultName").html("invalid value for news !");
        }else{
            $("#resultName").hide();
            getPhotographerNewsImages(id_photographer_ed,id_news_ed);
            $(document).on("click",".deleteNewsImage",function(){
                var imageName=$(this).attr("data-id");
                if(imageName==""){
                    alert("that can`t be happened please reload the page !");
                }else{
                    $("#formResult").show();
                    $(".deleteConfirm").show();
                    $(".del_confirm_no").click(function(){
                        $(".deleteConfirm").hide();
                        $("#formResult").hide();
                    });
                    $(".del_confirm_yes").click(function(){
                        deleteCurrentNewsImage(id_photographer_ed,id_news_ed,imageName);
                        getPhotographerNewsImages(id_photographer_ed,id_news_ed);
                        $(".deleteConfirm").hide();
                        $("#formResult").hide();
                    });

                }
            });
        }

    });
    //----- log in -------------//
    $("#login").click(function(e){
        e.preventDefault();
        var email=$("#email").val();
        var password =$("#password").val();
        if(email==""){
            $("#resultName").show();
            $("#resultName").html("please type your E-mail !");
        }else if(!email.match(/([a-zA-Z]+)(@+)([a-zA-Z]+)(.+)(com)/)){
            $("#resultName").show();
            $("#resultName").html("E-mail format like example@example.com!");
        }else if(password==""){
            $("#resultName").hide();
            $("#resultEmail").show();
            $("#resultEmail").html("please insert password !");
        }else if(password.length<8){
            $("#resultEmail").show();
            $("#resultEmail").html("password length must be at least 8 !");
        }else{
            $("#resultName").hide();
            $("#resultEmail").hide();
            login(email,password);

        }
    });
    $("#nav-logout-tab").click(function(e){
        e.preventDefault();
        logout();
    });

    // reader registration ////
    $("#register").click(function(e){
        e.preventDefault();
        var name=$("#name").val();
        var email=$("#email").val();
        var password=$("#password").val();
        var job_type=$("#job_type").val();
        var address=$("#address").val();
        var phone=$("#phone").val();
        var status=validateForm(name, email,password,job_type,address,phone)
        if(status=="invalid"){

        }else if(status=="valid"){
            $.ajax({
                type:"POST",
                url:"../lib/data-b.php",
                data:{
                    'register':1,
                    'name':name,
                    'email':email,
                    'password':password,
                    'job_type':job_type,
                    'address':address,
                    'phone':phone
                },
                beforeSend:function(){
                    $(".data-on-load").show();
                },
                success:function(data){
                    alert(data);
                    $("#name").val("");
                    $("#email").val("");
                    $("#password").val("");
                    $("#address").val("");
                    $("#phone").val("");
                    $(".data-on-load").hide();

                },
                error:function(error){
                    alert(error);
                }
            });
        }
    });

    fillSliderNews();
    getAllNewsInReaderPage();
    fillMostRecentlyNews();
    $(".rightSlide").click(function () {
        $(".sliderNewsBlock:nth-child(1),.sliderNewsBlock:nth-child(2),.sliderNewsBlock:nth-child(3),.sliderNewsBlock:nth-child(4)").hide();
        $(".sliderNewsBlock:nth-child(5),.sliderNewsBlock:nth-child(6),.sliderNewsBlock:nth-child(7),.sliderNewsBlock:nth-child(8)").fadeToggle(1000);
        $(this).hide(2000);
        $(".leftSlide").fadeToggle(1000);
    });
    $(".leftSlide").click(function () {
        $(".sliderNewsBlock:nth-child(1),.sliderNewsBlock:nth-child(2),.sliderNewsBlock:nth-child(3),.sliderNewsBlock:nth-child(4)").fadeToggle(1000);
        $(".sliderNewsBlock:nth-child(5),.sliderNewsBlock:nth-child(6),.sliderNewsBlock:nth-child(7),.sliderNewsBlock:nth-child(8)").hide();
        $(this).hide(2000);
        $(".rightSlide").fadeToggle(1000);
    });

    //fill menue -------------------------
    fillMenuewithCategory();
    $(document).on('click',".list_head",function(){
        var next=$(this).next();
        var prev=$(this).prev();
        $(this).addClass('selectedI');
        //$(this).toggleClass('selectedI');
        var id=$(this).data('id');
        prev.removeClass('selectedI');
        next.removeClass('selectedI');
        getAllNewsInCategoryPageUsingCategory(id);
        next.click(function(){$(this).removeClass('selectedI');prev.removeClass('selectedI');});
        prev.click(function(){$(this).removeClass('selectedI');next.removeClass('selectedI');});
    })
    $(document).on('click',"#all-n",function(){
        getAllNewsInReaderPage();
        $(".list_head").removeClass('selectedI');

    })

    ////-----------------------

});




//----- functions --------to use--------------------//

//display news by category
function getNewsByCategory(id_category){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "getAllCategoryNews":1,
            "id_category":id_category
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            $("#id_news_pho").html(data);
            //alert(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}
// validate news_image form
function validateNewsImage(id_category,id_news,imageName,id_photographer){
    var status="invalid";
    if(id_category ==""){
        $("#resultName").show();
        $("#resultName").html("please select category !");
    }else if(isNaN(id_category)){
        $("#resultName").show();
        $("#resultName").html("invalid value for category !");
    }else if(id_news==""){
        $("#resultName").hide();
        $("#resultEmail").show();
        $("#resultEmail").html("please select news !");
    }else if(isNaN(id_news)){
        $("#resultEmail").hide();
        $("#resultPassword").show();
        $("#resultPassword").html("invalid value for news !");
    }else if(imageName==""){
        $("#resultPassword").show();
        $("#resultPassword").html("please choose image for this news !");
    }else if(id_photographer==""){
        $("#resultEmail").hide();
        $("#resultPassword").hide();
        alert("that can`t be happened !");
    }else if(isNaN(id_photographer)){
        $("#resultPassword").hide();
        alert("invalid value for this field !");
    }else{
        $("#resultName").hide();
        $("#resultEmail").hide();
        $("#resultPassword").hide();

        status="valid";
        return status;
    }
}

//--- add news_image
function addNewsImage(form_data){
 $.ajax({
     type:"POST",
     url:"../lib/data-b.php",
     contentType:false,
     processData:false,
     data:form_data,
     beforeSend:function(){
         $(".data-on-load").show();
     },
     success:function(data){
         alert("datasend");
         $(".data-on-load").hide();
     },
     error:function(error){
         alert("wdd");
     }
 });
}
//------------ display all news
function getAllNewstoFillOptions(){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "getNews":1
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert("datasend");
            $("#id_news_ed").append(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            //alert("wdd");
        }
    });
}


//display all imagae news for this photographer
function getPhotographerNewsImages(id_photographer,id_news){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "phoNewsImage":1,
            "id_photographer":id_photographer,
            "id_news":id_news
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $("#myNewsImageTbody").html(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            //alert("wdd");
        }
    });
}

///-------- delete news image
function deleteCurrentNewsImage(id_photographer_ed,id_news_ed,imageName){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "deletPhoNewsImage":1,
            "id_photographer":id_photographer_ed,
            "id_news":id_news_ed,
            "imageName":imageName
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}

//---- login function() -----//
function login(email,password){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "login":1,
            "email":email,
            "password":password
        },
        dataType:"json",
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data.job_type);
            $(".data-on-load").hide();
            if(data.job_type=='editor'){
                window.location="editorPage.php";
            }else if(data.job_type=='photographer'){
                window.location="photographerPage.php";
            }else if(data.job_type=='reader'){
                window.location="index.php";
            }else if(data.job_type=='admin'){
                window.location="adminPage.php";
            }
            $(".data-on-load").hide();
        },
        error:function(error){
            alert("asaa");
        }
    });

}
//-----------log out function------------//
function logout(){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "logout":1
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $(".data-on-load").hide();
            window.location="login.php";
        },
        error:function(error){
            alert(error);
        }
    });
}

///------------ fill slider news ---------//
function fillSliderNews(){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "fillSliderNews":1
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $("#sliderNews").html(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}
//-------- fill most recently news div ----///
function fillMostRecentlyNews(){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "fillMostRecentlyNews":1
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $("#mostRecentlyNews").append(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}


//------------- fill menue with category-------------//
function fillMenuewithCategory(){
    $.ajax({
        url:"../lib/data-b.php",
        type:"POST",
        data:{
            "fillMenuewithCategory":1
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $("#menue").append(data);
            //$("#mostRecentlyNews").append(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }

    });
}

///---------------- all news in specific category
function getAllNewsInCategoryPageUsingCategory(id_category){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "getAllNewsInCategoryPageUsingCategory":1,
            'id_category':id_category
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $("#readerPage-contentNews").html(data);
            //$("#mostRecentlyNews").append(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}

//------------ all news in reader page ------//
function getAllNewsInReaderPage(){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "getAllNewsInReaderPage":1
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $("#readerPage-contentNews").html(data);
            //$("#mostRecentlyNews").append(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}

