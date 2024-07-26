<?php require_once "app/model/post.php";

  class HomeController {

    public function index() {
      Post::getAll();
      $template = file_get_contents("app/view/home.php");
      return $template;
    }
    
  }