<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Iuran extends Model
{
    use Uuid;
    public $incrementing = false;
    protected $guarded = [];

    protected $hidden = [
        'updated_at'
    ];
}
