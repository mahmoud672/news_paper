<?php
    require "dbc.php";

    class News{
        public $id;
        public $title;
        public $description;
        public $id_editor;
        public $id_category;

        public function __construct($title,$description,$id_editor,$id_category,$id=""){
            $this->title=$title;
            $this->description=$description;
            $this->id_editor=$id_editor;
            $this->id_category=$id_category;
            $this->id=$id;
        }
        public function addNews(){
            global $dbc;
            $query="insert into news(title,description,id_editor,id_category)values('$this->title','$this->description','$this->id_editor','$this->id_category')";
            if(mysqli_query($dbc,$query)){
                return true;
            }
        }
        public static function getNews(){
            global $dbc;
            $query="select * from news";
            $result=mysqli_query($dbc,$query);
            return $result;
        }
        public static function getOnlyNews($id){
            global $dbc;
            $query="select * from news where id=$id";
            $result=mysqli_query($dbc,$query);
            return $result;
        }
        public static function deleteNews($id){
            global $dbc;
            $query="delete from news where id=$id";
            $result=mysqli_query($dbc,$query);
        }
        public function updateNews(){
            global $dbc;
            $query="update news set title='$this->title',description='$this->description',id_editor='$this->id_editor',id_category='$this->id_category' where id=$this->id ";
            if(mysqli_query($dbc,$query)){
                return true;
            }
        }
        public static function getNewsByCategory($id_category){
            global $dbc;
            $query="select * from news where id_category=$id_category";
            $result=mysqli_query($dbc,$query);
            return $result;
        }
        public static function getLastNews($limit){
            global $dbc;
            $query="select * from news order by id desc limit $limit";
            $result=mysqli_query($dbc,$query);
            return $result;
        }
    }



?>