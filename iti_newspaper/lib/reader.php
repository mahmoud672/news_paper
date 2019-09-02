<?php
    require_once "person.php";
class Reader extends Person{
    public function addReader(){
        global $dbc;
        $query="insert into reader(name,email,password,address,phone)values('$this->name','$this->email','$this->password','$this->address','$this->phone')";
        if(mysqli_query($dbc,$query)){
            return true;
        }
    }
    public function updateReader(){
        global $dbc;
        $query="update reader set name='$this->name', email='$this->email', password='$this->password',address='$this->address',phone='$this->phone'where id=$this->id";
        if(mysqli_query($dbc,$query)){
            return true;
        }
    }

}

/*$re=new Reader("shady","xss","ss","jlllll","haram",01010101010);
$re->addReader();*/