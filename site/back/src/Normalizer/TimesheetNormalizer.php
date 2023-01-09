<?php

namespace App\Normalizer;

class TimesheetNormalizer
{
    public static function listNormalizer(array $data): array
    {
        $list = [];
        foreach ($data as $timesheet) {

            $users = [];
            foreach ($timesheet->getUser() as $user) {
                $users[] = [
                    'id' => $user->getId(),
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'email' => $user->getEmail(),
                ];
            }

            $list[] = [
                'id' => $timesheet->getId(),
                'title' => $timesheet->getTitle(),
                'start' => $timesheet->getStartDate()->format('Y-m-d\TH:i'),
                'end' => $timesheet->getEndDate()->format('Y-m-d\TH:i'),
                'comment' => $timesheet->getComment(),
                'status' => $timesheet->getStatus()->getTitle(),
                'users' => $users,
            ];
        }

        return $list;
    }

    /**
     * Normalize user data
     *
     * @param object $data
     * @return array
     */
    public static function showNormalizer(object $data): array
    {
        $user = [];
        if ($data->getUser()) {
            foreach ($data->getUser() as $usr) {
                $user[] = [
                    'id' => $usr->getId(),
                    'firstname' => $usr->getFirstname(),
                    'lastname' => $usr->getLastname(),
                    'email' => $usr->getEmail(),
                ];
            }
        }

        $timesheet[] = [
            'id' => $data->getId(),
            'title' => $data->getTitle(),
            'start' => $data->getStartDate()->format('Y-m-d\TH:i'),
            'end' => $data->getEndDate()->format('Y-m-d\TH:i'),
            'comment' => $data->getComment(),
            'status' => $data->getStatus()->getTitle(),
            'users' => $user,
        ];

        return $timesheet;
    }
}
