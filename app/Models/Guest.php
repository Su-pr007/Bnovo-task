<?php

namespace App\Models;

use App\DTO\GuestRequestDTO;
use App\Enums\CountriesEnum;
use App\Service\PhoneCountry;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $table = 'guests';
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'country',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($query) {
            $country = $query->country
                ? CountriesEnum::tryFrom(strtoupper($query->country))
                : PhoneCountry::defineCountry($query->phone);

            $query->country = $country->value;
        });
    }

    public function updateDataWithDTO(GuestRequestDTO $param): self
    {
        $this->name = $param->getName() ?? $this->name;
        $this->surname = $param->getSurname() ?? $this->surname;
        $this->phone = $param->getPhone() ?? $this->phone;
        $this->email = $param->getEmail() ?? $this->email;
        $this->country = $param->getCountry() ?? $this->country;

        $this->save();

        return $this;
    }
}
