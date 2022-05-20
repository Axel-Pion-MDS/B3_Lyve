<?php

namespace App\Normalizer;

class ChapterNormalizer
{
    public static function listNormalizer(array $data): array
    {
        $list = [];
        foreach ($data as $chapter) {
            $list[] = [
                'id' => $chapter->getId(),
                'title' => $chapter->getTitle(),
                'content' => $chapter->getContent(),
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
            'module' => [
                'id' => $data->getModule()->getId(),
                'label' => $data->getModule()->getTitle(),
            ],
        ];

        return $chapter;
    }
}
