<?php
require "person.php";
require "category.php";
require "news.php";

if(isset($_POST['addEmployee'])){
    $name=$_POST['name'];
    //echo $name;
    $emai=$_POST['email'];
    $password=$_POST['password'];
    $job_type=$_POST['job_type'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];

    $employee=new Person($name,$emai,$password,$job_type,$address,$phone);
    $employee->addPerson();

}elseif(isset($_POST['allEmployees'])){
    $allEmployees=Person::getPersons("employee");
    $result="";
    while($employee=mysqli_fetch_assoc($allEmployees)){
        //echo $employee['name'];
        $result.="<tr>
             <td>".$employee['name']."</td>
             <td>".$employee['email']."</td>     
             <td>".$employee['job_type']."</td>   
             <td>".$employee['address']."</td>   
             <td>".$employee['hire_date']."</td>   
             <td>".$employee['phone']."</td>   
             <td><button data-id='".$employee['id']."'class='deleteEmployee btn btn-danger'>delete</button></td>   
             <td><button data-id='".$employee['id']."'class='editEmployee btn btn-primary'>edit</button></td>   
        </tr>";
    }
    echo $result;
    //---------------edit employee
}elseif(isset($_POST["id_employee"])){
    $id=$_POST["id_employee"];
    //echo $id;
    $employee=Person::getPerson("employee",$id);
    $row=mysqli_fetch_row($employee);
    $result="<img src='template/images/close.ico'class='close_window'>
        <form action=''method='post'>
            <div class='form-group'>
                    <label for='name'>user name</label>
                    <input type='text'name='name'id='name'value='$row[1]'class='form-control'required>
                </div>

                    <h5 id='resultName'class='r'>insert name</h5>

                <div class='form-group'>
                    <label for='email'>user email</label>
                    <input type='text'name='email'id='email'value='$row[2]'class='form-control'required>
                </div>

                    <h5 id='resultEmail'class='r'>insert eamil</h5>

                <div class='form-group'>
                    <label for='password'>user password</label>
                    <input type='password'name='password'id='password'value='$row[3]'class='form-control'required>
                </div>
                <h5 id='resultPassword'class='r'>insert password</h5>
                <div class='form-group'>
                    <label for='job_type'>user job type</label>
                    <select name='job_type' id='job_type' class='form-control'required>
                    ";
    if($row[4]=="editor"){
        $result.="<option value='editor'selected>Editor</option>
                                  <option value='photographer'>Photographer</option>  
                        ";
    }else{
        $result.="<option value='editor'>Editor</option>
                                  <option value='photographer'selected>Photographer</option>  
                        ";
    }
    $result.="</select>
                    <h5 id='resultJob_type'class='r'>select job type</h5>
                </div>
                <div class='form-group'>
                    <label for='address'>user address</label>
                    <input type='text'name='address'id='address'value='$row[5]'class='form-control'required>
                </div>
                <h5 id='resultAddress'class='r'>insert address</h5>
                <div class='form-group'>
                    <label for='phone'>user phone</label>
                    <input type='text'name='phone'id='phone'value='$row[7]'class='form-control'required>
                </div>
                <h5 id='resultPhone'class='r'>insert phone</h5>
                <input type='hidden'name='id'id='id'value='$row[0]'class='form-control'>
                <input type='submit'name='updateEmployee'value='update employee'class='btn btn-danger'id='updateEmployee'>
    </form>";

    //$result.="";
    echo $result;
}elseif(isset($_POST['updateEmplopyee'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    //echo $id;
    $emai=$_POST['email'];
    $password=$_POST['password'];
    $job_type=$_POST['job_type'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];

    $employee=new Person($name,$emai,$password,$job_type,$address,$phone,$id);
    if($employee->updatePerson()){
        echo"updated";
    }else{
        echo"error in updating";
    }
}elseif (isset($_POST['deleteEmployee'])){
    $id=$_POST["id"];
    Person::deletePerson("employee",$id);
    //echo $id;
}elseif(isset($_POST['allEmployeesData'])){
    $data=Person::getPersons("employee");
    //echo $data;
    $result="";
    while($employee=mysqli_fetch_assoc($data)){
        $result.="<option value=".$employee['id'].">".$employee['name']."</option>";
    }
    echo $result;
    //---------- add category --------------------//
}elseif(isset($_POST['addCategory'])){
    $name=$_POST['categoryName'];
    $id_manager=$_POST['id_manager'];
    $category=new Category($name,$id_manager);

    if($category->addCategory()){
        echo"data added successfuly";
    }else{
        echo "error in adding ";
    }
//---------- get all categories -----------//
}elseif(isset($_POST["allCategories"])){
    $categories=Category::getCategories();
    $result="";
    while($category=mysqli_fetch_assoc($categories)){
        $result.="<tr>
                    <td>".$category['name']."</td>
                    <td>".Person::getPersonName('employee',$category['id_manager'])."</td>
                    <td>".$category['creation_date']."</td>
                    <td><button data-id='".$category['id']."'class='deleteCategory btn btn-danger'>delete</button></td>   
                    <td><button data-id='".$category['id']."'class='editCategory btn btn-primary'>edit</button></td>             
                  </tr>";
    }
    echo $result;
}elseif(isset($_POST['id_category'])){
    $id=$_POST['id_category'];
    $categoryData=Category::getCategory($id);
    $category=mysqli_fetch_row($categoryData);
    $result="<img src='template/images/close.ico'class='close_window'>
        <form action='editCategory.php'method='post'>
            <div class='form-group'>
                    <label for='name'>category name</label>
                    <input type='text'name='categoryName'id='categoryName'value='$category[1]'class='form-control'required>
                </div>
                    <h5 id='resultName'class='r'></h5>
                <div class='form-group'>
                    <label for='id_manager'>user email</label>
                    <select name='id_manager' id='id_manager' class='form-control'required>
                        <option value=''>------ select ------</option>";
                        $employees=Person::getPersons("employee");
                        while($employee=mysqli_fetch_assoc($employees)){
                            if($employee['id']==$category[2]){
                                $result.="<option value='".$employee['id']."'selected>".$employee['name']."</option>";
                            }else{
                                $result.="<option value='".$employee['id']."'>".$employee['name']."</option>";
                            }
                        }
                    $result.="</select>
                </div>
                    <h5 id='resultEmail'class='r'></h5>
                <input type='hidden'name='id'id='id'value='$id'class='form-control'>
                <input type='submit'name='updateCategory'value='update category'class='btn btn-danger'id='updateCategory'>
    </form>";
    echo $result;

}elseif(isset($_POST['updateCategory'])){
    $name=$_POST['categoryName'];
    $id_manager=$_POST['id_manager'];
    $id=$_POST['id'];
    $category=new Category($name,$id_manager,$id);
    if($category->updateCategory()){
        echo"updated successfuly";
    }else{
        echo"error in updating ";
    }
}elseif(isset($_POST['deleteCategory'])){
    $id=$_POST['id'];
    Category::deleteCategory($id);
}elseif(isset($_POST['allCategoriesData'])){
    $categories=Category::getCategories();
    $result="";
    while($category=mysqli_fetch_assoc($categories)){
        $result.="<option value='".$category['id']."'>".$category['name']."</option>";
    }
    echo $result;
}elseif(isset($_GET['addNews'])){
    $title=$_GET['title'];
    $description=$_GET['description'];
    $id_editor=$_GET['id_editor'];
    $id_category=$_GET['id_category'];
    $news=new News($title,$description,$id_editor,$id_category);
    if($news->addNews()){
        echo"added successfuly";
    }else{
        echo"error in adding";
    }

}elseif(isset($_POST['allNews'])){
    //echo"aaaaaaaaaaaaa";
    $allNews=News::getNews();
    $result="";
    while($news=mysqli_fetch_assoc($allNews)){
        $result.="<tr>
                    <td>".$news['title']."</td>
                    <td>".$news['description']."</td>
                    <td>".Person::getPersonName("employee",$news['id_editor'])."</td>
                    <td>".Category::getCategoryName($news['id_category'])."</td>
                    <td><button data-id='".$news['id']."'class='deleteNews btn btn-danger'>delete</button></td>   
                    <td><button data-id='".$news['id']."'class='editNews btn btn-primary'>edit</button></td>  
                  </tr>";
    }
    echo $result;
}elseif(isset($_POST['deleteNews'])){
    $id=$_POST['id'];
    News::deleteNews($id);

}elseif($_POST['id_news']){
    $id=$_POST["id_news"];
    $newsData=News::getOnlyNews($id);
    $result="";
    //while($news=mysqli_fetch_assoc($newsData)){
    $news=mysqli_fetch_row($newsData);
        $result.="<img src='template/images/close.ico'class='close_window'>
            <form action=''method='get' >
                <div class='form-group'>
                    <label for=\"title\">news title</label>
                    <input type=\"text\"name=\"title\"id=\"title\"value='".$news[1]."'class=\"form-control\"required>
                </div>

                    <h5 id=\"resultName\"class=\"r\"></h5>

                <div class=\"form-group\">
                    <label for=\"description\">news description</label>
                    <textarea name='description' id='description'class=\"form-control\">".$news[2]."</textarea>
                </div>

                    <h5 id=\"resultEmail\"class=\"r\"></h5>

                <div class=\"form-group\">
                    <label for=\"id_category\">category</label>
                    <select name=\"id_category\" id=\"id_category\"class=\"form-control\">
                        <option value=\"\">----------- select category ------------</option>";
                        $allCategories=Category::getCategories();
                        while($categories=mysqli_fetch_assoc($allCategories)){
                            if($categories['id']==$news[4]){
                                $result.="<option value='".$categories['id']."'selected>".$categories['name']."</option>";
                            }else{
                                $result.="<option value='".$categories['id']."'>".$categories['name']."</option>";
                            }
                        }

                    $result.="</select>
                </div>
                <h5 id=\"resultPassword\"class=\"r\"></h5>
                <input type='hidden'name='id_news'value='".$news[0]."'class=\"btn btn-danger\"id='id_news'>
                <input type=\"hidden\"name=\"id_editor\"value='$news[3]'class=\"btn btn-danger\"id=\"id_editor\">
                <input type=\"submit\"name='updateNews'value=\"update news\"class=\"btn btn-danger\"id='updateNews'>
            </form>
        ";
    //}
    echo $result;
}elseif(isset($_GET['updateNews'])){
    $id=$_GET['id_news'];
    $title=$_GET['title'];
    $description=$_GET['description'];
    $id_editor=$_GET['id_editor'];
    $id_category=$_GET['id_category'];
    $news=new News($title,$description,$id_editor,$id_category,$id);
    if($news->updateNews()){
        echo"updated successfuly";
    }else{
        echo"error in updating";
    }

}