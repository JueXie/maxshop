<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $table = 'max_user_meta';
    protected $primaryKey = 'u_meta_id';
    protected $fillable = ['meta_key','meta_value','user_id'];
}