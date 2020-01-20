<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
	protected $table = 'matricula';

	protected $primaryKey = 'CDMATRICULA';

    protected $fillable = [
        'CDCURSO',
        'CDALUNO',
        'CDSEMESTRE',
        'VALOR',
        'CDTURMA'
    ];

}
