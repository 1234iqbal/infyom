<?php

namespace App\Repositories;

use App\Models\databuku;
use App\Repositories\BaseRepository;

/**
 * Class databukuRepository
 * @package App\Repositories
 * @version January 8, 2020, 6:13 am UTC
*/

class databukuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'alamat'
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
        return databuku::class;
    }
}
