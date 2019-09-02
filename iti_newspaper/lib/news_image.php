<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud
 * Date: 25/05/2019
 * Time: 12:41 م
 */
require "dbc.php";
class News_image{
    private $id_news;
    private $id_photographer;
    private $image_name;
    private $tmp_image;

    public function __construct($id_news,$id_photographer,$image_name,$tmp_image){
        $this->id_news=$id_news;
        $this->id_photographer=$id_photographer;
        $this->image_name=$image_name;
        $this->tmp_image=$tmp_image;
    }
    public function addNewsImage(){
        if(is_uploaded_file($this->tmp_image)){
            $this->image_name=time().$this->image_name;
            if(move_uploaded_file($this->tmp_image,"../upload/".$this->image_name)){
                global $dbc;
                $query="insert into news_image(id_news,id_photographer,image_name)values('$this->id_news','$this->id_photographer','$this->image_name')";
                $result=mysqli_query($dbc,$query);
            }
        }

    }
    public static function getPhotographerNewsImages($id_news,$id_photographer){
        global $dbc;
        $query="select * from news_image where id_news=$id_news and id_photographer=$id_photographer ";
        $result=mysqli_query($dbc,$query);
        return $result;
    }
    public static function getPhotographerNewsImage($id_news,$id_photographer,$image_name){
        global $dbc;
        $query="select * from news_image where id_news=$id_news and id_photographer=$id_photographer and image_name=$image_name ";
        $result=mysqli_query($dbc,$query);
        return $result;
    }
    public static function getImagesByNews($id_news){
        global $dbc;
        $query="select * from news_image where id_news=$id_news ";
        $result=mysqli_query($dbc,$query);
        return $result;
    }
    public static function deleteNewsImage($id_news,$id_photographer,$image_name){
        global $dbc;
        $query="delete from news_image where id_news='$id_news' and id_photographer='$id_photographer' and image_name='$image_name' ";
        if($result=mysqli_query($dbc,$query)){
            return true;

        }else{
            return false;
        }
    }
    public function updateNewsImage(){
        if(is_uploaded_file($this->tmp_image)){
            $this->image_name=time().$this->image_name;
            if(move_uploaded_file($this->tmp_image,"../upload/".$this->image_name)){
                global $dbc;
                $query="update news_image set image_name='$this->image_name'where id_news='$this->id_news'and id_photographer='$this->id_photographer' and image_name='$this->image_name'";
                if(mysqli_query($dbc,$query)){
                    return true;
                }
            }
        }

    }
}