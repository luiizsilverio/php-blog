<?php

  require_once 'app/controller/home-controller.php';
  require_once 'app/controller/sobre-controller.php';
  require_once 'app/controller/erro-controller.php';

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