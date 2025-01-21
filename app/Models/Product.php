<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'qr_code_path'];
protected $casts = [
    'checkbox_items' => 'array',
    ];
 public function errorItems()
    {
        return $this->belongsToMany(ErrorItem::class);
    }
}
