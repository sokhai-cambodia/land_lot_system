<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LandPayment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function priceAfterDiscount() {
        return $this->price - ( $this->price * $this->discount / 100 );
    }
}
