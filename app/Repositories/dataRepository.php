<?php

namespace App\Repositories;

use App\Models\data;
use App\Repositories\BaseRepository;

/**
 * Class dataRepository
 * @package App\Repositories
 * @version January 8, 2020, 5:07 am UTC
*/

class dataRepository extends BaseRepository
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
        return data::class;
    }
}
