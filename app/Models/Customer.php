<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected function initials(): Attribute
    {
        return Attribute::make(
            get: fn () => mb_substr($this->first_name, 0, 1) . mb_substr($this->last_name, 0, 1),
        );
    }
}
