<?php

namespace App\Repositories;

use App\Models\projeto;
use App\Repositories\BaseRepository;

/**
 * Class projetoRepository
 * @package App\Repositories
 * @version August 19, 2019, 5:20 pm UTC
*/

class projetoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'tipo'
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
        return projeto::class;
    }
}
