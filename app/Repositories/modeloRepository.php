<?php

namespace App\Repositories;

use App\Models\modelo;
use App\Repositories\BaseRepository;

/**
 * Class modeloRepository
 * @package App\Repositories
 * @version August 19, 2019, 5:56 pm UTC
*/

class modeloRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'projeto',
        'nome'
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
        return modelo::class;
    }
}
