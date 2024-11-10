<?php

namespace models;

use DateTime;

class User extends Model
{
    public function __construct(
        public readonly string        $name,
        public readonly string        $email,
        public readonly string        $password,
        public readonly DateTime|null $register_date = null,
        public readonly int|null      $id = null,
    ) {
    }

    public static function fromArray(array $data): static {
        return new self(
            $data['name'],
            $data['email'],
            $data['password'],
            new DateTime($data['register_date']),
            $data['id'],
        );
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}