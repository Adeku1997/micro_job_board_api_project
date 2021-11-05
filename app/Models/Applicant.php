<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'email'
    ];

    public function jobs(): BelongsToMany
    {
      return $this->belongsToMany(Job::class)->withTimestamps();
    }
}
