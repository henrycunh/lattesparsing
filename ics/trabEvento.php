<?php
  class TrabEvento{
    // 1 - Resumo Nacional, 2 - Resumo Internacional,
    // 3 - Completo Nacional, 4 - Completo Internacional
    public $tipo;
    public $natureza;
    public $titulo;
    public $ano;
    public $isbn;
    public $homepage;
    public $doi;
    public $classEvento;
    public $nomeEvento;
    public $cidadeEvento;
    public $anoRealizacao;
    public $nomeEditora;
    public $titulosAnais;
    public $pagInicial;
    public $pagFinal;
    public $autores;

    public function __construct(){
      $this->tipo = '';
      $this->natureza = '';
      $this->titulo = '';
      $this->ano = '';
      $this->isbn = '';
      $this->homepage = '';
      $this->doi = '';
      $this->classEvento = '';
      $this->nomeEvento = '';
      $this->cidadeEvento = '';
      $this->anoRealizacao = '';
      $this->nomeEditora = '';
      $this->titulosAnais = '';
      $this->pagInicial = '';
      $this->pagFinal = '';
      $this->autores = array();
    }

    public static function getTrabEventos($data){
      // PRODUCAO-BIBLIOGRAFICA.TRABALHOS-EM-EVENTOS.TRABALHO-EM-EVENTOS
      $trabEventos = array();
      // Caso o pesquisador não possua um trabalho em Evento
      if(isset($data['PRODUCAO-BIBLIOGRAFICA']['TRABALHOS-EM-EVENTOS']['TRABALHO-EM-EVENTOS'])):
        $trabEventosRaw = $data['PRODUCAO-BIBLIOGRAFICA']['TRABALHOS-EM-EVENTOS']['TRABALHO-EM-EVENTOS'];
      //
      foreach ($trabEventosRaw as $trabE) {
        $trab_ = new self();
        $dadosB = attr($trabE['DADOS-BASICOS-DO-TRABALHO']);
        $details = attr($trabE['DETALHAMENTO-DO-TRABALHO']);
        $autores = $trabE['AUTORES'];

        // Dados básicos do trabalho
        $trab_->natureza =  $dadosB['NATUREZA'];
        $trab_->titulo = $dadosB['TITULO-DO-TRABALHO'];
        $trab_->ano = $dadosB['ANO-DO-TRABALHO'];
        $trab_->homepage = $dadosB['HOME-PAGE-DO-TRABALHO'];
        $trab_->doi = $dadosB['DOI'];

        // Detalhes do Trabalho
        $trab_->classEvento = $details['CLASSIFICACAO-DO-EVENTO'];
        $trab_->nomeEvento = $details['NOME-DO-EVENTO'];
        $trab_->cidadeEvento = $details['CIDADE-DO-EVENTO'];
        $trab_->anoRealizacao = $details['ANO-DE-REALIZACAO'];
        $trab_->titulosAnais = $details['TITULO-DOS-ANAIS-OU-PROCEEDINGS'];
        $trab_->pagInicial = $details['PAGINA-INICIAL'];
        $trab_->pagFinal = $details['PAGINA-FINAL'];
        $trab_->isbn = $details['ISBN'];

        // Definindo tipo
        if($trab_->natureza == 'COMPLETO') $trab_->tipo = 2;
        else $trab_->tipo = 1;
        if($trab_->classEvento == 'INTERNACIONAL' && $trab_->tipo == 2) $trab_->tipo = 4;
        else if($trab_->classEvento != 'INTERNACIONAL' && $trab_->tipo == 2) $trab_->tipo = 3;
        else if($trab_->classEvento == 'INTERNACIONAL' && $trab_->tipo == 1) $trab_->tipo = 2;
        else if($trab_->classEvento != 'INTERNACIONAL' && $trab_->tipo == 1) $trab_->tipo = 1;
        // resumo nacional = 1
        // resumo internacional = 2
        // completo nacional = 3
        // completo internacional = 4

        $trab_->autores = getAutores($autores);
        array_push($trabEventos, $trab_);
      }
      endif;
      return $trabEventos;
    }

  }



 ?>
