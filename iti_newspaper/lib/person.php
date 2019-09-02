<?php
    require "dbc.php";

    class Person{
        public $id;
        public $name;
        public $email;
        public $password;
        public $job_type;
        public $address;
        public $phone;

        public function __construct($name,$email,$password,$job_type,$address,$phone,$id=""){
            $this->name=$name;
            $this->email=$email;
            $this->password=$password;
            $this->job_type=$job_type;
            $this->address=$address;
            $this->phone=$phone;
            $this->id=(int)$id;
        }
        public function addPerson(){
            global $dbc;
            $query="insert into employee(name,email,password,job_type,address,phone)values('$this->name','$this->email','$this->password','$this->job_type','$this->address','$this->phone')";
            if(mysqli_query($dbc,$query)){
                return true;
            }
        }
        public static function getPersons($tableName){
            global $dbc;
            $query="select * from $tableName ";
            $result=mysqli_query($dbc,$query);
            return $result;
        }
        public static function getPerson($tableName,$id){
            global $dbc;
            $query="select * from $tableName where id=$id";
            $result=mysqli_query($dbc,$query);
            return $result;
        }
        public static function deletePerson($tableName,$id){
            global $dbc;
            $query="delete from $tableName where id=$id";
            $result=mysqli_query($dbc,$query);
        }
        public function updatePerson(){
            global $dbc;
            $query="update employee set name='$this->name',email='$this->email',password='$this->password',job_type='$this->job_type',address='$this->address',phone=$this->phone where id=$this->id ";
            if(mysqli_query($dbc,$query)){
                return true;
            }
        }
        public static function getPersonName($tableName,$id){
            global $dbc;
            $query="select name from $tableName where id=$id";
            $result=mysqli_query($dbc,$query);
            $row=mysqli_fetch_row($result);
            return $row[0];
        }
        public static function login($email,$password){
            global $dbc;
            //$query="";
            $query="select * from employee where email='$email' and password='$password' ";

            $result=mysqli_query($dbc,$query);
            if($result->num_rows <1){
                $quer="select * from reader where email='$email' and password='$password' ";
                $result=mysqli_query($dbc,$quer);
                if($result->num_rows <1){
                    $que="select * from admin where email='$email' and password='$password' ";
                    $result=mysqli_query($dbc,$que);
                }
            }
            return $result;
        }
    }


    /*$person =new Person("ahmed","sdfdfd","dddddddddd","editor","faisel","01010010101");
    if($person->addPerson()){
        echo "successfull ading";
    }*/
    /*$result=Person::getPersons("employee");
    while($row=mysqli_fetch_assoc($result)){
        echo $row['name']." ".$row['id'];
    }*/
//echo Person::getPersonName("employee",1);

?>