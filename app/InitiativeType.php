<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class InitiativeType extends Model
{
    use Translatable;
    

    /**
     * Array with the fields translated in the Translation table.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];


    /**
     * Get the type initiatives.
     */
    public function initiatives()
    {
        return $this->hasMany('App\Initiative');
    }

    /**
     * Get the translations for the category.
     *
     * @return App\InitiativeTypeTranslation|null
     */
    public function typeTranslations()
    {
        return $this->hasMany('App\InitiativeTypeTranslation');
    }
}
