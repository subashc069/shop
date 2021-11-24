<?php

namespace Domains\Customer\Models;

use Database\Factories\LocationFactory;
use Domains\Customer\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasUuid;
    use HasFactory;

    protected $fillable = [
        'uuid',
        'house',
        'street',
        'parish',
        'ward',
        'district',
        'county',
        'postcode',
        'country',
    ];

    /**
     * Create a new factory instancefor the model.
     * @return LocationFactory
     */
    protected  static function newFactory()
    {
        return new LocationFactory();
    }
}
