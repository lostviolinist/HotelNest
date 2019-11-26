<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name', 'checkInTime','checkOutTime','city','address','star','operationTime','description'
       ];
}
