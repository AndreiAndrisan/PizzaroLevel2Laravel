<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
    	'nume', 'pret', 'descriere', 'categorie', 'imagine_front', 'imagine_single_product',
    ];
    public $timestamps = false;
    protected $table = 'produs';

    public function category()						
    {
    	return $this->belongsTo(Category::class);
    }

    public function order()						
    {
    	return $this->belongsToMany(Order::class, 'comenzi', 'id_produs', 'id_order')->withPivot('q_produs');
    }
}
