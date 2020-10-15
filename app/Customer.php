<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'type',
        'document'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'integer'
    ];

    /**
     * Person type
     */
    public const NATURAL_PERSON = 0;

    /**
     * Person type
     */
    public const LEGAL_PERSON = 1;

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot() {
        parent::boot();

        static::deleting(function ($customer) {
            $customer->contracts->each(function ($contract) {
                $contract->delete();
            });
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
