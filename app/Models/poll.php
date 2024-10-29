<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class poll extends Model
{
    use HasFactory;
    protected $fillable=['user_id','title','method','image','description','options','others','vote_per_ip','require_names','other_option_vote','other_option_results'];

}
