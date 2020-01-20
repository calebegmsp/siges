<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matdisciplina extends Model
{
	protected $table = 'matdisciplina';

	protected $primaryKey = 'CDMATDISCIPLINA';

    protected $fillable = [
        'CDMATRICULA',
        'CDDISCIPLINA',
        'MEDIA',
        'STATUS',
        'CDPROFESSOR',
        'VALOR',
    ];

}
