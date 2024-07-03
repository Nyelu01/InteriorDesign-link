<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignRequirement extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_location',
        'project_grade',
        'service_type',
        'project_type',
        'description',
        'client_id',
        'project_id',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function requirements()
    {
        return $this->hasMany(BudgetItem::class);
    }


}
