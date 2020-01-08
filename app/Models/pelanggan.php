<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class pelanggan
 * @package App\Models
 * @version January 8, 2020, 4:20 am UTC
 *
 * @property alamat text textarea
 * @property string name
 */
class pelanggan extends Model
{
    use SoftDeletes;

    public $table = 'pelanggans';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
