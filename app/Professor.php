<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
	protected $table = 'professor';

	protected $primaryKey = 'CDPROFESSOR';

    protected $fillable = [
        'NOME',
        'IDUSER',
    ];

}
