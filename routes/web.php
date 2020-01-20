<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', 'AboutController@index')->name('about');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



/**************************************
Rotas de usuários
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});



/**************************************
Rotas de alunos
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('aluno', 'AlunoController', ['except' => ['show']]);
	Route::get('/alunos/{id}/edit', ['as' => 'aluno.edit', 'uses' => 'AlunoController@edit']);
	Route::post('/alunos/indexSearch', ['as' => 'aluno.indexSearch', 'uses' => 'AlunoController@indexSearch']);
	Route::get('/alunos/{id}/view', ['as' => 'aluno.view', 'uses' => 'AlunoController@view']);
	Route::post('/alunos/{id}/update', ['as' => 'aluno.update', 'uses' => 'AlunoController@update']);
	Route::get('/alunos/{id}/destroy', ['as' => 'aluno.destroy', 'uses' => 'AlunoController@destroy']);
});

/**************************************
Rotas de professores
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('professor', 'ProfessorController', ['except' => ['show']]);
	Route::get('/professores/{id}/edit', ['as' => 'professor.edit', 'uses' => 'ProfessorController@edit']);
	Route::post('/professores/indexSearch', ['as' => 'professor.indexSearch', 'uses' => 'ProfessorController@indexSearch']);
	Route::get('/professores/{id}/view', ['as' => 'professor.view', 'uses' => 'ProfessorController@view']);
	Route::post('/professores/{id}/update', ['as' => 'professor.update', 'uses' => 'ProfessorController@update']);
	Route::get('/professores/{id}/destroy', ['as' => 'professor.destroy', 'uses' => 'ProfessorController@destroy']);
});

/**************************************
Rotas de cursos
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('curso', 'CursoController', ['except' => ['show']]);
	Route::get('/cursos/{id}/edit', ['as' => 'curso.edit', 'uses' => 'CursoController@edit']);
	Route::post('/cursos/indexSearch', ['as' => 'curso.indexSearch', 'uses' => 'CursoController@indexSearch']);
	Route::get('/cursos/{id}/view', ['as' => 'curso.view', 'uses' => 'CursoController@view']);
	Route::post('/cursos/{id}/update', ['as' => 'curso.update', 'uses' => 'CursoController@update']);
	Route::get('/cursos/{id}/destroy', ['as' => 'curso.destroy', 'uses' => 'CursoController@destroy']);
});

/**************************************
Rotas de turmas
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('turma', 'TurmaController', ['except' => ['show']]);
	Route::get('/turmas/{id}/edit', ['as' => 'turma.edit', 'uses' => 'TurmaController@edit']);
	Route::post('/turmas/indexSearch', ['as' => 'turma.indexSearch', 'uses' => 'TurmaController@indexSearch']);
	Route::get('/trumas/{id}/view', ['as' => 'turma.view', 'uses' => 'TurmaController@view']);
	Route::post('/turmas/{id}/update', ['as' => 'turma.update', 'uses' => 'TurmaController@update']);
	Route::get('/turmas/{id}/destroy', ['as' => 'turma.destroy', 'uses' => 'TurmaController@destroy']);
});


/**************************************
Rotas de semestre
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('semestre', 'SemestreController', ['except' => ['show']]);
	Route::get('/semestre/{id}/edit', ['as' => 'semestre.edit', 'uses' => 'SemestreController@edit']);
	Route::post('/semestre/indexSearch', ['as' => 'semestre.indexSearch', 'uses' => 'SemestreController@indexSearch']);
	Route::get('/semestre/{id}/view', ['as' => 'semestre.view', 'uses' => 'SemestreController@view']);
	Route::post('/semestre/{id}/update', ['as' => 'semestre.update', 'uses' => 'SemestreController@update']);
	Route::get('/semestre/{id}/destroy', ['as' => 'semestre.destroy', 'uses' => 'SemestreController@destroy']);
});


/**************************************
Rotas de disciplina
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('disciplina', 'DisciplinaController', ['except' => ['show']]);
	Route::get('/disciplina/{id}/edit', ['as' => 'disciplina.edit', 'uses' => 'DisciplinaController@edit']);
	Route::post('/disciplina/indexSearch', ['as' => 'disciplina.indexSearch', 'uses' => 'DisciplinaController@indexSearch']);
	Route::get('/disciplina/{id}/view', ['as' => 'disciplina.view', 'uses' => 'DisciplinaController@view']);
	Route::post('/disciplina/{id}/update', ['as' => 'disciplina.update', 'uses' => 'DisciplinaController@update']);
	Route::get('/disciplina/{id}/destroy', ['as' => 'disciplina.destroy', 'uses' => 'DisciplinaController@destroy']);
});

/**************************************
Rotas de matricula
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('matricula', 'MatriculaController', ['except' => ['show']]);
	Route::get('/matricula/{id}/edit', ['as' => 'matricula.edit', 'uses' => 'MatriculaController@edit']);
	Route::post('/matricula/indexSearch', ['as' => 'matricula.indexSearch', 'uses' => 'MatriculaController@indexSearch']);
	Route::get('/matricula/{id}/view', ['as' => 'matricula.view', 'uses' => 'MatriculaController@view']);
	Route::post('/matricula/{id}/update', ['as' => 'matricula.update', 'uses' => 'MatriculaController@update']);
	Route::get('/matricula/{id}/destroy', ['as' => 'matricula.destroy', 'uses' => 'MatriculaController@destroy']);
	Route::post('checkMatricula', ['as' => 'matricula.checkMatricula', 'uses' => 'MatriculaController@checkMatricula']);
});

/**************************************
Rotas de matdisciplina
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('matdisciplina', 'MatdisciplinaController', ['except' => ['show']]);
	Route::get('/matdisciplina/{id}/edit', ['as' => 'matdisciplina.edit', 'uses' => 'MatdisciplinaController@edit']);
	Route::post('/matdisciplina/indexSearch', ['as' => 'matdisciplina.indexSearch', 'uses' => 'MatdisciplinaController@indexSearch']);
	Route::get('/matdisciplina/{id}/view', ['as' => 'matdisciplina.view', 'uses' => 'MatdisciplinaController@view']);
	Route::post('/matdisciplina/{id}/update', ['as' => 'matdisciplina.update', 'uses' => 'MatdisciplinaController@update']);
	Route::get('/matdisciplina/{id}/destroy', ['as' => 'matdisciplina.destroy', 'uses' => 'MatdisciplinaController@destroy']);
	Route::post('alunoCursoSemestre', ['as' => 'matdisciplina.alunoCursoSemestre', 'uses' => 'MatdisciplinaController@alunoCursoSemestre']);
});

/**************************************
Rotas de lançar notas
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('lancarnotas', 'LancarnotasController', ['except' => ['show']]);
	Route::get('/lancarnotas/{id}/edit', ['as' => 'lancarnotas.edit', 'uses' => 'LancarnotasController@edit']);
	Route::post('/lancarnotas/indexSearch', ['as' => 'lancarnotas.indexSearch', 'uses' => 'LancarnotasController@indexSearch']);
	Route::get('/lancarnotas/{id}/view', ['as' => 'lancarnotas.view', 'uses' => 'LancarnotasController@view']);
	Route::post('/lancarnotas/update', ['as' => 'lancarnotas.update', 'uses' => 'LancarnotasController@update']);
	Route::get('/lancarnotas/{CDSEMESTRE}/{CDTURMA}/{CDDISCIPLINA}/{REFERENCIA}/destroy', ['as' => 'lancarnotas.destroy', 'uses' => 'LancarnotasController@destroy']);
	Route::get('/lancarnotas/{CDSEMESTRE}/{CDTURMA}/{CDDISCIPLINA}/nota', ['as' => 'lancarnotas.nota', 'uses' => 'LancarnotasController@nota']);
	Route::get('/lancarnotas/{CDSEMESTRE}/{CDTURMA}/{CDDISCIPLINA}/lancarnotas', ['as' => 'lancarnotas.lancarnotas', 'uses' => 'LancarnotasController@lancarnotas']);
	Route::get('/lancarnotas/{CDSEMESTRE}/{CDTURMA}/{CDDISCIPLINA}/{REFERENCIA}/editarnotas', ['as' => 'lancarnotas.edit', 'uses' => 'LancarnotasController@edit']);
	Route::post('checkNomeAvali', ['as' => 'matricula.checkNomeAvali', 'uses' => 'LancarnotasController@checkNomeAvali']);
});


/**************************************
Rotas de lançar frequencia
***************************************/
Route::group(['middleware' => 'auth'], function () {
	Route::resource('frequencias', 'FrequenciaController', ['except' => ['show']]);
	Route::get('/frequencia/{id}/edit', ['as' => 'frequencia.edit', 'uses' => 'FrequenciaController@edit']);
	Route::post('/frequencia/indexSearch', ['as' => 'frequencia.indexSearch', 'uses' => 'FrequenciaController@indexSearch']);
	Route::get('/frequencia/{id}/view', ['as' => 'frequencia.view', 'uses' => 'FrequenciaController@view']);
	Route::post('/frequencia/update', ['as' => 'frequencia.update', 'uses' => 'FrequenciaController@update']);
	Route::get('/frequencia/{CDSEMESTRE}/{CDTURMA}/{CDDISCIPLINA}/{REFERENCIA}/destroy', ['as' => 'frequencia.destroy', 'uses' => 'FrequenciaController@destroy']);
	Route::get('/frequencia/{CDSEMESTRE}/{CDTURMA}/{CDDISCIPLINA}/nota', ['as' => 'frequencia.nota', 'uses' => 'FrequenciaController@nota']);
	Route::get('/frequencia/{CDSEMESTRE}/{CDTURMA}/{CDDISCIPLINA}/lancarnotas', ['as' => 'frequencia.lancarnotas', 'uses' => 'FrequenciaController@lancarnotas']);
	Route::get('/frequencia/{CDSEMESTRE}/{CDTURMA}/{CDDISCIPLINA}/{REFERENCIA}/editarnotas', ['as' => 'frequencia.edit', 'uses' => 'FrequenciaController@edit']);
	Route::post('frequencia', ['as' => 'frequencia.checkDataFreque', 'uses' => 'LancarnotasController@frequencia']);
	Route::post('checkDataAvali', ['as' => 'matricula.checkDataAvali', 'uses' => 'LancarnotasController@checkDataAvali']);
});
