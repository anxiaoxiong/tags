<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    //
    /**
     * @var string 表
     */
    protected $table = 'tag';

    /**
     * @var array 软删除
     */
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'individual_id'];

}
