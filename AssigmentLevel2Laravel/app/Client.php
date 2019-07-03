<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
    	'nume', 'prenume', 'email', 'telefon', 'strada', 'adresa', 'oras', 'judet', 'observatii',
    ];
    public $timestamps = false;
    protected $table = 'client';

    public function order()						//a project consists of many tasks
    {
    	return $this->hasOne(Order::class, 'id_order');
    }

    public function products()						
    {
    	return $this->belongsToMany(Product::class, 'comenzi', 'id_order', 'id_produs')->withPivot('q_produs');
    }
}
