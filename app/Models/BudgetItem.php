<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'description', 'quantity', 'unit_price', 'total_price', 'designer_id', 'budget_id','requirement_id',
    ];

    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class, 'budget_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }


    public function requirement()
    {
        return $this->belongsTo(DesignRequirement::class, 'requirement_id'); // Update relationship method
    }

    // for filtering budget items per designrequirement
public static function getByRequirementId($requirementId)
{
    return static::where('requirement_id', $requirementId)->get();
}


}

