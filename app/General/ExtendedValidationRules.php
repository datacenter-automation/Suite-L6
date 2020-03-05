<?php

namespace App\General;

use Alphametric\Validation\Rules\ISBN;
use Alphametric\Validation\Rules\Domain;
use Alphametric\Validation\Rules\Equals;
use Alphametric\Validation\Rules\Decimal;
use Alphametric\Validation\Rules\EndsWith;
use Alphametric\Validation\Rules\Lowercase;
use Alphametric\Validation\Rules\OddNumber;
use Alphametric\Validation\Rules\Titlecase;
use Alphametric\Validation\Rules\Uppercase;
use Alphametric\Validation\Rules\EvenNumber;
use Alphametric\Validation\Rules\FileExists;
use Alphametric\Validation\Rules\MacAddress;
use Alphametric\Validation\Rules\RecordOwner;
use Alphametric\Validation\Rules\DoesNotExist;
use Alphametric\Validation\Rules\EncodedImage;
use Alphametric\Validation\Rules\MonetaryFigure;
use Alphametric\Validation\Rules\StrongPassword;
use Alphametric\Validation\Rules\DisposableEmail;
use Alphametric\Validation\Rules\TelephoneNumber;
use Alphametric\Validation\Rules\WithoutWhitespace;
use Alphametric\Validation\Rules\LocationCoordinates;
use Alphametric\Validation\Rules\CitizenIdentification;

class ExtendedValidationRules
{
    public function __construct()
    {
        $rules = [
            'CitizenIdentificationValidation' => new CitizenIdentification,
            'DecimalValidation'               => new Decimal,
            'DisposableEmailValidation'       => new DisposableEmail,
            'DoesNotExistValidation'          => new DoesNotExist,
            'DomainValidation'                => new Domain,
            'EncodedImageValidation'          => new EncodedImage,
            'EndsWithValidation'              => new EndsWith,
            'EqualsValidation'                => new Equals,
            'EvenNumberValidation'            => new EvenNumber,
            'FileExistsValidation'            => new FileExists,
            'ISBNValidation'                  => new ISBN,
            'LocationCoordinatesValidation'   => new LocationCoordinates,
            'LowercaseValidation'             => new Lowercase,
            'MacAddressValidation'            => new MacAddress,
            'MonetaryFigureValidation'        => new MonetaryFigure,
            'OddNumberValidation'             => new OddNumber,
            'RecordOwnerValidation'           => new RecordOwner,
            'StrongPasswordValidation'        => new StrongPassword,
            'TelephoneNumberValidation'       => new TelephoneNumber,
            'TitlecaseValidation'             => new Titlecase,
            'UppercaseValidation'             => new Uppercase,
            'WithoutWhitespaceValidation'     => new WithoutWhitespace,
        ];

        foreach ($rules as $key => $value) {
            $this->app->singleton($key, function ($app) use ($value) {
                return $value;
            });
        }
    }
}
