<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
class ErrorItem extends Model
{
     use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];//
    // Define the many-to-many relationship
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
