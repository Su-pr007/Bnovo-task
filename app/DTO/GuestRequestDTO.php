<?php

namespace App\DTO;

use App\DTO\Exceptions\GuestNotFoundException;
use Illuminate\Http\Request;
use App\Models\Guest;

readonly class GuestRequestDTO
{
    private function __construct(
        private ?string $name = '',
        private ?string $surname = '',
        private ?string $phone = '',
        private ?string $email = '',
        private ?string $country = '',
    )
    {}

    public static function createFromRequest(Request $request): self
    {
        return new self(
            $request->post('name'),
            $request->post('surname'),
            $request->post('phone'),
            $request->post('email'),
            $request->post('country'),
        );
    }

    public function createModel(): Guest
    {
        $model = new Guest;
        $model->updateDataWithDTO($this);

        return $model;
    }

    /**
     * @throws GuestNotFoundException
     */
    public function updateModel(string $id): Guest
    {
        $model = Guest::find($id);
        if (!$model) {
            throw new GuestNotFoundException('Гость с id ' . $id . ' не найден');
        }
        $model->updateDataWithDTO($this);

        return $model;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }
}