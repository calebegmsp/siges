<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
	protected $table = 'frequencia';

	protected $primaryKey = 'CDFREQUENCIA';

    protected $fillable = [
        'CDMATDISCIPLINA',
        'DATA',
        'FALTAS',
    ];

}
