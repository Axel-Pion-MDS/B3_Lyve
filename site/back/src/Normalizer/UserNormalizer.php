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
        if ($data->getBadges()) {
            foreach ($data->getBadges() as $badge) {
                $badges[] = [
                    'id' => $badge->getId(),
                    'label' => $badge->getTitle(),
                ];
            }
        }

        $answers = [];
        if ($data->getAnswers()) {
            foreach ($data->getAnswers() as $answer) {
                $answers[] = [
                    'id' => $answer->getId(),
                    'answer' => $answer->getAnswer(),
                    'isCorrect' => $answer->getIsCorrect(),
                ];
            }
        }

        $user[] = [
            'id' => $data->getId(),
            'firstname' => $data->getFirstname(),
            'lastname' => $data->getLastname(),
            'email' => $data->getEmail(),
            'birthdate' => $data->getBirthdate()->format('Y-m-d'),
            'number' => $data->getNumber(),
            'role' => $data->getRoles(),
            'offer' => $data->getOffer() ? [
                'id' => $data->getOffer()->getId(),
                'label' => $data->getOffer()->getTitle()
            ] : null,
            'badges' => $badges,
            'answers' => $answers,
            'createdAt' => $data->getCreatedAt()->format('Y-m-d')
        ];

        return $user;
    }

    public static function timesheetNormalizer(object $data): array {

        $timesheets = [];
        if ($data->getTimesheets()) {
            foreach ($data->getTimesheets() as $ts) {
                $timesheets[] = [
                    'id' => $ts->getId(),
                    'title' => $ts->getTitle() . ' [' . $ts->getStatus()->getTitle() . ']',
                    'startDate' => $ts->getStartDate()->format('Y-m-d\TH:i'),
                    'endDate' => $ts->getEndDate()->format('Y-m-d\TH:i'),
                    'comment' => $ts->getComment(),
                ];
            }
        }

        $user[] = [
            'id' => $data->getId(),
            'firstname' => $data->getFirstname(),
            'lastname' => $data->getLastname(),
            'email' => $data->getEmail(),
            'timesheets' => $timesheets
        ];

        return $user;
    }
}
