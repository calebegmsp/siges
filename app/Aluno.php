<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
	protected $table = 'aluno';

	protected $primaryKey = 'CDALUNO';

    protected $fillable = [
        'CDALUNO', 
        'NOME', 
        'NMATRICULA',
        'STATUS',
    ];

}
