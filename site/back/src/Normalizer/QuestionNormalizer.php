<?php

namespace App\Normalizer;

class QuestionNormalizer
{
    public static function listNormalizer(array $data): array
    {
        $list = [];
        foreach ($data as $question) {
            $list[] = [
                'id' => $question->getId(),
                'question' => $question->getQuestion(),
            ];
        }

        return $list;
    }

    public static function showNormalizer(object $data): array
    {
        $question[] = [
            'id' => $data->getId(),
            'question' => $data->getQuestion(),
            'part' => [
                'id' => $data->getPart()->getId(),
                'label' => $data->getPart()->getTitle(),
            ],
        ];

        return $question;
    }
}
