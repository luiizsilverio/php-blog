<?php include "lib/database/connection.php";

  class Post {

    public static function getAll() {
      $conn = Connection::getConn();

      $sql = "SELECT * FROM postagem ORDER BY id DESC";
      $query = $conn->prepare($sql);
      $query->execute();

      $result = array();
      while ($row = $query->fetchObject('Post')) {  // fetchObject busca o próximo registro e converte em objeto
        $result[] = $row;
      }

      if (!$result) {
        throw new Exception("Não foi encontrada nenhuma publicação");
      }
      return $result;
    }
  }