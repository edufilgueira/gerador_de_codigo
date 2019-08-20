<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Campo
 * @package App\Models
 * @version August 20, 2019, 7:04 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection ids
 * @property integer modelo_id
 * @property string nome
 * @property string validador
 * @property string tipo_input
 */
class Campo extends Model
{
    use SoftDeletes;

    public $table = 'campos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'modelo_id',
        'nome',
        'validador',
        'tipo_input'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'modelo_id' => 'integer',
        'nome' => 'string',
        'validador' => 'string',
        'tipo_input' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ids()
    {
        return $this->hasMany(\App\Models\Modelo::class, 'id');
    }

    public $belongsTo = ['modelo'];

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }
}
