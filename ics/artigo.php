<?php

  class Artigo{
    public $titulo;
    public $ano;
    public $tituloPeriodico;
    public $issn;
    public $paginaInicial;
    public $paginaFinal;
    public $autores;

    public function __construct(){
      $this->titulo = '';
      $this->ano = '';
      $this->tituloPeriodico = '';
      $this->issn = '';
      $this->paginaFinal = '';
      $this->paginaInicial = '';
      $this->autores = array();
    }

    public static function getArtigos($data){
      $artigos = array();
      $artigosRaw = $data['PRODUCAO-BIBLIOGRAFICA']['ARTIGOS-PUBLICADOS']['ARTIGO-PUBLICADO'];
      foreach ($artigosRaw as $artigo) {
        $artigo_ = new self();
        $autores = $artigo['AUTORES'];
        $dadosB = attr($artigo['DADOS-BASICOS-DO-ARTIGO']);
        $details = attr($artigo['DETALHAMENTO-DO-ARTIGO']);

        $artigo_->titulo = $dadosB['TITULO-DO-ARTIGO'];
        $artigo_->ano = $dadosB['ANO-DO-ARTIGO'];
        $artigo_->tituloPeriodico = $details['TITULO-DO-PERIODICO-OU-REVISTA'];
        $artigo_->issn = $details['ISSN'];
        $artigo_->paginaFinal = $details['PAGINA-FINAL'];
        $artigo_->paginaInicial = $details['PAGINA-INICIAL'];
        $artigo_->autores = getAutores($autores);

        array_push($artigos, $artigo_);
      }
      return $artigos;
    }


  }

  
?>
