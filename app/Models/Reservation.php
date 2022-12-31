<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    public function client(){
        return $this->belongsTo(User::class, 'client_id' , 'id');
    }
    // recipe not receipts
    public function table(){
        return $this->belongsTo(Table::class, 'table_id' , 'id');
    }
}
