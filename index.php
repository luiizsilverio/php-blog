<?php 

  require_once "app/core/core.php";
  require_once 'vendor/autoload.php';

  $template = file_get_contents("app/template/estrutura.html");

  // ob_start(); 
  //   $core = new Core;
  //   $saida = ob_get_contents();
  // ob_dump($saida);

  $core = new Core;
  $pagina = $core->start($_GET['p']);

  $saida = str_replace("{{root}}", $pagina, $template);

  echo $saida;
