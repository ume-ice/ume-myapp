<?php

  define('DB_DATABASE', 'dotinstall_db');
  define('DB_USERNAME', 'dbuser');
  define('DB_PASSWORD', 'dbuser');
  define('PDO_DNS', 'mysql:dbhost=localhost;dbname=' . DB_DATABASE);

  try {
    $db = new PDO(PDO_DNS, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $room_id =$_GET['room_id'];

    $key = isset($_GET['key']) ? $_GET['key']: null;

    if($key != ""){
      $radio_option = isset($_GET['inlineRadioOptions']) ? $_GET['inlineRadioOptions']: null;
      if($radio_option == "contributor"){
        $stmt = $db->query("select * from contents where room_id='{$room_id}' and contributor like '%{$key}%' order by created desc;");
        $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }elseif($radio_option == "comment"){
        $stmt = $db->query("select * from contents where room_id='{$room_id}' and comment like '%{$key}%' order by created desc;");
        $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
    }

    else{
      $contributor = isset($_GET['contributor']) ? $_GET['contributor']: null;
      if($contributor == ""){
        $contributor = "ななし";
      }

      $comment = isset($_GET['comment']) ? $_GET['comment']: null;

      $timestamp = time();
      $timestamp = date("Y-m-d H:i:s",strtotime("+9 hour"));

      if($comment != ""){
        $stmt = $db->prepare("insert into contents (room_id,contributor, comment, created) values (?,?,?,?)");
        $stmt->execute([$room_id,$contributor, $comment, $timestamp]);
        $contributor = "";
        $comment = "";
      }

      $stmt = $db->query("select * from contents where room_id='{$room_id}' order by created desc");
      $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $stmt = $db->query("select * from rooms where id='{$room_id}' order by created desc");
    $room_datail = $stmt->fetch(PDO::FETCH_ASSOC);



  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }


 ?>
