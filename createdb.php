<?php

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
    public function getData(){
        $sql= "SELECT * FROM $this->tablename";
        $result=mysqli_query($this->con,$sql);

        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }
}



