<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class modelo
 * @package App\Models
 * @version August 19, 2019, 5:56 pm UTC
 *
 * @property integer projeto
 * @property string nome
 */
class modelo extends Model
{
    use SoftDeletes;

    public $table = 'modelos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'projeto',
        'nome'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'projeto' => 'integer',
        'nome' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'projeto' => 'required'
    ];

    
}
