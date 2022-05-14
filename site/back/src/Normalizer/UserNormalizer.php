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
        $badges = [];
        foreach ($data->getBadge() as $badge) {
            $badges[] = [
                'id' => $badge->getId(),
                'label' => $badge->getTitle(),
            ];
        }

        $user[] = [
            'id' => $data->getId(),
            'firstname' => $data->getFirstname(),
            'lastname' => $data->getLastname(),
            'email' => $data->getEmail(),
            'birthdate' => $data->getBirthdate()->format('Y-m-d'),
            'number' => $data->getNumber(),
            'role' => $data->getRole() ? [
                'id' => $data->getRole()->getId(),
                'label' => $data->getRole()->getTitle()
            ] : null,
            'offer' => $data->getOffer() ? [
                'id' => $data->getOffer()->getId(),
                'label' => $data->getOffer()->getTitle()
            ] : null,
            'badge' => $badges,
        ];

        return $user;
    }
}
