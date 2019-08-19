<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class projeto
 * @package App\Models
 * @version August 19, 2019, 5:20 pm UTC
 *
 * @property string nome
 * @property string tipo
 */
class projeto extends Model
{
    use SoftDeletes;

    public $table = 'projetos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nome',
        'tipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'tipo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
