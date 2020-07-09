<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'max_users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['nickname','email','phone'];
}