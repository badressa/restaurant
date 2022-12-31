<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory;

    public function idreceipts(){
        return $this->hasMany(RecipeMenu::class, 'recette_id' , 'id');
    }

    public function recetteingrediants(){
        return $this->hasMany(ReceiptIngrediant::class, 'recette_id' , 'id');
    }
    public function ingrediants(){
        return $this->belongsToMany(Ingredient::class, 'receipt_ingrediants','recette_id','ingredient_id');
    }
}
