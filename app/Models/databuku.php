<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class databuku
 * @package App\Models
 * @version January 8, 2020, 6:13 am UTC
 *
 * @property string name
 * @property string alamat
 */
class databuku extends Model
{
    use SoftDeletes;

    public $table = 'databukus';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'alamat'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'alamat' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    
}
