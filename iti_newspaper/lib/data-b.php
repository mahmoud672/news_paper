<?php
//require "person.php";
require "category.php";
require "news.php";
require "news_image.php";
require "reader.php";
require_once "admin.php";
?>

<?php
    if(isset($_POST['getAllCategoryNews'],$_POST['id_category'])){
       $id=$_POST['id_category'];
       $result="";
       $categoryNews=News::getNewsByCategory($id);
       while($news=mysqli_fetch_assoc($categoryNews)){
           $result.="<option value=".$news['id'].">".$news['title']."</option>";
       }
       echo $result;
    }
    if(isset($_POST["addNewsImage"])){
        $id_news=$_POST['id_news_pho'];
        $id_photographer=$_POST['id_photographer'];
        $image_name=$_FILES['imageName']['name'];
        $tmp_image=$_FILES['imageName']['tmp_name'];
        $image_type=$_FILES['imageName']['type'];
        //$image_size=$_FILES['imageName']['size'];
        //echo $image_size/(1024*1024);
            if(is_array($image_name)){
                for($i=0;$i< count($image_name);$i++){
                    if(!($image_type[$i]=='image/jpeg' || $image_type[$i]=='image/png')) {
                        echo"image type must be jpg or png";
                    }else{
                        $news = new News_image($id_news, $id_photographer, $image_name[$i], $tmp_image[$i]);
                        $news->addNewsImage();
                    }
                }
            }else{
                $news=new News_image($id_news,$id_photographer,$image_name,$tmp_image);
                $news->addNewsImage();
            }

    }
    if(isset($_POST['getNews'])){
        $newsData=News::getNews();
        $result="";
        while($news=mysqli_fetch_assoc($newsData)){
            $result.="<option value=".$news['id'].">".$news['title']."</option>";
        }
        echo $result;
    }
    if(isset($_POST['phoNewsImage'])){
        $id_photographer=$_POST['id_photographer'];
        $id_news=$_POST['id_news'];
        $result="";
        $newsImages=News_image::getPhotographerNewsImages($id_news,$id_photographer);

        if($newsImages->num_rows >0){
            while($newsImage=mysqli_fetch_assoc($newsImages)){
                    $result .= "<tr>
                    <td><img src='../upload/" . $newsImage['image_name'] . "'class='imageTable'></td>
                    <td><button data-id='" . $newsImage['image_name'] . "'class='deleteNewsImage btn btn-danger'>delete</button></td>   
                    <td><button data-id='" . $newsImage['image_name'] . "'class='editNewsImage btn btn-primary'>edit</button></td> 
            </tr>";
            }
        }else {
            $result= "<tr><td colspan='3'>there is(r) no image(s) please add image(s) for this news !</td></tr>";
        }
        echo $result;
    }
    if(isset($_POST['deletPhoNewsImage'])){
        $id_photographer=$_POST['id_photographer'];
        $id_news=$_POST['id_news'];
        $image_name=$_POST['imageName'];
        if(News_image::deleteNewsImage($id_news,$id_photographer,$image_name)){
            echo"successful deleting";
        }else{
            echo"error in deleting";
        }
        //echo $id_photographer ." ".$id_news." ".$image_name;
    }
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $loginResult=Person::login($email,$password);
        if($loginResult->num_rows > 0){
            $login=mysqli_fetch_row($loginResult);
            //echo $login[0]." ".$login[1]." ".$login[2]." ".$login[4];
            session_start();
            $_SESSION['id']=$login[0];
            $_SESSION['name']=$login[1];
            $_SESSION['email']=$login[2];
            $_SESSION['job_type']=$login[4];
            $res="";
            if($_SESSION['job_type']=='editor'){
                $res='editor';
            }elseif($_SESSION['job_type']=='photographer'){
                $res='photographer';

            }elseif($_SESSION['job_type']=='admin'){
                $res='admin';
            }elseif($_SESSION['job_type']=='reader'){
                $res='reader';
            }
            echo json_encode(array("job_type"=>$res));

        }else{
            echo"no data exist !";
        }
    }
    if(isset($_POST['logout'])){
        if(session_start()){
            session_destroy();
        }
    }

    if(isset($_POST['register'])){
        $name=$_POST['name'];
        //echo $name;
        $emai=$_POST['email'];
        $password=$_POST['password'];
        $job_type=$_POST['job_type'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        if($job_type=='reader'){
            $reader=new Reader($name,$emai,$password,$job_type,$address,$phone);
            if($reader->addReader()){
                echo"added successfully";
            }else{
                echo"error in adding";
            }
        }

    }
    if(isset($_POST['fillSliderNews'])){
        $limit=8;
        $sliderNews=News::getLastNews($limit);
        if($sliderNews->num_rows >0){
            while($sliderNew=mysqli_fetch_assoc($sliderNews)){
                echo '<div class="sliderNewsBlock">
                        <div class="newsHead">
                            <h5 data-id="'.$sliderNew['id'].'">'.$sliderNew['title'].'</h5>
                        </div>';
                $newsImages=News_image::getImagesByNews($sliderNew['id']);
                if($newsImages->num_rows >0){
                    while($newsImage=mysqli_fetch_assoc($newsImages)){
                        echo'<img src="../upload/'.$newsImage['image_name'].'" alt=""class="newsBlock-image">';
                    }
                }else{
                    echo "there is(r) no image(s)";
                }
                      echo'</div>';
            }
        }else{
            echo "there are no data for your limit";
        }
    }
if(isset($_POST['fillMostRecentlyNews'])){
    $limit=4;
    $mostRecentlyNews=News::getLastNews($limit);
    if($mostRecentlyNews->num_rows >0){
        while($mostRecentlyNew=mysqli_fetch_assoc($mostRecentlyNews)){
            echo'<div class="mostRecentlyNewsBlock">

                <div class="mostRecentlyNewsImage">';
            $newsImages=News_image::getImagesByNews($mostRecentlyNew['id']);
            if($newsImages->num_rows >0){
                while($newsImage=mysqli_fetch_assoc($newsImages)){
                    echo'<img src="../upload/'.$newsImage['image_name'].'" alt=""class="newsBlock-image">';
                }
            }else{
                echo "there is(r) no image(s)";
            }
            echo'</div>
                <div class="mostRecentlyNewsTitle">
                    <h4>'.$mostRecentlyNew['title'].'</h4>
                </div>

                <div class="mostRecentlyNewsDescription">
                    <p>'.$mostRecentlyNew['description'].'</p>
                </div>
            </div>

                ';
        }
    }else{
        echo '<div class="mostRecentlyNewsBlock">

                <div class="mostRecentlyNewsImage">
                    <img src="template/images/newspaper-595478_960_720.jpg" alt="">
                    <img src="template/images/newspaper-595478_960_720.jpg" alt="">
                </div>
                <div class="mostRecentlyNewsTitle">
                    <h4>title goes here</h4>
                </div>

                <div class="mostRecentlyNewsDescription">
                    <p>description goes hereeeeeeeeeeeeeeeeeeeeeeeee</p>
                </div>
            </div>
            <div class="mostRecentlyNewsBlock">
                <div class="mostRecentlyNewsImage">
                    <img src="template/images/coffee-791439_960_720.jpg" alt="">
                </div>
                <div class="mostRecentlyNewsTitle">
                    <h4>title goes here</h4>
                </div>

                <div class="mostRecentlyNewsDescription">
                    <p>description goes hereeeeeeeeeeeeeeeeeeeeeeeee</p>
                </div>';
    }
}
    if(isset($_POST['fillMenuewithCategory'])){
        $categories=Category::getCategories();
        $result="";
        if($categories->num_rows >0){
            while($category=mysqli_fetch_assoc($categories)){
                $result.='<div class="list_head " data-id="'.$category['id'].'">
                        <h3 >'.$category['name'].'</h3>
                    </div>
                ';
            }
            $result.='<div class="trick"><img  id="all-n" src="template/images/newspaper-background-hd-5.jpg"></div>';
            echo $result;
        }else{
            echo 'there is(r) no category(ies)';
        }
    }
    if(isset($_POST['getAllNewsInCategoryPageUsingCategory'])){
        $id=$_POST['id_category'];
        $category=Category::getCategory($id);
        $categoryData=mysqli_fetch_assoc($category);
        $result="<h5> All ".$categoryData['name']." news</h5>";
        $allNews=News::getNewsByCategory($id);
        if($allNews->num_rows >0){
            while($news=mysqli_fetch_assoc($allNews)){
                $result.=' <div class="newsBlock">
                        <div class="newsBlockTitle">
                            <h4>'.$news['title'].'</h4>
                        </div>
                        <div class="newsBlockImage">';
                $newsImages=News_image::getImagesByNews($news['id']);
                if($newsImages->num_rows >0){
                    while($newsImage=mysqli_fetch_assoc($newsImages)){
                        $result.='<img src="../upload/'.$newsImage['image_name'].'" alt=""class="newsBlock-image">';
                    }

                }else{
                    $result.= "there is(r) no image(s)";
                }

                $result.='</div>
                        <div class="newsBlockDescription">
                            <p>'.$news['description'].'</p>
                        </div>
                    </div>
                ';

            }
            echo $result;
        }else{
            echo"there is(r) no news";
        }
    }
    if(isset($_POST['getAllNewsInReaderPage'])){
        $newsData=News::getNews();
        if($newsData->num_rows >0){
            while($news=mysqli_fetch_assoc($newsData)){
                echo' <div class="newsBlock">
                        <div class="newsBlockTitle">
                            <h4>'.$news['title'].'</h4>
                        </div>
                        <div class="newsBlockImage">';
                            $newsImages=News_image::getImagesByNews($news['id']);
                            if($newsImages->num_rows >0){
                                while($newsImage=mysqli_fetch_assoc($newsImages)){
                                    echo'<img src="../upload/'.$newsImage['image_name'].'" alt=""class="newsBlock-image">';
                                }
                            }else{
                                echo "there is(r) no image(s)";
                            }

                        echo'</div>
                        <div class="newsBlockDescription">
                            <p>'.$news['description'].'</p>
                        </div>
                    </div>
                ';

            }
        }else{
            echo'<div class="newsBlock">
                <div class="newsBlockTitle">
                    <h4>'.$news['title'].'</h4>
                </div>
                <div class="newsBlockImage">
                    <img src="../upload/1558794783eminem2.jpg" alt=""class="newsBlock-image">
                    <img src="../upload/1558794783eminem2.jpg" alt=""class="newsBlock-image">
                </div>
                <div class="newsBlockDescription">
                    <p>decription goes here</p>
                </div>
               </div>';
        }
    }

    //------ to dispaly current data

if(isset($_POST['display_current_data'])){
        $id=$_POST['id_current'];
        $job_type=$_POST['job_type'];
        $email=$_POST['email'];
        //echo $id ;
        $name="";
        $password="";
        $address="";
        $phone="";
        $result="";
    if($job_type=='reader'){
        $reader=Reader::getPerson("reader",$id);
        $readerData=mysqli_fetch_assoc($reader);
        if(is_array($readerData)){
            $name=$readerData['name'];
            $password=$readerData['password'];
            $address=$readerData['address'];
            $phone=$readerData['phone'];
        }else{
            echo"there is no data";
        }
    }elseif($job_type=='admin'){
            $admin=Admin::getPerson("admin",$id);
            $adminData=mysqli_fetch_assoc($admin);
            if(is_array($adminData)){
                $name=$adminData['name'];
                $password=$adminData['password'];
                $address=$adminData['address'];
                $phone=$adminData['phone'];
            }else{
                echo"there is no data";
            }
    }else{
        $employee=Person::getPerson("employee",$id);
        $employeeData=mysqli_fetch_assoc($employee);
        if(is_array($employeeData)){
            $name=$employeeData['name'];
            $password=$employeeData['password'];
            $address=$employeeData['address'];
            $phone=$employeeData['phone'];
        }else{
            echo"there is no data";
        }
    }
    //$data=array("id"=>$id,"name"=>$name,"email"=>$email,"password"=>$password,"address"=>$address,"phone"=>$phone);
    //echo json_encode($data);
    $result.='<form action=""method="post" >
                <div class="form-group">
                    <label for="name">your name</label>
                    <input type="text"name="currentName"id="currentName"value="'.$name.'"class="form-control"required>
                </div>

                    <h5 id="resultName"class="r"></h5>

                <div class="form-group">
                    <label for="email">your email</label>
                    <input type="text"name="currentEmail"id="currentEmail"value="'.$email.'"class="form-control"required="required">
                </div>

                    <h5 id="resultEmail"class="r"></h5>

                <div class="form-group">
                    <label for="password">current password</label>
                    <input type="password"name="currentPassword"id="currentPassword"value=""class="form-control"required>
                </div>
                <h5 id="resultPassword"class="r"></h5>
                <div class="form-group">
                    <label for="password">retype password</label>
                    <input type="password"name="newPassword"id="newPassword"value=""class="form-control"required>
                    <h5 id="resultJob_type"class="r"></h5>
                </div>
                <div class="form-group">
                    <label for="address">your address</label>
                    <input type="text"name="currentAddress"id="currentAddress"value="'.$address.'"class="form-control"required>
                </div>
                <h5 id="resultAddress"class="r"></h5>
                <div class="form-group">
                    <label for="phone">your phone</label>
                    <input type="text"name="currentPhone"id="currentPhone"value="'.$phone.'"class="form-control"required>
                </div>
                <h5 id="resultPhone"class="r"></h5>
                <input type="hidden"name="currentId"id="currentId"value="'.$id.'"class="form-control"required>
                <input type="hidden"name="password"id="password"value="'.$password.'">
                <input type="submit"name="updateProfile"value="update"class="btn btn-danger"id="updateProfile">
            </form>
    ';
    echo $result;

}
if(isset($_POST['updateCurrentPersonData'])){
    $id=$_POST['id'];
    $name=$_POST['name'];
    //echo $id;
    $email=$_POST['email'];
    $password=$_POST['passwordNew'];
    $job_type=$_POST['job_type'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];
    //echo $id." ".$name." ".$email." ".$job_type." ".$password." ".$address." ".$phone;
    if($job_type=='reader'){
        $reader=new Reader($name,$email,$password,$job_type,$address,$phone,$id);
        $reader->updateReader();
    }elseif($job_type=='admin'){
        $admin=new Admin($name,$email,$password,$job_type,$address,$phone,$id);
        $admin->updateAdmin();
    }else{
        $person=new Person($name,$email,$password,$job_type,$address,$phone,$id);
        $person->updatePerson();
    }
}
/*echo'<div class="mostRecentlyNewsBlock">

                <div class="mostRecentlyNewsImage">';
                $newsImages=News_image::getImagesByNews($news['id']);
                if($newsImages->num_rows >0){
                    while($newsImage=mysqli_fetch_assoc($newsImages)){
                        echo'<img src="../upload/'.$newsImage['image_name'].'" alt=""class="newsBlock-image">';
                    }
                }else{
                    echo "there is(r) no image(s)";
                }
                echo'</div>
                <div class="mostRecentlyNewsTitle">
                    <h4>title goes here</h4>
                </div>

                <div class="mostRecentlyNewsDescription">
                    <p>'.$news['description'].'</p>
                </div>
            </div>

                ';*/
?>
