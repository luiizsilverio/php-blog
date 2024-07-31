<?php 

  require_once "lib/database/connection.php";
  require_once "app/model/comment.php";
  require_once "lib/util.php";

  class Post {

    public static function getAll() {
      try {
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
      catch (Exception $e) {
        throw new Exception("Falha ao buscar as publicações");
      }
    }

    public static function getById($idPost) {
      try {
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
      catch (Exception $e) {
        throw new Exception("Falha ao buscar a publicação");
      }
    }

    public static function insert($data) {
      if (empty($data['titulo']) || empty($data['conteudo'])) {
        throw new Exception("Preencha todos os campos");
      }
      
      $conn = Connection::getConn();
      $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)";
      $query = $conn->prepare($sql);
      $query->bindValue(':tit',  $data['titulo']);
      $query->bindValue(':cont', $data['conteudo']);
      $result = $query->execute();

      if ($result == 0) {
        throw new Exception();
      }
      return $result;      
    }

    public static function update($data) {
      if (empty($data['titulo']) || empty($data['conteudo'])) {
        throw new Exception("Preencha todos os campos");
      }
      
      $conn = Connection::getConn();
      $sql = "UPDATE postagem set titulo = :tit, conteudo = :cont WHERE id = :id";
      $query = $conn->prepare($sql);
      $query->bindValue(':id',   $data['id'], PDO::PARAM_INT);
      $query->bindValue(':tit',  $data['titulo']);
      $query->bindValue(':cont', $data['conteudo']);
      $result = $query->execute();

      if ($result == 0) {
        throw new Exception();
      }
      return $result;      
    }

    public static function delete($idPost) {
      try {
        $conn = Connection::getConn();
        $sql = "DELETE FROM postagem WHERE id = :id";
        $query = $conn->prepare($sql);
        $query->bindValue(':id', $idPost, PDO::PARAM_INT);
        $result = $query->execute();

        if ($result == 0) {
          throw new Exception();
        }
        return $result; 
      }
      catch (Exception $e) {
        throw new Exception();
      }
    }

  }