<?php 

  require_once "app/model/post.php";
  require_once "app/model/comment.php";

  class PostController {

    public function index() {
      try {
        if (!isset($_GET['id']))
           throw new Exception("Publicação não localizada");

        $id = $_GET['id'];
        $post = Post::getById($id);

        if (!$post)
          throw new Exception("Publicação não localizada");

        // carrega a pasta de templates e o template
        $loader = new Twig\Loader\FilesystemLoader('app/view'); 
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('post.html');

        // Renderiza a página
        $parametros = array();
        $parametros['post'] = $post;
        $saida = $template->render($parametros);

        // $template = file_get_contents("app/view/home.html");
        return $saida;      
      } 
      catch (Exception $e) {
        return "<h1 style='color: red'>{$e->getMessage()}</h1>";
      }    
    }

    public function comment() {
      try {
        if (!isset($_GET['id']))
           throw new Exception("Publicação não localizada");
        
        $id = $_GET['id'];
        $post = Post::getById($id);
        
        if (!$post)
          throw new Exception("Publicação não localizada");
        
        Comment::insert($_POST);

        redirect("index.php?p=post&id={$id}#comentarios");
      } 
      catch (Exception $e) {
        alert("Falha ao incluir comentário! " . $e->getMessage());
        redirect("index.php?p=post&id={$id}#comentarios");
      }    
    }

  }
  