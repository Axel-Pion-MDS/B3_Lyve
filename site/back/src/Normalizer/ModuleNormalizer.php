<?php

namespace App\Normalizer;

class ModuleNormalizer
{
    public static function listNormalizer(array $data): array
    {
        $list = [];
        foreach ($data as $module) {
            $list[] = [
                'id' => $module->getId(),
                'title' => $module->getTitle(),
                'content' => $module->getContent(),
            ];
        }

        return $list;
    }

    public static function showNormalizer(object $data): array
    {
        $offers = [];
        foreach ($data->getOffers() as $offer) {
            $offers[] = [
                'id' => $offer->getId(),
                'label' => $offer->getTitle(),
            ];
        }

        $badges = [];
        foreach ($data->getBadges() as $badge) {
            $badges[] = [
                'id' => $badge->getId(),
                'label' => $badge->getTitle(),
            ];
        }

        $module[] = [
            'id' => $data->getId(),
            'title' => $data->getTitle(),
            'content' => $data->getContent(),
            'offers' => $offers,
            'badges' => $badges
        ];

        return $module;
    }
}
