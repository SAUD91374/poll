<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class multiplechoice extends Model
{
    use HasFactory;
    protected $fillable=['title','method','description','layout','images','images_list','vote_per_ip','require_names','other_option_vote','other_option_results'];
        // Polymorphic relationship: An image poll has many votes
        public function votes()
        {
            return $this->morphMany(vote::class, 'pollable');
        }
}
