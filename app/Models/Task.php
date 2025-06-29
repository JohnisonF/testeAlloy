<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nome', 'descricao', 'finalizado', 'data_limite'
    ];

    protected $casts = [
        'finalizado' => 'boolean',
        'data_limite' => 'datetime',
    ];
}
