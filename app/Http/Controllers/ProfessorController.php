<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use Illuminate\Support\Facades\DB;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Professor $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('professores.index', ['professores' => $model
                                                        ->join('users', 'users.id', 'professor.IDUSER')
                                                        ->orderBy('NOME', 'ASC')
                                                        ->paginate(5)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Professor $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('professores.index', ['professores' => $model
                                                ->where('NOME','like', $request->nomeMatricula.'%')
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
        $users = DB::table('users')->distinct()->where('permissao','=',2)->orderBy('name', 'asc')->get();
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('professores.create', compact('users'));
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
        $professor = new Professor;
        $professor->create($request->all());
        return redirect()->route('professor.index', compact('error'))->withStatus(__('Cadastro realizado com sucesso!.'));
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
        $users = DB::table('users')->distinct()->where('permissao','=',2)->orderBy('name', 'asc')->get();
        $professor = Professor::findOrFail($id);
        return view('professores.edit', compact('professor', 'users'));
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
        $professor = Professor::findOrFail($id);
        $professor->update($request->all());
        return redirect()->route('professor.index', compact('error'))->withStatus(__('Professor(a) atualizado(a) com sucesso.'));
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
        $error = 0;
        $professor = Professor::findOrFail($id);
        $professor->delete();
        return redirect()->route('professor.index', compact('error'))->withStatus(__('Professor(a) deletado(a) com sucesso.'));
    }
}
