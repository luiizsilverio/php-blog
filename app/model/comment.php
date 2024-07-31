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

    public static function getTotal($idPost) {
      $conn = Connection::getConn();

      $sql = "SELECT COUNT(*) AS qtd FROM comentario WHERE id_postagem = :id";
      $query = $conn->prepare($sql);
      $query->bindValue(':id', $idPost, PDO::PARAM_INT);
      $query->execute();

      $result = $query->fetchObject('Comment');
      return $result->qtd;
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
    
    public static function insert($data) {
      if (empty($data['nome']) || empty($data['msg'])) {
        throw new Exception("Preencha todos os campos");
      }
      if (empty($data['id'])) {
        throw new Exception("Publicação não localizada");
      }

      $conn = Connection::getConn();
      $sql = "INSERT INTO comentario (nome, mensagem, id_postagem) VALUES (:nome, :msg, :id)";
      $query = $conn->prepare($sql);
      $query->bindValue(':nome',  $data['nome']);
      $query->bindValue(':msg', $data['msg']);
      $query->bindValue(':id', $data['id']);
      $result = $query->execute();

      // if ($sql->rowCount()) return true;
      if ($result == 0) {
        throw new Exception();
      }
      return $result;      
    }
  }