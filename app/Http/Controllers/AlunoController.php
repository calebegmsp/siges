<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Aluno $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('alunos.index', ['alunos' => $model
                                                ->orderBy('NOME', 'ASC')
                                                ->paginate(5)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Aluno $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('alunos.index', ['alunos' => $model
                                                ->where('NOME','like', $request->nomeMatricula.'%')
                                                ->Where('STATUS','like','%'.$request->status.'%')
                                                ->orderBy('NOME', 'ASC')
                                                ->paginate(5)], compact('request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ((auth()->user()->permissao) == 2) return abort(404);

        $error = 0;
        $alunoValidate = DB::table('aluno')->select('id')
                                                ->where('NOME', 'like' , $request->NOME)
                                                ->count();
        if($alunoValidate > 0){
            $error = 1;
            return redirect()->route('aluno.index', compact('error'))->withStatus(__('Já existe um cadastro com o mesmo número de matricula'));
        }

        $aluno = new Aluno;
        $aluno->NOME = $request->NOME;
        $aluno->STATUS = $request->STATUS;
        $aluno->save();

        $request->merge(['NMATRICULA' => $aluno->CDALUNO]);
        $alunoUpdate = Aluno::findOrFail($aluno->CDALUNO);      
        $alunoUpdate->update($request->all());

        return redirect()->route('aluno.index', compact('error'))->withStatus(__('Cadastro realizado com sucesso!.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ((auth()->user()->permissao) == 2) return abort(404);    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        $aluno = Aluno::findOrFail($id);
        return view('alunos.edit', compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ((auth()->user()->permissao) == 2) return abort(404);
        $error = 0;
        $aluno = Aluno::findOrFail($id);
        $aluno->update($request->all());
        return redirect()->route('aluno.index', compact('error'))->withStatus(__('Aluno(a) atualizado(a) com sucesso.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((auth()->user()->permissao) == 2) return abort(404);
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();
        $error = 0;
        return redirect()->route('aluno.index', compact('error'))->withStatus(__('Aluno(a) deletado(a) com sucesso.'));
    }
}
