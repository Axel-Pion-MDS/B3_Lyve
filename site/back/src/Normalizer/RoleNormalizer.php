<?php

namespace App\Normalizer;

class RoleNormalizer {
    public static function listNormalizer(array $data): array
    {
        $list = [];
        foreach ($data as $role) {
            $list[] = [
                'id' => $role->getId(),
                'title' => $role->getTitle(),
            ];
        }

        return $list;
    }

    public static function showNormalizer(object $data): array
    {
        $role[] = [
            'id' => $data->getId(),
            'title' => $data->getTitle()
        ];

        return $role;
    }
}
