<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
	protected $table = 'curso';

	protected $primaryKey = 'CDCURSO';

    protected $fillable = [
        'NOMECURSO',
        'VALORCURSO'
    ];

}
