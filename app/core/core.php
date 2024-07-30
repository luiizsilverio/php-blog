<?php

  require_once 'app/controller/home-controller.php';
  require_once 'app/controller/sobre-controller.php';
  require_once 'app/controller/erro-controller.php';
  require_once 'app/controller/post-controller.php';
  require_once 'app/controller/admin-controller.php';

class Core {

  public function start($urlPage, $urlMethod) {
    $pagina = empty($urlPage) ? 'home' : $urlPage;
    $acao = empty($urlMethod) ? 'index' : $urlMethod;

    switch ($pagina) {
      case 'home': 
        $controller = new HomeController;
        break;
      case 'sobre':
        $controller = new SobreController;
        break;
      case 'post':
        $controller = new PostController;
        break;
      case 'admin':
        $controller = new AdminController;
        break;
      default:
        $controller = new ErroController;
    }

    // return $controller->index();
    return call_user_func_array(array($controller, $acao), array());
  }  
  
}