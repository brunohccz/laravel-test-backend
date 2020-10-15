<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_email',
        'title',
        'description',
        'status'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'address', 'features'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Property status
     */
    public const AVAILABLE = 1;

    /**
     * Property status
     */
    public const UNAVAILABLE = 0;

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot() {
        parent::boot();

        static::deleting(function ($property) {
            if ($property->contract !== null) {
                $property->contract->delete();
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function features()
    {
        return $this->hasMany(PropertyFeature::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    /**
     * Address formatted
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return "{$this->address->street}, {$this->address->number}, {$this->address->city}, {$this->address->state}";
    }
}
