<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
	protected $table = 'turma';

	protected $primaryKey = 'CDTURMA';

    protected $fillable = [
        'NOMETURMA',
        'created_at'
    ];

}
