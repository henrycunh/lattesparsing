<?php
  // Classe principal
  class Curriculo{
    // ICs
    public $titulacao;
    public $artigos;
    public $livros;
    public $trabEventos;
    public $capLivros;
    public $bancas;
    public $organizacaoEventos;
    // Construtor
    public function __construct(){
      $this->titulacao = '';
      $this->artigos = '';
      $this->livros = '';
      $this->trabEventos = '';
      $this->capLivros = '';
      $this->bancas = '';
      $this->organizacaoEventos = '';
    }

    // Função para instanciar e buscar todas as informações
    public static function getCurriculo($data){
      $curriculo = new self();
      $curriculo->titulacao = Titulacao::getTitulacao($data);
      $curriculo->artigos = Artigo::getArtigos($data);
      $curriculo->livros = Livro::getLivros($data);
      $curriculo->trabEventos = TrabEvento::getTrabEventos($data);
      $curriculo->capLivros = CapLivro::getCapLivros($data);
      $curriculo->bancas = Banca::getBancas($data);
      $curriculo->organizacaoEventos = OrganizacaoEvento::getOrganizacaoEvento($data);
      return $curriculo;
    }

  }

  // Importando ICs
  require 'utils.php';
  require 'titulacao.php';
  require 'artigo.php';
  require 'livro.php';
  require 'trabEvento.php';
  require 'capLivro.php';
  require 'banca.php';
  require 'organizacaoEvento.php';






 ?>
