<?php

namespace App\Repositories;

use App\Models\pelanggan;
use App\Repositories\BaseRepository;

/**
 * Class pelangganRepository
 * @package App\Repositories
 * @version January 8, 2020, 4:20 am UTC
*/

class pelangganRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return pelanggan::class;
    }
}
