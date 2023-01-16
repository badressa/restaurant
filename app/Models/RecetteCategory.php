<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecetteCategory extends Model
{
    use HasFactory;

    public function recettes(){
        return $this->hasMany(Recette::class, 'idCategorie' , 'id');
    }

    public function recetteMenuCategories(){
        return $this->hasManyThrough(RecipeMenu::class, Recette::class,'idCategorie','recette_id','id','id');
    }
    
    
}
