<?php

  require_once 'app/controller/home-controller.php';
  require_once 'app/controller/sobre-controller.php';
  require_once 'app/controller/erro-controller.php';
  require_once 'app/controller/post-controller.php';
  require_once 'app/controller/admin-controller.php';

class Core {

  public function start($urlGet) {
    $pagina = strtolower($urlGet);


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
        if (empty($pagina)) 
          $controller = new HomeController;
        else 
          $controller = new ErroController;
    }

    return $controller->index();
    // call_user_func_array(array($controller, 'index'), array());
  }
  
}