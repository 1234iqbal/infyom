<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Buku
 * @package App\Models
 * @version January 8, 2020, 6:43 am UTC
 *
 * @property string name
 * @property integer nomer
 */
class Buku extends Model
{
    use SoftDeletes;

    public $table = 'bukus';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'nomer'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'nomer' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
