<?php

  class ErroController {

    public function index() {
      $template = file_get_contents("app/view/erro.html");
      return $template;
    }

  }