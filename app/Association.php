<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Association extends Model
{
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'latitude',
        'longitude',
        'address',
        'input_map_data',
        'phone_1',
        'phone_2',
        'website',
        'email',
        'is_published',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * Get the user that owns the association.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The association images.
     *
     * @return App\AssociationImage|null
     */
    public function images()
    {
        return $this->hasMany('App\AssociationImage');
    }
}
