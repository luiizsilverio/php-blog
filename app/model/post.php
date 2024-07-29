<?php 

  require_once "lib/database/connection.php";
  require_once "app/model/comment.php";
  // require_once "lib/util.php";

  class Post {

    public static function getAll() {
      $conn = Connection::getConn();

      $sql = "SELECT * FROM postagem ORDER BY id DESC";
      $query = $conn->prepare($sql);
      $query->execute();

      $result = array();
      while ($row = $query->fetchObject('Post')) {  // fetchObject busca o próximo registro e converte em objeto
        $row->comentarios = Comment::getTotal($row->id);
        $result[] = $row;
      }

      if (!$result) {
        throw new Exception("Não foi encontrada nenhuma publicação");
      }
      return $result;
    }

    public static function getById($idPost) {
      $conn = Connection::getConn();

      $sql = "SELECT * FROM postagem WHERE id = :id";
      $query = $conn->prepare($sql);
      $query->bindValue(':id', $idPost, PDO::PARAM_INT);
      $query->execute();

      $result = $query->fetchObject('Post');

      if ($result) {
        $result->comentarios = Comment::getAll($idPost);
      }
      return $result;
    }
  }