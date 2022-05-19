<?php

namespace App\Normalizer;

class BadgeNormalizer
{
    public static function listNormalizer(array $data): array
    {
        $list = [];
        foreach ($data as $badge) {
            $list[] = [
                'id' => $badge->getId(),
                'title' => $badge->getTitle(),
                'picture' => $badge->getPicture(),
            ];
        }

        return $list;
    }

    public static function showNormalizer(object $data): array
    {
        $users = [];
        foreach ($data->getUsers() as $user) {
            $users[] = [
                'id' => $user->getId(),
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                'email' => $user->getEmail(),
            ];
        }

        $modules = [];
        foreach ($data->getModules() as $module) {
            $modules[] = [
                'id' => $module->getId(),
                'label' => $module->getTitle(),
            ];
        }

        $badge[] = [
            'id' => $data->getId(),
            'title' => $data->getTitle(),
            'picture' => $data->getPicture(),
            'modules' => $modules,
            'users' => $users
        ];

        return $badge;
    }
}
