<?php 

  require_once "app/model/post.php";

  class AdminController {

    public function index() {
      try {
        $postagens = Post::getAll();

        // carrega a pasta de templates e o template
        $loader = new Twig\Loader\FilesystemLoader('app/view'); 
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('admin.html');

        // Renderiza a página
        $parametros = array();
        $saida = $template->render($parametros);
        return $saida;
     
      } catch (Exception $e) {
        return "<h1 style='color: red'>{$e->getMessage()}</h1>";
      }    
    }
  }