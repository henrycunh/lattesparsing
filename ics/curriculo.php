<?php
  // Classe principal
  class Curriculo{
    // ICs
    public $titulacao;

    // Construtor
    public function __construct(){
      $this->titulacao = '';
    }

    // Função para instanciar e buscar todas as informações
    public static function getCurriculo($data){
      $curriculo = new self();
      $curriculo->setTitulacao(Titulacao::getTitulacao($data));
      return $curriculo;
    }

    public function setTitulacao($titulacao){$this->titulacao = $titulacao;}
    public function getTitulacao(){ return $this->titulacao; }

  }

  // Importando ICs
  require 'titulacao.php';


  



 ?>
