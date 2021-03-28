<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    protected $table ='tree_path';

    protected $fillable =
    [
        'parent',
        'child',
    ];
}
