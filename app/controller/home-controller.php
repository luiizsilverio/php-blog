<?php 

  require_once "app/model/post.php";

  class HomeController {

    public function index() {
      try {
        $postagens = Post::getAll();

        // carrega a pasta de templates e o template
        $loader = new Twig\Loader\FilesystemLoader('app/view'); 
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('home.html');

        // Renderiza a página
        $parametros = array();
        $parametros['postagens'] = $postagens;
        $saida = $template->render($parametros);

      } catch (Exception $e) {
        echo $e->getMessage();
      }
      
      // $template = file_get_contents("app/view/home.html");
      return $saida;
    }
    
  }