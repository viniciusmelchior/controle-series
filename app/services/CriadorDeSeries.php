<?php 

namespace App\services;

use App\Serie;

class CriadorDeSeries{
    public function criarSerie(String $nomeDaSerie,  $qtdTemporadas,  $epPorTemporada){

        $serie = Serie::create(['nome' => $nomeDaSerie]);
        $qtdTemporadas = $qtdTemporadas;
        
        for($i = 1; $i <= $qtdTemporadas; $i++ ){
           $temporada = $serie->temporadas()->create(['numero' => $i]);

           for($j = 1; $j <= $epPorTemporada; $j++){
             $temporada->episodios()->create(['numero' => $j]);
           }
        }

        return $serie;
    }
}