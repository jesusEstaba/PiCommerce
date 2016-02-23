<?php

namespace Pizza;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';


    protected $fillable = ['id_user', 'product_id','cooking_instructions'];

    public $timestamps = false;
}
