<?php

namespace CapesAPI;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveCapes extends Model
{
    use SoftDeletes;

    protected $table = 'active_capes';
    protected $appends = ['username'];
    protected $fillable = [
        'uuid',
        'cape_hash',
        'active',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
