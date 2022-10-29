<?php

class DatoAlimento {
    // Properties
    private $TipoPasto;
    private $CategoriaAlimento;
    private $Descrizione;
    private $Grammi;

    // Methods
    function __construct($tipo, $cat, $descr, $grammi) {
        $TipoPasto = $tipo;
        $CategoriaAlimento = $cat;
        $Descrizione = $descr;
        $Grammi = $grammi;
    }

    // GETTERS
    function getTipoPasto() {
        return $this->TipoPasto;
    }

    function getCategoriaAlimento() {
        return $this->CategoriaAlimento;
    }

    function getDescrizione() {
        return $this->Descrizione;
    }

    function getGrammi() {
        return $this->Grammi;
    }

}