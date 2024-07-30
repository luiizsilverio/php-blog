<?php 

  require_once "app/model/post.php";
  require_once "lib/util.php";

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
        $parametros['postagens'] = $postagens;
        $saida = $template->render($parametros);
        return $saida;
     
      } catch (Exception $e) {
        return "<h1 style='color: red'>{$e->getMessage()}</h1>";
      }    
    }

    public function create() {
      try {
        $loader = new Twig\Loader\FilesystemLoader('app/view'); 
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('create.html');

        // Renderiza a página
        $parametros = array();
        $saida = $template->render($parametros);
        return $saida;
      }
      catch (Exception $e) {
        return "<h1 style='color: red'>Erro ao carregar formulário. {$e->getMessage()}</h1>";
      }  
    }

    public function insert() {
      try {
        Post::insert($_POST);

        alert('Publicação inserida com sucesso');
        echo '<script>location.href="index.php?p=admin&method=index";</script>';

      } catch (Exception $e) {
        // return "<h1 style='color: red'>{$e->getMessage()}</h1>";
        alert("Falha ao inserir publicação. " . $e->getMessage());
        echo '<script>location.href="index.php?p=admin&method=create"</script>';
      }
    }

  }