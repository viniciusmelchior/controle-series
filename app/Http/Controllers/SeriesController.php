<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Serie;
use App\services\CriadorDeSeries;
use App\services\RemovedorDeSerie;
use App\Temporada;

class SeriesController extends Controller {

    public function index (Request $request) {
        $series = Serie::query()->OrderBy('nome')->get(); //na série vc realiza a consulta e retorna em ordem e pegue os resultados
        $mensagem = $request->session()->get('mensagem'); //pega mensagem da sessao
      
        return view('series.index',compact('series', 'mensagem'));

     }

    public function create(){
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSeries $criadorDeSeries) {

        $serie = $criadorDeSeries->criarSerie(
            $request->nome, 
            $request->qtd_temporadas, 
            $request->ep_por_temporada
        );

       $request->session()->flash('mensagem', "série id: {$serie->id} e suas temporadas episódios criadas com sucesso: {$serie->nome}"); //cria sessao com a mensagem
        
        return redirect()->route('listar_series'); //retorna para a página listar séries

    }   

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie){

        $nomeSerie = $removedorDeSerie->removerSerie($request->id);

        $request->session()->flash('mensagem', "Série {$nomeSerie} removida com sucesso");
        return redirect()->route('listar_series');
    }  

        public function editaNome(int $id, Request $request)
    {
        $serie = Serie::find($id);
        $novoNome = $request->nome;
        $serie->nome = $novoNome;
        $serie->save();
    }
}

?>