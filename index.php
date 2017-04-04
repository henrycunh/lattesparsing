<?php
  // Importando as classes de Curriculo os ICs
  require 'curriculo.php';
  // Define o tipo de conteudo
  header("Content-type: application/json");
  // Array com caminho para diferentes curriculos (debug)
  $curriculosPath = array(
    "augusto" => "xml/augusto.xml",
    "chirlaine" => "xml/chirlaine.xml",
    "jaime" => "xml/jaime.xml",
    "jose" => "xml/jose.xml",
    "ruth" => "xml/ruth.xml",
   );

  //Carrega o arquivo
  $file = file_get_contents($curriculosPath['chirlaine']);
  // // Substitui quebras de linha
  $file = str_replace(array("\n", "\r", "\t"), '', $file);
  // // Remove espaços múltiplos
  $file = preg_replace('/\s+/', ' ', $file);
  // Dá parse no XML
  $xml = simplexml_load_string($file);
  // Transforma para JSON
  $json = json_encode($xml, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  // Transforma para Array
  $data = json_decode($json, TRUE);
  // DEBUG JSON
  $debug = json_encode('' , JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

  // Objeto Curriculo
  $curriculo = Curriculo::getCurriculo($data);


  // echo json_encode($curriculo);
  echo $json;

?>