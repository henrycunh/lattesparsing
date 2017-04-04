<?php
  // Classe principal
  class Curriculo{
    // ICs
    public $titulacao;
    public $artigos;

    // Construtor
    public function __construct(){
      $this->titulacao = '';
    }

    // Função para instanciar e buscar todas as informações
    public static function getCurriculo($data){
      $curriculo = new self();
      $curriculo->titulacao = Titulacao::getTitulacao($data);
      $curriculo->artigos = Artigo::getArtigos($data);
      return $curriculo;
    }

  }

  // Importando ICs
  require 'titulacao.php';
  require 'artigo.php';






 ?>
