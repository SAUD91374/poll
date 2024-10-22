<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ranking extends Model
{
    use HasFactory;
    protected $fillable=['title','description','method','options','vote_per_ip','require_names','other_option_vote','other_option_results'];
        // Polymorphic relationship: An image poll has many votes
        public function votes()
        {
            return $this->morphMany(vote::class, 'pollable');
        }
}
