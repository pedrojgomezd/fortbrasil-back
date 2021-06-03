<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $fillable = ['cnpj', 'razon_social'];

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
