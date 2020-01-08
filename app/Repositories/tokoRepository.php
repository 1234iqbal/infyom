<?php

namespace App\Repositories;

use App\Models\toko;
use App\Repositories\BaseRepository;

/**
 * Class tokoRepository
 * @package App\Repositories
 * @version January 8, 2020, 4:23 am UTC
*/

class tokoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'id_user'
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
        return toko::class;
    }
}
