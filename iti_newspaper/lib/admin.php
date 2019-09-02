<?php
    require_once "person.php";
class Admin extends Person{
    public function addAdmin(){
        global $dbc;
        $query="insert into admin(name,email,password,address,phone)values('$this->name','$this->email','$this->password','$this->address','$this->phone')";
        if(mysqli_query($dbc,$query)){
            return true;
        }
    }
    public function updateAdmin(){
        global $dbc;
        $query="update admin set name='$this->name', email='$this->email', password='$this->password',address='$this->address',phone='$this->phone'where id=$this->id";
        if(mysqli_query($dbc,$query)){
            return true;
        }
    }

}

/*$re=new Reader("shady","xss","ss","jlllll","haram",01010101010);
$re->addReader();*/