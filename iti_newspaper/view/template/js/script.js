$("document").ready(function(){
    getAllEmployees();
    $("#addEmployee").click(function(e){
        //return false;
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
                url:"../lib/data.php",
                data:{
                    'addEmployee':'addEmployee',
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
                    //alert(data);
                    $("#name").val("");
                    $("#email").val("");
                    $("#password").val("");
                    $("#job_type").val("");
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
    $(document).on('click',".editEmployee",function(){
        var id=$(this).attr("data-id");
        getEmployeeById(id);
        $("#formResult").show();
        $(".myEditForm").show();

        $(document).on('click',".close_window",function() {
            $("#formResult").hide();
            //alert('thf');
        });
        $(document).on('click',"#updateEmployee",function(e){
            e.preventDefault();
            var id_employee=$("#id").val();
            var name=$("#name").val();
            var email=$("#email").val();
            var password=$("#password").val();
            var job_type=$("#job_type").val();
            var address=$("#address").val();
            var phone=$("#phone").val();
            var status=validateForm(name, email,password,job_type,address,phone);
            if(status=="invalid"){
                //alert("please check all fields");
            }else if(status=="valid"){
                updateEmployee(id_employee,name,email,password,job_type,address,phone);
                $("#formResult").hide();
                getAllEmployees();
            }
        });
    });

    $(document).on('click',".deleteEmployee",function(){
        var id=$(this).attr("data-id");
        $("#formResult").show();
        $(".myEditForm").hide();
        $(".deleteConfirm").show();
        $(".del_confirm_no").click(function(){
            $("#formResult").hide();
        });
        $(".del_confirm_yes").click(function(){
            deleteEmployee(id);
            $("#formResult").hide();
            getAllEmployees();
        })
        //alert('ggg');
    });
    //-----------------------------          category                    --------------------//
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "allEmployeesData":"allEmployeesData"
        },
        success:function(data){
            $("#id_manager").append(data);
            //alert(data);

        },
        error:function(error){
            alert(error);
        }
    });
    $("#addCategory").click(function(e){
        e.preventDefault();
        //alert("hewar");
        var categoryName=$("#categoryName").val();
        var id_manager=$("#id_manager").val();

        var status=validateCategory(categoryName,id_manager);
        if(status=="invalid"){

        }else if(status=="valid"){
            $.ajax({
                type:"POST",
                url:"../lib/data.php",
                data:{
                    "addCategory":"addCategory",
                    "categoryName":categoryName,
                    "id_manager":id_manager
                },
                beforeSend:function(){
                    $(".data-on-load").show();
                },
                success:function(data){
                    $(".data-on-load").hide();
                    alert(data);
                    $("#categoryName").val("");
                    $("#id_manager").val("");
                },
                error:function(error){
                    alert(error);
                }
            });
        }
    });

    getAllCategories();
    $(document).on("click",".editCategory",function () {
        var id=$(this).attr("data-id");
        $("#formResult").show();
        $(".myEditForm").show();
        getCategory(id);
        $(document).on('click',".close_window",function(){
            $("#formResult").hide();
        })
        $(document).on('click',"#updateCategory",function(e){
            e.preventDefault();
            id=$("#id").val();
            var categoryName=$("#categoryName").val();
            var id_manager=$("#id_manager").val();
            var status=validateCategory(categoryName,id_manager);
            if(status=="invalid"){

            }else if(status=="valid"){
                $("#formResult").hide();
                updateCategory(categoryName,id_manager,id);
                getAllCategories();
            }

        });
    })
    $(document).on('click',".deleteCategory",function(){
        var id=$(this).attr("data-id");
        $("#formResult").show();
        $(".myEditForm").hide();
        $(".deleteConfirm").show();
        $(".del_confirm_no").click(function(){
            $("#formResult").hide();
            $(".deleteConfirm").hide();
        });
        $(".del_confirm_yes").click(function(){
            deleteCategory(id);
            $("#formResult").hide();
            getAllCategories();
        })
    });
    //------------   news    ---------//
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
            $("#id_category").append(data);
            $(".data-on-load").hide();
            //alert(data);
        },
        error:function(error){
            alert(error);
        }
    });
    $("#addNews").click(function(e){
        e.preventDefault();
        var title=$("#title").val();
        var description=$("#description").val();
        var id_editor=$("#id_editor").val();
        var id_category=$("#id_category").val();
        var status=validateNews(title,description,id_editor,id_category);
        //alert(id_editor);
        if(status=="invalid"){

        }else if(status=="valid"){
            //console.log(title+" "+description+" "+id_editor+" "+id_category);
            $.ajax({
                type:'GET',
                url:'../lib/data.php',
                data:{
                    "addNews":1,
                    "title":title,
                    "description":description,
                    "id_editor":id_editor,
                    "id_category":id_category
                },
                beforSend:function(){
                    $(".data-on-load").show();
                },
                success:function(data){
                    alert(data);
                    $("#title").val("");
                    $("#description").val("");
                    $("#id_category").val("");
                    $(".data-on-load").hide();
                },
                error:function(error){
                    alert(error);
                }
            });
        }
    });
    getAllNews();
    $(document).on('click',".deleteNews",function(){
        var id=$(this).attr("data-id");
        $("#formResult").show();
        $(".deleteConfirm").show();
        $(".del_confirm_no").click(function(){
            $(".deleteConfirm").hide();
            $("#formResult").hide();
        });
        $(".del_confirm_yes").click(function(){
            deleteNews(id);
            getAllNews();
            $(".deleteConfirm").hide();
            $("#formResult").hide();
        });
    })
    $(document).on('click',".editNews",function(){
        var id=$(this).attr("data-id");
        getNewsById(id);
        $("#formResult").show();
        $(document).on('click',".close_window",function(){
            $("#formResult").hide();
        });
        $(document).on('click',"#updateNews",function(e){
            e.preventDefault();
            var title=$("#title").val();
            var description=$("#description").val();
            var id_editor=$("#id_editor").val();
            var id_category=$("#id_category").val();
            id=$("#id_news").val();
            var status=validateNews(title,description,id_editor,id_category);
            //alert(id_editor);
            if(status=="invalid"){

            }else if(status=="valid"){
                updateNews(title,description,id_editor,id_category,id);
                $("#formResult").hide();
                getAllNews();
            }

        });
    });
});


function getAllEmployees(){
    $.ajax({
        type:'POST',
        url:'../lib/data.php',
        data:{
            'allEmployees':'allEmployees'
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            $("#myTbody").html(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            $("#myTbody").html(error)
        }
    });
}

function getEmployeeById(id){
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "id_employee":id
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            $(".myEditForm").html(data);
            $(".data-on-load").hide();
        },
        error:function(error){

        }
    });
}

function updateEmployee(id,name,email,password,job_type,address,phone){
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "updateEmplopyee":"updateEmplopyee",
            "id":id,
            "name":name,
            "email":email,
            "password":password,
            "job_type":job_type,
            "address":address,
            "phone":phone
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
function deleteEmployee(id) {
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "deleteEmployee":"deleteEmplyee",
            "id":id
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);

            $(".data-on-load").hide();
        },
        error:function(error){
            alert(erro);
        }
    });
}
function validateForm(name,email,password,job_type,address,phone){
    var status="invalid";
    if(name ==""){
        $("#resultName").show();
        $("#resultName").html("please insert name !");
    }else if(!isNaN(name)){
        $("#resultName").show();
        $("#resultName").html("please name must be letters !");
    }else if(email==""){
        $("#resultName").hide();
        $("#resultEmail").show();
        $("#resultEmail").html("please insert email !");
    }else if(!email.match(/([a-z]+)(@+)([a-z]+)(.+)(com)/)){
        $("#resultEmail").show();
        $("#resultEmail").html("please type valid email !");
    }else if(password==""){
        $("#resultEmail").hide();
        $("#resultPassword").show();
        $("#resultPassword").html("please insert password !");
    }else if(password.length<8){
        $("#resultPassword").show();
        $("#resultPassword").html("password length must be greater than 7 !");
    }else if(job_type==""){
        $("#resultPassword").hide();
        $("#resultJob_type").show();
        $("#resultJob_type").html("please select a job type for Employee !");
    }else if(!isNaN(job_type)){
        $("#resultPassword").hide();
        $("#resultJob_type").show();
        $("#resultJob_type").html("invalid value for job refresh your browser !");
    }else if(address==""){
        $("#resultPassword").hide();
        $("#resultJob_type").hide();
        $("#resultAddress").show();
        $("#resultAddress").html("please insert your address !");
    }else if(phone==""){
        $("#resultAddress").hide();
        $("#resultPhone").show();
        $("#resultPhone").html("please insert employee phone !");
    }else if(isNaN(phone)){
        $("#resultPhone").show();
        $("#resultPhone").html("please phone must be numbers !");
    }else if(phone.length >12 && phone.length <11){
        $("#resultPhone").show();
        $("#resultPhone").html("please phone length must be 11 !");
    }else{

        $("#resultName").hide();
        $("#resultEmail").hide();
        $("#resultPassword").hide();
        $("#resultJob_type").hide();
        $("#resultAddress").hide();
        $("#resultPhone").hide();
        status="valid";

    }
    return status;
}
/////------------------------ category ------------//
function getAllCategories() {
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "allCategories":"allCategories"
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            $("#myCategoryTbody").html(data);
            $(".data-on-load").hide();
            //alert(data);
        },
        error:function(error){
            alert(error);
        }
    });
}

function getCategory(id){
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "id_category":id
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            $(".myEditForm").html(data);
            //alert(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}
function validateCategory(categoryName,id_manager){
    var status="invalid";
    if(categoryName ==""){
        $("#resultName").show();
        $("#resultName").html("please insert category name !");
    }else if(!isNaN(categoryName)){
        $("#resultName").show();
        $("#resultName").html("please name must be letters !");
    }else if(id_manager==""){
        $("#resultName").hide();
        $("#resultEmail").show();
        $("#resultEmail").html("please select manager for this category !");
    }else if(isNaN(id_manager)){
        $("#resultEmail").show();
        $("#resultEmail").html("invalid value for manager !");
    }else{
        $("#resultName").hide();
        $("#resultEmail").hide();
        status="valid";
        return status;
    }
}
function updateCategory(categoryName,id_manager,id){
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "updateCategory":"updateCategory",
            "categoryName":categoryName,
            "id_manager":id_manager,
            "id":id
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //$("#formResult").hide();
            //alert(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    })
}
function deleteCategory(id){
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "deleteCategory":"deleteCategory",
            "id":id
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //$("#formResult").hide();
            //alert(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}
/////------------- news -------------------////
function validateNews(title,description,id_editor,id_category){
    var status="invalid";
    if(title ==""){
        $("#resultName").show();
        $("#resultName").html("please insert news title !");
    }else if(!isNaN(title)){
        $("#resultName").show();
        $("#resultName").html("please title must be letters !");
    }else if(description==""){
        $("#resultName").hide();
        $("#resultEmail").show();
        $("#resultEmail").html("please type news description !");
    }else if(id_category==""){
        $("#resultEmail").hide();
        $("#resultPassword").show();
        $("#resultPassword").html("please select a category !");
    }else if(isNaN(id_category)){
        $("#resultPassword").show();
        $("#resultPassword").html("invalid value for category !");
    }else if(id_editor==""){
        $("#resultEmail").hide();
        $("#resultPassword").hide();
        alert("that can`t be happened !");
    }else if(isNaN(id_editor)){
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

function getAllNews(){
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "allNews":"allNews",
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $("#myNewsTbody").html(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    })
}
function deleteNews(id){
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "deleteNews":"deleteNews",
            "id":id
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    })
}
function getNewsById(id){
    $.ajax({
        type:"POST",
        url:"../lib/data.php",
        data:{
            "id_news":id
        },
        beforeSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            $(".myEditForm").html(data);
            //alert(data);
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}

function updateNews(title,description,id_editor,id_category,id){
    $.ajax({
        type:'GET',
        url:'../lib/data.php',
        data:{
            "updateNews":1,
            "title":title,
            "description":description,
            "id_editor":id_editor,
            "id_category":id_category,
            "id_news":id
        },
        beforSend:function(){
            $(".data-on-load").show();
        },
        success:function(data){
            //alert(data);
            $("#title").val("");
            $("#description").val("");
            $("#id_category").val("");
            $(".data-on-load").hide();
        },
        error:function(error){
            alert(error);
        }
    });
}
