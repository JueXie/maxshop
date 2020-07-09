<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'max_order';
    protected $primaryKey = 'order_id';
    protected $guarded = [];//批量修改黑名单
}
