<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Job extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'description',
        'job_type',
        'work_conditions',
        'categories'
    ];

    public function applicants (): BelongsToMany
    {
       return $this->belongsToMany(Applicant::class)->withTimestamps();
    }
}
