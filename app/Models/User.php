<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'service_type',
        'project_type',
        'certificate',
        'business_licence',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's role.
     *
     * @param  int  $value
     * @return string
     */
    protected function role(): Attribute
    {
        return new Attribute(function ($value) {
            $roles = ["designer", "vendor"];
            return isset($roles[$value]) ? $roles[$value] : "unknown"; // Fallback to "unknown" if $value is out of range.
        });
    }


    /**
     * Get the user's purchases.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    /**
     * Get the user's sold products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sellProduct()
    {
        return $this->hasMany(Product::class, 'user_id')->orderBy('created_at', 'DESC');
    }

    /**
     * Get the user's projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function created_by()
    {
        return $this->hasMany(Project::class, 'user_id');
    }

    public function requirements()
    {
        return $this->hasMany(DesignRequirement::class, 'user_id');
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class, 'designer_id');
    }

    public function items()
    {
        return $this->hasMany(BudgetItem::class, 'designer_id');
    }
}

