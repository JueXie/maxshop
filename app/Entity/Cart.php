<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'max_cart';
    protected $primaryKey = 'cart_id';
}
