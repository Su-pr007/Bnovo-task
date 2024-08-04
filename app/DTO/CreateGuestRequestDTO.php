<?php

namespace App\DTO;

use App\DTO\Exceptions\GuestNotFoundException;
use App\Http\Requests\Guests\GuestRequest;
use App\Models\Guest;

class CreateGuestRequestDTO
{
    private function __construct(
        private readonly string $name,
        private readonly string $surname,
        private readonly string $phone,
        private readonly string $email,
        private readonly string $country,
    )
    {}

    public static function createFromRequest(GuestRequest $request): self
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
    public function updateModel(string $id)
    {
        $model = Guest::find($id);
        if (!$model) {
            throw new GuestNotFoundException('Гость с id ' . $id . ' не найден');
        }
        $model->updateDataWithDTO($this);

        return $model;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}