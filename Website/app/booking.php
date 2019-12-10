<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    protected $fillable = [
        'fullName','email','phone', 'icNum','checkInDate','checkOutDate','remark','adult','child',
        'roomNo','totalPrice'
       ];
}
