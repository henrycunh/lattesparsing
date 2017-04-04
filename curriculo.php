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

  /* Tudo abaixo dessa linha são ICs */

  // Titulação (Graduação, Especialista, Mestrado, Doutorado)
  class Titulacao{
    public $titulo;
    public $nomeCurso;
    public $instituicao;
    public $orientador;
    public $anoInicio;
    public $anoConclusao;

    public function __construct(){
      $this->titulo = "";
      $this->nomeCurso = "";
      $this->instituicao = "";
      $this->orientador = "";
      $this->anoInicio = "";
      $this->anoConclusao = "";
    }

    public static function getTitulacao($data){
      $titulacao = new self();

      $titulos = $data['DADOS-GERAIS']['FORMACAO-ACADEMICA-TITULACAO'];
      $tipo; $titulo;

      // Pegando a maior titulação

      if(isset($titulos['DOUTORADO'])){
         $tipo = 1;
         $titulo = $titulos['DOUTORADO'];
       }
      else if(isset($titulos['MESTRADO'])) {
        $tipo = 2;
        $titulo = $titulos['MESTRADO'];
      }
      else if(isset($titulos['ESPECIALIZACAO'])){
        $tipo = 3;
        $titulo = $titulos['ESPECIALIZACAO'];
      }

      // Processando cada titulação
      if($tipo == 1){
        // Doutorado
        // Pegar o doutorado mais recente, se houver mais de um
        if(count($titulo) > 1)
          $titulo = pegarMaisRecente($titulo, 'ANO-DE-CONCLUSAO');
        $titulo = attr($titulo);
        $titulacao->setTitulo($titulo['TITULO-DA-DISSERTACAO-TESE']);
        $titulacao->setNomeCurso($titulo['NOME-CURSO']);
        $titulacao->setInstituicao($titulo['NOME-INSTITUICAO']);
        $titulacao->setOrientador($titulo['NOME-COMPLETO-DO-ORIENTADOR']);
        $titulacao->setAnoInicio($titulo['ANO-DE-INICIO']);
        $titulacao->setAnoConclusao($titulo['ANO-DE-CONCLUSAO']);
      } else if ($tipo == 2){
        // Mestrado
        // Pegar o mestrado mais recente, se houver mais de um
        if(count($titulo) > 1)
          $titulo = pegarMaisRecente($titulo, 'ANO-DE-CONCLUSAO');
        $titulo = attr($titulo);
        $titulacao->setTitulo($titulo['TITULO-DA-DISSERTACAO-TESE']);
        $titulacao->setNomeCurso($titulo['NOME-CURSO']);
        $titulacao->setInstituicao($titulo['NOME-INSTITUICAO']);
        $titulacao->setOrientador($titulo['NOME-COMPLETO-DO-ORIENTADOR']);
        $titulacao->setAnoInicio($titulo['ANO-DE-INICIO']);
        $titulacao->setAnoConclusao($titulo['ANO-DE-CONCLUSAO']);
      } else if ($tipo == 3){
        // Especialização
        // Pegar a especialização mais recente, se houver mais de um
        if(count($titulo) > 1)
          $titulo = pegarMaisRecente($titulo, 'ANO-DE-CONCLUSAO');
        $titulo = attr($titulo);
        $titulacao->setTitulo($titulo['TITULO-DA-MONOGRAFIA']);
        $titulacao->setNomeCurso($titulo['NOME-CURSO']);
        $titulacao->setInstituicao($titulo['NOME-INSTITUICAO']);
        $titulacao->setOrientador($titulo['NOME-DO-ORIENTADOR']);
        $titulacao->setAnoInicio($titulo['ANO-DE-INICIO']);
        $titulacao->setAnoConclusao($titulo['ANO-DE-CONCLUSAO']);
      }
      return $titulacao;
    }

    // Getters
    public function getTitulo(){ return $this->titulo; }
    public function getNomeCurso(){ return $this->nomeCurso; }
    public function getInstituicao(){ return $this->instituicao; }
    public function getOrientador(){ $this->orientador; }
    public function getAnoInicio(){ $this->anoInicio; }
    public function getAnoConclusao(){ $this->anoConclusao; }
    // Setters
    public function setTitulo($titulo){ $this->titulo = $titulo; }
    public function setNomeCurso($nomeCurso){ $this->nomeCurso = $nomeCurso; }
    public function setInstituicao($instituicao){ $this->instituicao = $instituicao; }
    public function setOrientador($orientador){ $this->orientador = $orientador; }
    public function setAnoInicio($anoInicio){ $this->anoInicio = $anoInicio; }
    public function setAnoConclusao($anoConclusao){ $this->anoConclusao = $anoConclusao; }
  }

  function attr($array){
    return $array['@attributes'];
  }

  function pegarMaisRecente($array, $value){
    $high = 0; $highPos = 0; $count = 0;
    foreach ($array as $item) {
      if(attr($item)[$value] > $high){
         $high = attr($item)[$value];
         $highPos = $count;
      }
      $count++;
    }
    return $array[$highPos];
  }



 ?>
