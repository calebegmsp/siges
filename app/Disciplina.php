<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
	protected $table = 'disciplina';

	protected $primaryKey = 'CDDISCIPLINA';

    protected $fillable = [
        'NOMEDISCIPLINA',
        'CDPROFESSOR',
        'CDCURSO',
        'VALOR'
    ];

}
