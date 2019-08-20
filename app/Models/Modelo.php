<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Modelo
 * @package App\Models
 * @version August 20, 2019, 2:38 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection ids
 * @property integer projeto_id
 * @property string singular
 * @property string plural
 */
class Modelo extends Model
{
    use SoftDeletes;

    public $table = 'modelos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'projeto_id',
        'singular',
        'plural'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'projeto_id' => 'integer',
        'singular' => 'string',
        'plural' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'projeto_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ids()
    {
        return $this->hasMany(\App\Models\Projeto::class, 'id');
    }

    public $belongsTo = ['projeto'];

    public function projeto()
    {
        return $this->belongsTo(Projeto::class, 'projeto_id');
    }
}
