<?php
session_start();

include '../koneksi.php';

try {
    if (isset($_POST["login"])) {
        if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM data_masuk WHERE no_daftar = :username AND password = :password";  
                $statement = $koneksi->prepare($query);  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["username"] = $_POST["username"];  
                     header("location:profil.php");  
                }  
                else  
                {  
                     $message = '<label>Username atau password salah!</label>';  
                }  
           }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}