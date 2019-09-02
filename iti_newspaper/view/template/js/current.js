
$(document).ready(function(){

    var data=getCurrentP();
    getCurrentPersonData(data.id,data.job_type,data.email);
    //alert(data.job_type);
    $(".section-user-span").html(data.email);
    $(document).on("click","#updateProfile",function(e){
        e.preventDefault();
        var h=$(".profileResult h5");
        var id=$("#currentId").val();
        var name=$("#currentName").val();
        var email=$("#currentEmail").val();
        var passwordPrev=$("#password").val();
        var passwordCurrent=$("#currentPassword").val();
        var passwordNew=$("#newPassword").val();
        var address=$("#currentAddress").val();
        var phone=$("#currentPhone").val();
        if(name==""||email=="" || passwordPrev=="" || passwordCurrent==""||passwordNew=="" || address ==""||phone==""){
            $(".profileResult").show();
            h.html("please all fields are required !!");
        }else if(!isNaN(name)){
            $(".profileResult").show();
            h.html("please name must be letters !!");
        }else if(!email.match(/([a-zA-Z]+)(@+)([a-zA-Z]+)(.+)(com)/)){
            $(".profileResult").show();
            h.html("please email must be in formats example@example.com !!");
        }else if(passwordPrev.length<8){
            $(".profileResult").show();
            h.html("please dont change this value  !!");
        }else if(passwordCurrent.length<8){
            $(".profileResult").show();
            h.html("your current password length must be at least 8 !!");
        }else if(passwordCurrent!=passwordPrev){
            $(".profileResult").show();
            h.html("please type your correct password !!");
        }else if(passwordNew.length<8){
            $(".profileResult").show();
            $("#resultPassword").show();
            $("#resultPassword").html("ok.");
            h.html("your new password length must be at least 8 !!");
        }else if(phone.length !=11){
            $(".profileResult").show();
            h.html("your phone length must be 11 numbers !!");
        }else{
            $(".profileResult").show();
            h.html("your request has been done successfully ....");
            updateCurrentPersonData(data.id,name,email,passwordNew,data.job_type,address,phone);
            window.location="adminPage.php";
        }
    });
    $(".profileResult").click(function(){$(this).hide();});

});

function getCurrentP(){
    var currentData=false;
    $.ajax({
        type:"POST",
        url:"../lib/current.php",
        dataType:"json",
        async:false,
        success:function(data){
            currentData=data;
        },
        error:function(error){
            alert(error);
        }
    });
    return currentData;
}


function getCurrentPersonData(id,job_type,email){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "display_current_data":1,
            "id_current":id,
            "job_type":job_type,
            "email":email,
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $("#myProfilePageForm").html(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}

function updateCurrentPersonData(id,name,email,passwordNew,job_type,address,phone){
    $.ajax({
        type:"POST",
        url:"../lib/data-b.php",
        data:{
            "updateCurrentPersonData":1,
            "id":id,
            "name":name,
            "email":email,
            "passwordNew":passwordNew,
            "address":address,
            "job_type":job_type,
            "phone":phone
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            (".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}