<?php 

  require_once "app/core/core.php";

  $template = file_get_contents("app/template/estrutura.html");

  // ob_start(); 
  //   $core = new Core;
  //   $saida = ob_get_contents();
  // ob_dump($saida);

  $core = new Core;
  $saida = $core->start($_GET['p']);

  $template_ok = str_replace("{{root}}", $saida, $template);

  echo $template_ok;
