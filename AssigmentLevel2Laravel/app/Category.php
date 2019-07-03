<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
    	'nume', 'clasa',
    ];
    public $timestamps = false;
    protected $table = 'categorie';

    public function products()						//a project consists of many tasks
    {
    	return $this->hasMany(Product::class);
    }
}
