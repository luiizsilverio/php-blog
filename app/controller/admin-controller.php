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
        // return "<h1 style='color: red'>Erro ao carregar formulário. {$e->getMessage()}</h1>";
        alert("Erro ao carregar formulário! " . $e->getMessage());
        redirect("index.php?p=admin&method=index");
      }  
    }

    public function insert() {
      try {
        Post::insert($_POST);

        alert('Publicação inserida com sucesso');
        redirect("index.php?p=admin&method=index");

      } catch (Exception $e) {
        // return "<h1 style='color: red'>{$e->getMessage()}</h1>";
        alert("Falha ao inserir publicação! " . $e->getMessage());
        redirect("index.php?p=admin&method=create");
      }
    }

    public function alterar() {
      try {
        if (!isset($_GET['id']))
           throw new Exception("Publicação não localizada");

        $id = $_GET['id'];
        $post = Post::getById($id);

        if (!$post)
          throw new Exception("Publicação não localizada");

        $loader = new Twig\Loader\FilesystemLoader('app/view'); 
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('update.html');

        // Renderiza a página
        $parametros = array();
        $parametros['postagem'] = $post;
        $saida = $template->render($parametros);
        return $saida;
      }
      catch (Exception $e) {
        alert("Falha ao alterar publicação! " . $e->getMessage());
        redirect("index.php?p=admin&method=index");
      }  
    }

    public function update() {
      try {
        Post::update($_POST);

        alert('Publicação alterada com sucesso');
        redirect("index.php?p=admin&method=index");

      } catch (Exception $e) {
        alert("Falha ao alterar a publicação! " . $e->getMessage());
        redirect("index.php?p=admin&method=alterar&id={$_POST['id']}");
      }
    }

    public function excluir() {
      try {
        if (!isset($_GET['id']))
           throw new Exception("Publicação não localizada");

        $id = $_GET['id'];
        $result = Post::delete($id);

        alert('Publicação excluída com sucesso');
        redirect("index.php?p=admin&method=index");

      } catch (Exception $e) {
        alert("Falha ao excluir a publicação! " . $e->getMessage());
        redirect("index.php?p=admin&method=index");
      }
    }
  }