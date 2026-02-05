<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['image', 'name', 'title', 'bio', 'sort_order'];
}
