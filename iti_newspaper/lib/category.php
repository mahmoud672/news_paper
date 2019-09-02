<?php
    require "dbc.php";
class Category{
    private $id;
    private $name;
    private $id_manager;
    public function __construct($name,$id_manager,$id=""){
        $this->name=$name;
        $this->id_manager=$id_manager;
        $this->id=$id;
    }
    public function addCategory(){
        global $dbc;
        $query="insert into category(name,id_manager)values('$this->name','$this->id_manager')";
        if(mysqli_query($dbc,$query)){
            return true;
        }
    }
    public static function getCategories(){
        global $dbc;
        $query="select * from category";
        $result=mysqli_query($dbc,$query);
        return $result;
    }
    public static function getCategory($id){
        global $dbc;
        $query="select * from category where id=$id";
        $result=mysqli_query($dbc,$query);
        return $result;
    }
    public static function deleteCategory($id){
        global $dbc;
        $query="delete from category where id=$id";
        $result=mysqli_query($dbc,$query);

    }
    public function updateCategory(){
        global $dbc;
        $query="update category set name='$this->name' ,id_manager='$this->id_manager' where id='$this->id'";
        if(mysqli_query($dbc,$query)){
            return true;
        }
    }
    public static function getCategoryName($id){
        global $dbc;
        $query="select name from category where id=$id";
        $result=mysqli_query($dbc,$query);
        $row=mysqli_fetch_row($result);
        return $row[0];
    }
}