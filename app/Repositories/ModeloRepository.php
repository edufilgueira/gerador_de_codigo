<?php

namespace App\Repositories;

use App\Models\Modelo;
use App\Repositories\BaseRepository;

/**
 * Class ModeloRepository
 * @package App\Repositories
 * @version August 20, 2019, 2:38 pm UTC
*/

class ModeloRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projeto_id',
        'singular',
        'plural'
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
        return Modelo::class;
    }
}
