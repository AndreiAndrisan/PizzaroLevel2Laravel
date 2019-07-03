<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'id_order', 'id_produs', 'q_produs',
    ];
    public $timestamps = false;
    protected $table = 'comenzi';
}
