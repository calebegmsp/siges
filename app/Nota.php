<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
	protected $table = 'nota';

	protected $primaryKey = 'CDNOTA';

    protected $fillable = [
        'CDMATDISCIPLINA',
        'NOTA',
        'REFERENCIA',
        'STATUS',
    ];

}
