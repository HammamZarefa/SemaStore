<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceCoupon extends Model
{
    use HasFactory;
    protected  $fillable=['qr_code','code','balance','status'];
}
