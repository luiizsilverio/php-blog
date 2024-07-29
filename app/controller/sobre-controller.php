<?php

  class SobreController {

    public function index() {
      $template = file_get_contents("app/view/sobre.html");
      return $template;
    }
    
  }
