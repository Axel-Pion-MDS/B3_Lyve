<?php

namespace App\Normalizer;

class UserNormalizer {
    public static function listNormalizer(array $data): array
    {
        $list = [];

        foreach ($data as $user) {
            $list[] = [
                'id' => $user->getId(),
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail(),
            ];
        }

        return $list;
    }

    public static function showNormalizer(object $data): array
    {
        $user[] = [
            'id' => $data->getId(),
            'firstname' => $data->getFirstname(),
            'lastname' => $data->getLastname(),
            'email' => $data->getEmail(),
            'birthdate' => $data->getBirthdate(),
            'number' => $data->getNumber(),
            'role' => $data->getRole() ? $data->getRole()->getTitle() : null,
            'offer' => $data->getOffer() ? $data->getOffer()->getTitle() : null,
        ];

        return $user;
    }
}
