<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveVisitCountry extends FormRequest
{
    private const PARAMETER_NAME_COUNTRY = 'country';

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            self::PARAMETER_NAME_COUNTRY => ['required', 'string', 'regex:/^[A-Z]{2}$/']
        ];
    }

    public function getCountryCode(): string
    {
        return (string)$this->string(self::PARAMETER_NAME_COUNTRY);
    }
}
