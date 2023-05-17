<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card_gallery_image extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'gall_images',
    ];
}
