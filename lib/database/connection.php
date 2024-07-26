<?php

  // garante que só será criada uma única instância da classe PDO
  
  abstract class Connection {

    private static $conn;

    public static function getConn() {
      if (self::$conn == null) {
        self::$conn = new PDO('mysql: host=localhost; dbname=curso_php;', 'root', 'root');
      }
      return self::$conn;
    }
  }