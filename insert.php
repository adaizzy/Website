<?php
// handler.php
// handle comment posts, saving to MySQL and redirecting back to the list
require_once "Dao.php";

 // if (isset($_POST["songName"])) {
    $songname = $_POST["songName"];
  //}
  //if (isset($_POST["artist"])){
    $artist = $_POST["artist"];
  //}  
    try {
      $dao = new Dao();
      $dao->saveSong($_SESSION['emailLogin'],$songname,$artist);
    } catch (Exception $e) {
      var_dump($e);
      die;
    }
  header("Location:./fullsonglist.php");
?>