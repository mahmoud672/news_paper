<?php
/*class Dbc{
    public static $conn;
    public static function dbConnection(){
        Dbc::$conn=mysqli_connect("localhost","root","","iti_newspaper");
        if(!Dbc::$conn){
            echo "error";
        }else{
            //echo "connected";
            //return $conn;
        }

        }
}
*/
$dbc=mysqli_connect("localhost","root","","iti_newspaper");
//Dbc::dbConnection();