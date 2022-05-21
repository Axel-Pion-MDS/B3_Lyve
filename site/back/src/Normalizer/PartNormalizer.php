<?php

namespace App\Normalizer;

class PartNormalizer
{
    public static function listNormalizer(array $data): array
    {
        $list = [];
        foreach ($data as $part) {
            $list[] = [
                'id' => $part->getId(),
                'title' => $part->getTitle(),
                'content' => $part->getContent(),
            ];
        }

        return $list;
    }

    public static function showNormalizer(object $data): array
    {
        $chapter[] = [
            'id' => $data->getId(),
            'title' => $data->getTitle(),
            'content' => $data->getContent(),
            'chapter' => [
                'id' => $data->getChapter()->getId(),
                'label' => $data->getChapter()->getTitle(),
            ],
        ];

        return $chapter;
    }
}
