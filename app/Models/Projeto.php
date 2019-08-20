<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Projeto
 * @package App\Models
 * @version August 20, 2019, 12:22 pm UTC
 *
 * @property string nome
 * @property string linguagem
 */
class Projeto extends Model
{
    use SoftDeletes;

    public $table = 'projetos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nome',
        'linguagem'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'linguagem' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public $belongsTo = [];
}
