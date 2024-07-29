<?php 

  require_once "lib/database/connection.php";

  class Comment {

    public static function getAll($idPost) {
      $conn = Connection::getConn();

      $sql = "SELECT * FROM comentario WHERE id_postagem = :id ORDER BY id DESC";
      $query = $conn->prepare($sql);
      $query->bindValue(':id', $idPost, PDO::PARAM_INT);
      $query->execute();

      $result = array();
      while ($row = $query->fetchObject('Comment')) {  // fetchObject busca o próximo registro e converte em objeto
        $result[] = $row;
      }

      return $result;
    }

    public static function getById($id) {
      $conn = Connection::getConn();

      $sql = "SELECT * FROM comentario WHERE id = :id";
      $query = $conn->prepare($sql);
      $query->bindValue(':id', $id, PDO::PARAM_INT);
      $query->execute();

      $result = $query->fetchObject('Comment');
      return $result;
    }
  }