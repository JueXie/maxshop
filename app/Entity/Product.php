<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'max_products';
    protected $primaryKey = 'product_id';
}