<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LegalService extends Model
{
    use SoftDeletes;

    protected $guarded = [];
}
