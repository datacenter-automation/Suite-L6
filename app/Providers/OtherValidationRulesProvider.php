<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OtherValidationRulesProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $rules = [
            'CitizenIdentificationValidation' => new \Alphametric\Validation\Rules\CitizenIdentification,
            'DecimalValidation'               => new \Alphametric\Validation\Rules\Decimal,
            'DisposableEmailValidation'       => new \Alphametric\Validation\Rules\DisposableEmail,
            'DoesNotExistValidation'          => new \Alphametric\Validation\Rules\DoesNotExist,
            'DomainValidation'                => new \Alphametric\Validation\Rules\Domain,
            'EncodedImageValidation'          => new \Alphametric\Validation\Rules\EncodedImage,
            'EndsWithValidation'              => new \Alphametric\Validation\Rules\EndsWith,
            'EqualsValidation'                => new \Alphametric\Validation\Rules\Equals,
            'EvenNumberValidation'            => new \Alphametric\Validation\Rules\EvenNumber,
            'FileExistsValidation'            => new \Alphametric\Validation\Rules\FileExists,
            'ISBNValidation'                  => new \Alphametric\Validation\Rules\ISBN,
            'LocationCoordinatesValidation'   => new \Alphametric\Validation\Rules\LocationCoordinates,
            'LowercaseValidation'             => new \Alphametric\Validation\Rules\Lowercase,
            'MacAddressValidation'            => new \Alphametric\Validation\Rules\MacAddress,
            'MonetaryFigureValidation'        => new \Alphametric\Validation\Rules\MonetaryFigure,
            'OddNumberValidation'             => new \Alphametric\Validation\Rules\OddNumber,
            'RecordOwnerValidation'           => new \Alphametric\Validation\Rules\RecordOwner,
            'StrongPasswordValidation'        => new \Alphametric\Validation\Rules\StrongPassword,
            'TelephoneNumberValidation'       => new \Alphametric\Validation\Rules\TelephoneNumber,
            'TitlecaseValidation'             => new \Alphametric\Validation\Rules\Titlecase,
            'UppercaseValidation'             => new \Alphametric\Validation\Rules\Uppercase,
            'WithoutWhitespaceValidation'     => new \Alphametric\Validation\Rules\WithoutWhitespace,
        ];

        foreach ($rules as $key => $value) {
            $this->app->singleton($key, fn() => $value);
        }
    }
}
