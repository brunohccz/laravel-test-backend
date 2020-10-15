<?php

namespace App\Rules;

use Bissolli\ValidadorCpfCnpj\Documento;
use Illuminate\Contracts\Validation\Rule;

class Document implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $document = new Documento($value);

        return $document->isValid();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CPF or CNPJ is invalid.';
    }
}
