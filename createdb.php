<?php
session_start();

$kategoria=$_SESSION['kategoria'];

class CreateDB
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;


public function __construct(
    $dbname="szopi",
    $tablename="produkty",
    $servername="localhost",
    $username="root",
    $password="",
)
{
    $this->dbname=$dbname;
    $this->tablename = $tablename;
    $this->servername = $servername;
    $this->username = $username;
    $this->password = $password;


    $this->con=mysqli_connect($servername,$username,$password);


    if(!$this->con){
        die("Polaczenie nie udane".mysqli_connect_error());
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";


    if(mysqli_query($this->con,$sql)){
        $this->con = mysqli_connect($servername,$username,$password,$dbname);

        $sql= "CREATE TABLE IF NOT EXISTS $tablename
        (  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nazwa VARCHAR(50),
            kategoria VARCHAR(50),
            cena FLOAT,
            stan VARCHAR(20),
            cene2 FLOAT,
            obrazek VARCHAR(300)

        )";
        if(!mysqli_query($this->con,$sql)){
            echo "BŁĄD".mysqli_error($this->con);
        }

        
        }else{
            return false;
        }
    }
    // $kategoria=$_SESSION['kategoria'];
    public function getData( $kategoria){
        $sql= "SELECT * FROM $this->tablename WHERE kategoria='$kategoria' ";
        $result=mysqli_query($this->con,$sql);

        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }
    
    public function getData2($kategoria){
        $sql= "SELECT * FROM $this->tablename WHERE kategoria='$kategoria'order by cena ";
        $result=mysqli_query($this->con,$sql);

        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }
    public function getData3($kategoria){
        $sql= "SELECT * FROM $this->tablename WHERE kategoria='$kategoria' order by cena desc";
        $result=mysqli_query($this->con,$sql);

        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }
    public function getData4( ){
        $sql= "SELECT * FROM $this->tablename  ";
        $result=mysqli_query($this->con,$sql);

        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }
    public function getData5( ){
        $sql= "SELECT * FROM $this->tablename where stan='promocja'  ";
        $result=mysqli_query($this->con,$sql);

        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }
}



