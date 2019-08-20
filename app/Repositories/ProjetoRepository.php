<?php

namespace App\Repositories;

use App\Models\Projeto;
use App\Repositories\BaseRepository;

/**
 * Class ProjetoRepository
 * @package App\Repositories
 * @version August 20, 2019, 12:22 pm UTC
*/

class ProjetoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'linguagem'
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
        return Projeto::class;
    }
}
