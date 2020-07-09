<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'max_payment';
    protected $primaryKey = 'payment_id';
    protected $guarded = [];
}
