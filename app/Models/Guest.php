<?php

namespace App\Models;

use App\DTO\CreateGuestRequestDTO;
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

    public function updateDataWithDTO(CreateGuestRequestDTO $param): self
    {
        $this->name = $param->getName();
        $this->surname = $param->getSurname();
        $this->phone = $param->getPhone();
        $this->email = $param->getEmail();
        $this->country = $param->getCountry();

        $this->save();

        return $this;
    }
}
