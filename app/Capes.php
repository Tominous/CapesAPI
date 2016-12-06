<?php

namespace CapesAPI;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Capes extends Model
{
    use SoftDeletes;

    protected $table = 'capes';

    protected $fillable = [
    	'project_id',
    	'hash',
    	'name',
    	'template'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
