<?php

  class SobreController {

    public function index() {
      $template = file_get_contents("app/view/sobre.php");
      return $template;
    }
    
  }
