<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'max_images';
    protected $primaryKey = 'img_id';
    protected $fillable = ['name','path','url'];
}