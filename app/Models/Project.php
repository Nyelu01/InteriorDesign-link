<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'project_location',
        'project_grade',
        'service_type',
        'project_type',
        'total_budget',
        'description',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }


    public function requirements() {
        return $this->hasMany(DesignRequirement::class, 'project_id');

    }


}
