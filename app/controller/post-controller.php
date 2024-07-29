<?php 

  require_once "app/model/post.php";

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
  }
  