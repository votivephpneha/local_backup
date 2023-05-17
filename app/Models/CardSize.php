<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_type',
        'card_size',  
        'card_id'  ,
        'card_size_qty',
        'card_price',   
    ];

    public function card(){
        return $this->belongsTo(Card::class,'card_id');
    }
}
