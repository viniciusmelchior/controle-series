<?php 

namespace App\services;
use App\{Serie,Temporada,Episodio};
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie{

    public function removerSerie($serieId){
        $nomeSerie = '';

        DB::transaction(function() use($serieId, &$nomeSerie){

            $serie = Serie::find($serieId); //buscando o seriado
            $nomeSerie = $serie->nome;
            $serie->temporadas->each(function(Temporada $temporada){
            $temporada->episodios()->each(function(Episodio $episodio){
                $episodio->delete();
            });
            $temporada->delete();
        });
            $serie->delete();
        });
        

        return $nomeSerie;
    }
}