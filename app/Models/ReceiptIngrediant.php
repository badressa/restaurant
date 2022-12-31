<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptIngrediant extends Model
{
    use HasFactory;

    public function ingrediant(){
        return $this->belongsTo(Ingredient::class, 'ingredient_id' , 'id'); 
    }

}
