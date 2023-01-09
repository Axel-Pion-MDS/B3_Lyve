<?php

namespace App\Normalizer;

class AnswerNormalizer
{
    public static function listNormalizer(array $data): array
    {
        $list = [];
        foreach ($data as $question) {
            $list[] = [
                'id' => $question->getId(),
                'answer' => $question->getAnswer(),
            ];
        }

        return $list;
    }

    public static function showNormalizer(object $data): array
    {
        $users = [];
        if ($data->getUsers()) {
            foreach ($data->getUsers() as $user) {
                $users[] = [
                    'id' => $user->getId(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'email' => $user->getEmail(),
                ];
            }
        }

        $answer[] = [
            'id' => $data->getId(),
            'answer' => $data->getAnswer(),
            'isCorrect' => $data->getIsCorrect(),
            'question' => [
                'id' => $data->getQuestion()->getId(),
                'label' => $data->getQuestion()->getQuestion(),
            ],
            'users' => $users,
        ];

        return $answer;
    }
}
