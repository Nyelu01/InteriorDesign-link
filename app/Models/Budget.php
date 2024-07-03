<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'pdf_path',
        'designer_id'
    ];



        public function requirement(): BelongsTo
        {
            return $this->belongsTo(DesignRequirement::class, 'requirement_id');
        }




    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }



}
