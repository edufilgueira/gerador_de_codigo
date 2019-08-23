<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjetoRequest;
use App\Http\Requests\UpdateProjetoRequest;
use App\Repositories\ProjetoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Modelo;
use App\Models\Campo;
use App\Models\Projeto;
use Flash;
use Response;

class ProjetoController extends AppBaseController
{
    /** @var  ProjetoRepository */
    private $projetoRepository;

    public function __construct(ProjetoRepository $projetoRepo)
    {
        $this->projetoRepository = $projetoRepo;
    }

    public function gerar($id){
        
        $projeto_id = $id;
        $projeto = Projeto::find($id);

        //Criar estrutura de pastas
        $this->criar_pasta($projeto->nome);
        $this->criar_pasta($projeto->nome."/src");
        $this->criar_pasta($projeto->nome."/src/app");
        $caminho_model = $projeto->nome."/src/app/Models";
        $this->criar_pasta($caminho_model);
        $caminho_services = $projeto->nome."/src/app/services";
        $this->criar_pasta($caminho_services);

        $modelos = Modelo::where('projeto_id', $projeto_id)->get();
        
        //Percorrer todos os modelos de um projeto
        foreach($modelos as $key => $modelo){
            
            //Percorrer todos os campos de um modelo
            $campos = Campo::where('modelo_id', $modelo->id)->get();
            $this->gerar_model($projeto, $modelo, $campos, $caminho_model);
            $this->gerar_service($modelo, $caminho_services);

        }
        
        //$this->gerar_arquivo("conteudo",$pasta,"arquivo.txt");
        
        //$this->delTree('pastas');
        return redirect(route('projetos.index'));
    }
    
    private function gerar_arquivo($conteudo, $diretorio, $arquivo){
        $this->criar_pasta($diretorio);
        $arquivo = fopen("$diretorio/$arquivo", 'w');
        fwrite($arquivo, $conteudo);
        fclose($arquivo);
    }

    private function delTree($dir) { 
        $files = array_diff(scandir($dir), array('.','..')); 
        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        } 
        return rmdir($dir); 
    }

    private function criar_pasta($diretorio){
        if(!is_dir($diretorio))
            mkdir($diretorio);
    }

    private function primeiras_letras_maiuscula($string){
        $array = explode('_', $string);

        $nome = "";
        foreach($array as $valor)
        {
            $nome = $nome . ucfirst($valor);
        }

        return $nome;
    }

    public function gerar_model($projeto, $modelo, $campos, $caminho){
        
        $PrimeiraMaiuscula = $this->primeiras_letras_maiuscula($modelo->singular);
        $conteudo = "export class ".$PrimeiraMaiuscula."{
  public id: BigInteger;\n";

        foreach($campos as $key => $campo){
            $nome = strtolower($campo->nome);
            $conteudo .= "  public ".$nome.": string;\n";
            
        }

        $conteudo .="  public created_at: string;
  public updated_at: string;
  public deleted_at: string;

  //Botão para controle interno
  public display_button = false;

  constructor(
  ){}
}";

        $this->gerar_arquivo($conteudo,$caminho,$modelo->singular.".ts");

    }

    public function gerar_service($modelo, $caminho){
        $this->criar_pasta($caminho."/".$modelo->singular);

        $PrimeiraMaiuscula = $this->primeiras_letras_maiuscula($modelo->singular);
        $minuscula = strtolower($modelo->singular);

        $conteudo = "import { ".$PrimeiraMaiuscula." } from '../../models/".$minuscula."';
import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, map, tap } from 'rxjs/operators';

//ADD MANUAL
import { VariablesService } from './../../services/variables.service';

const httpOptions = {
  headers: new HttpHeaders({
    'Accept': 'application/json',
    'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQzZmYxODIxNDNkOGIzODQ4ZjIzMzQ1YmNiMDc2NjUzMTE0Y2JmMTRlM2M4Nzk0OGFkMzQ0NGYxYWU3MTM5MjRiMjdjMDU1YmM4NDYxMGZmIn0.eyJhdWQiOiIxIiwianRpIjoiZDNmZjE4MjE0M2Q4YjM4NDhmMjMzNDViY2IwNzY2NTMxMTRjYmYxNGUzYzg3OTQ4YWQzNDQ0ZjFhZTcxMzkyNGIyN2MwNTViYzg0NjEwZmYiLCJpYXQiOjE1NTkxODgyMjAsIm5iZiI6MTU1OTE4ODIyMCwiZXhwIjoxNTkwODEwNjIwLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.B0CIQBK98xikoIAq28JjEosFRvIxaZ8vGtUhrK5SKeU-b0RuAKcfXzQzZmPDyg_CyYOb1KF7VQ0odxK5cIw9wXmRSGMNK-Gdo7sqqN5SZKgd-rIm91gukqbHnxj_rFoCjBuRgblMgvEvlq22IuCT3n0jvSGWhcq3NXfU7-O0V56LPg9ShcQ41U3HkY5LOdDsDM-GRHCI0fiYZ9rFjmRfGZd0PFyvuaNzfd6oEL9eTTcgZBTA8gBi2b9UwDoSA55q0ly8g1Ph9RLoBGLuWpKVwACJ-rfMenVe4UjckCmDCcxn3x37tLe74RDUnjhM3e__uOHCjdLDwmplrd9qhN5S9E3ZAITMyiDVfC8w2840QNLmCKYqyUM23ctLf0nKLoarDteRpS8teoayeJOkzOt4NTXJ3-2IwWS1iemq6JqAqpU07Zy0ig9VTCoL0mPjjDmHSzrQyanUHmGVhF-0HVvNhLGjxyKI65GtVrPKeFbQTj4vIx42fV6bLyuSfT33SUTFR_UUwjSetITpLiRfnQ_wRbVGJuhnEF8382Hg012uXzSzTMDnRcVXxZdtphRApCnH_i6bI6O5Oek2m1NyinlkNAW8jlbX1Bhp013gtcALLAWYPS1JvRezj_u5vS-Gt_p5MGhD56omAgWuPD1AXfrnfeRYwHIssv7-PUp6HdqZwpA'})
};

const head= new HttpHeaders() .append('accept', 'application/json') .append('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQzZmYxODIxNDNkOGIzODQ4ZjIzMzQ1YmNiMDc2NjUzMTE0Y2JmMTRlM2M4Nzk0OGFkMzQ0NGYxYWU3MTM5MjRiMjdjMDU1YmM4NDYxMGZmIn0.eyJhdWQiOiIxIiwianRpIjoiZDNmZjE4MjE0M2Q4YjM4NDhmMjMzNDViY2IwNzY2NTMxMTRjYmYxNGUzYzg3OTQ4YWQzNDQ0ZjFhZTcxMzkyNGIyN2MwNTViYzg0NjEwZmYiLCJpYXQiOjE1NTkxODgyMjAsIm5iZiI6MTU1OTE4ODIyMCwiZXhwIjoxNTkwODEwNjIwLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.B0CIQBK98xikoIAq28JjEosFRvIxaZ8vGtUhrK5SKeU-b0RuAKcfXzQzZmPDyg_CyYOb1KF7VQ0odxK5cIw9wXmRSGMNK-Gdo7sqqN5SZKgd-rIm91gukqbHnxj_rFoCjBuRgblMgvEvlq22IuCT3n0jvSGWhcq3NXfU7-O0V56LPg9ShcQ41U3HkY5LOdDsDM-GRHCI0fiYZ9rFjmRfGZd0PFyvuaNzfd6oEL9eTTcgZBTA8gBi2b9UwDoSA55q0ly8g1Ph9RLoBGLuWpKVwACJ-rfMenVe4UjckCmDCcxn3x37tLe74RDUnjhM3e__uOHCjdLDwmplrd9qhN5S9E3ZAITMyiDVfC8w2840QNLmCKYqyUM23ctLf0nKLoarDteRpS8teoayeJOkzOt4NTXJ3-2IwWS1iemq6JqAqpU07Zy0ig9VTCoL0mPjjDmHSzrQyanUHmGVhF-0HVvNhLGjxyKI65GtVrPKeFbQTj4vIx42fV6bLyuSfT33SUTFR_UUwjSetITpLiRfnQ_wRbVGJuhnEF8382Hg012uXzSzTMDnRcVXxZdtphRApCnH_i6bI6O5Oek2m1NyinlkNAW8jlbX1Bhp013gtcALLAWYPS1JvRezj_u5vS-Gt_p5MGhD56omAgWuPD1AXfrnfeRYwHIssv7-PUp6HdqZwpA');

const apiUrl = VariablesService.getUrlServer()+'age_ranges';

@Injectable({
  providedIn: 'root'
})

export class AgeRangeService {

  constructor(
    private httpClient: HttpClient
    ) { }
  
  index(next_page_url): Observable<AgeRange[]> {
    var url = (next_page_url) ? next_page_url:apiUrl;
    return this.httpClient.get<AgeRange[]>(url,{headers:head})
      .pipe(
        tap(data => console.log('fetched AgeRange')),
        catchError(this.handleError('AgeRange', []))
      );
  }

  search(field, value, next_page_url): Observable<AgeRange[]> {
    var url = (next_page_url) ? next_page_url+'&'+field+'=*'+value+'*' : apiUrl+'?'+field+'=*'+value+'*';
    return this.httpClient.get<AgeRange[]>(url)
      .pipe(
        tap(data => console.log('api search AgeRange')),
        catchError(this.handleError('search AgeRange', []))
      );
  }

  show(id): Observable<AgeRange> {
    const url = apiUrl+'/'+id;
    console.log('testendo.... '+url);
    return this.httpClient.get<AgeRange>(url).pipe(
      tap(_ => this.log('fetched AgeRange id='+id)),
      catchError(this.handleError<AgeRange>('AgeRange id='+id))
    );
  }

  create(data): Observable<any> {
    return this.httpClient.post(apiUrl, data, httpOptions)
      .pipe(
        catchError(this.handleError)
      );
  }

  update(id, ageRange): Observable<any> {
    const url = apiUrl+'/'+id;
    return this.httpClient.put(url, ageRange, httpOptions).pipe(
      tap(_ => this.log('updated AgeRange id='+id)),
      catchError(this.handleError<any>('AgeRange'))
    );
  }

  destroy(id): Observable<AgeRange> {
    const url = apiUrl+'/'+id;
    return this.httpClient.delete<AgeRange>(url, httpOptions).pipe(
      tap(_ => this.log(`deleted AgeRange`)),
      catchError(this.handleError<AgeRange>('AgeRange'))
    );
  }

  /**
 * Handle Http operation that failed.
 * Let the app continue.
 * @param operation - name of the operation that failed
 * @param result - optional value to return as the observable result
 */
  private handleError<T> (operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // TODO: better job of transforming error for user consumption
      this.log(operation + 'failed: ' + error.message);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }

  private log(message: string) {
     console.log('Service: '+ message);
  }
}";
        $this->gerar_arquivo($conteudo, $caminho."/".$modelo->singular, $modelo->singular.".service.ts");

    }


    /**
     * Display a listing of the Projeto.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $projetos = $this->projetoRepository->paginate(10);

        return view('projetos.index')
            ->with('projetos', $projetos);
    }

    /**
     * Show the form for creating a new Projeto.
     *
     * @return Response
     */
    public function create()
    {
        return view('projetos.create');
    }

    /**
     * Store a newly created Projeto in storage.
     *
     * @param CreateProjetoRequest $request
     *
     * @return Response
     */
    public function store(CreateProjetoRequest $request)
    {
        $input = $request->all();

        $projeto = $this->projetoRepository->create($input);

        Flash::success('Projeto saved successfully.');

        return redirect(route('projetos.index'));
    }

    /**
     * Display the specified Projeto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $projeto = $this->projetoRepository->find($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        return view('projetos.show')->with('projeto', $projeto);
    }

    /**
     * Show the form for editing the specified Projeto.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $projeto = $this->projetoRepository->find($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        return view('projetos.edit')->with('projeto', $projeto);
    }

    /**
     * Update the specified Projeto in storage.
     *
     * @param int $id
     * @param UpdateProjetoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjetoRequest $request)
    {
        $projeto = $this->projetoRepository->find($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        $projeto = $this->projetoRepository->update($request->all(), $id);

        Flash::success('Projeto updated successfully.');

        return redirect(route('projetos.index'));
    }

    /**
     * Remove the specified Projeto from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $projeto = $this->projetoRepository->find($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        $this->projetoRepository->delete($id);

        Flash::success('Projeto deleted successfully.');

        return redirect(route('projetos.index'));
    }

}
