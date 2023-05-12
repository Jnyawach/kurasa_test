<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable=['name','town','country', 'supermarket_id'];

    public function  supermarket(){
        return $this->belongsTo(Supermarket::class);
    }
}
