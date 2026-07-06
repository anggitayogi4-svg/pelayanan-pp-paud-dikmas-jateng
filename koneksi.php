<?php

$host="localhost";

$user="root";

$password="";

$database="db_paud_dikmas";

$koneksi=mysqli_connect($host,$user,$password,$database);

if(!$koneksi){

die("Koneksi gagal");

}

?>