<?php

namespace App\Repositories;

use App\Models\Campo;
use App\Repositories\BaseRepository;

/**
 * Class CampoRepository
 * @package App\Repositories
 * @version August 20, 2019, 7:04 pm UTC
*/

class CampoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'modelo_id',
        'nome',
        'validador',
        'tipo_input'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Campo::class;
    }
}
