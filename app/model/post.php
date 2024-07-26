<?php include "lib/database/connection.php";

  class Post {

    public static function getAll() {
      $conn = Connection::getConn();

      var_dump($conn);
    }
  }