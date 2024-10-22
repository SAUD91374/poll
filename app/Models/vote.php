<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vote extends Model
{
    use HasFactory;
    protected $fillable=['ip_address','poll_name','title','selectedOption','votes'];
        // Polymorphic relationship: A vote belongs to a poll of any type
        public function pollable()
        {
            return $this->morphTo();
        }
}
