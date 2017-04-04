<?php
  /* Arquivo com funções de utilidade */

  // Função que retorna os atributos
  function attr($array){
    return $array['@attributes'];
  }

  // Função que recebe um array e um parametro de comparação, e retorna o maior
  function pegarMaisRecente($array, $value){
    $high = 0; $highPos = 0; $count = 0;
    // percorrer o array
    foreach ($array as $item) {
      // comparar
      if(attr($item)[$value] > $high){
         $high = attr($item)[$value];
         $highPos = $count;
      }
      $count++;
    }
    return $array[$highPos];
  }

 ?>
