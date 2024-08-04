<?php

namespace App\Service;

use App\Enums\CountriesEnum;
use Illuminate\Support\Facades\Log;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;

class PhoneCountry
{
    public static function defineCountry(string $phone): CountriesEnum
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $countryCode = 0;

        try {
            // Парсинг номера телефона
            $numberProto = $phoneUtil->parse($phone);

            // Получение кода страны
            $countryCode = $numberProto->getCountryCode();
        } catch (NumberParseException $e) {
            Log::alert('Не найдена страна для номера телефона ' . $phone . '. Текст ошибки: ' . $e->getMessage());
        }

        return CountriesEnum::tryFrom($countryCode);
    }
}