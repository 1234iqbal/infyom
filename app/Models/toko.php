<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class toko
 * @package App\Models
 * @version January 8, 2020, 4:23 am UTC
 *
 * @property One to Many
 * @property string name
 * @property integer id_user
 */
class toko extends Model
{
    use SoftDeletes;

    public $table = 'tokos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'id_user'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'id_user' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_user' => 'required'
    ];

    
}
