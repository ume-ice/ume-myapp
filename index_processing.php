<?php

  define('DB_DATABASE', 'dotinstall_db');
  define('DB_USERNAME', 'dbuser');
  define('DB_PASSWORD', 'dbuser');
  define('PDO_DNS', 'mysql:dbhost=localhost;dbname=' . DB_DATABASE);

  try {
    $db = new PDO(PDO_DNS, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $key = isset($_GET['key']) ? $_GET['key']: null;

    if($key != ""){
      $radio_option = isset($_GET['inlineRadioOptions']) ? $_GET['inlineRadioOptions']: null;
      if($radio_option == "contributor"){
        $stmt = $db->query("select * from rooms where contributor like '%{$key}%' order by created desc;");
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }elseif($radio_option == "title"){
        $stmt = $db->query("select * from rooms where title like '%{$key}%' order by created desc;");
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }elseif($radio_option = "memo"){
        $stmt = $db->query("select * from rooms where memo like '%{$key}%' order by created desc;");
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
    }else{

      $title = isset($_GET['title']) ? $_GET['title']: null;
      $contributor = isset($_GET['contributor']) ? $_GET['contributor']: null;
      if($contributor == ""){
        $contributor = "ななし";
      }

      $memo = isset($_GET['memo']) ? $_GET['memo']: null;
      if($memo == ""){
        $memo = "なし";
      }

      //$timestamp = new DateTime('', new DateTimeZone('UTC'));
/*
      date_default_timezone_set('Asia/Tokyo');

      $timestamp = new DateTime("2012-11-05 21:40:30.0000000");
      $timestamp -> setTimeZone(new DateTimeZone('Asia/Tokyo'));
      $timestamp -> format(DateTime::ISO8601);
*/

      $timestamp = time();
      $timestamp = date("Y-m-d H:i:s",strtotime("+9 hour"));
      //$timestamp = strftime("Y-m-d H:i:s", date());

      if($title != null){
        $stmt = $db->prepare("insert into rooms (contributor, title, memo, created) values (?,?,?,?)");
        $stmt->execute([$contributor, $title, $memo, $timestamp]);
        $contributor = null;
        $title = null;
        $memo = null;
      }

      $stmt = $db->query("select * from rooms order by created desc");
      $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }

  ?>
