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
    // recipe not receipts
    public function receipts(){
        return $this->belongsTo(Recette::class, 'recette_id' , 'id');
    }
    
}
