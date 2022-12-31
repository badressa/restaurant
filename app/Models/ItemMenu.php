<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemMenu extends Model
{
    use HasFactory;

    public function idreceipts(){
        return $this->hasMany(RecipeMenu::class, 'menu_id' , 'id');
    }

}
