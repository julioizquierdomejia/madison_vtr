<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use getID3;

class VideoDimension implements Rule
{
    protected $maxWidth;
    protected $maxHeight;

    public function __construct($maxWidth, $maxHeight)
    {
        $this->maxWidth = $maxWidth;
        $this->maxHeight = $maxHeight;
    }
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $getID3 = new getID3;

        // the value is an instance of UploadedFile
        $file = $getID3->analyze($value->getRealPath());

        $passes = true;

        if ($this->maxWidth >= $file['video']['resolution_x']
            || $this->maxHeight >= $file['video']['resolution_y']){
            $passes = false;
        }

        return $passes;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        //return 'The :attribute excess the dimensions.';
        return 'El video no cumple con las dimensiones especificadas (1280 x 720)';
    }
}