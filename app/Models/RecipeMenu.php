<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecipeMenu extends Model
{
    use HasFactory;

    public function menu(){
        $this->belongsTo(ItemMenu::class, 'menu_id' , 'id');
    }
    
    public function recettes(){
        return $this->belongsTo(Recette::class, 'recette_id' , 'id');
    }
    public function recettescategories(){
        return $this->hasManyThrough(RecetteCategory::class,Recette::class,'idCategorie','recette_id','id','id');
    }
    
}
