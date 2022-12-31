<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public function receipts(){
        return $this->hasMany(ReceiptIngrediant::class, 'ingredient_id' , 'id');
    }
}
