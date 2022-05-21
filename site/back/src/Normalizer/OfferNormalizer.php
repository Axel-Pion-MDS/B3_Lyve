<?php

namespace App\Normalizer;

class OfferNormalizer
{
    public static function listNormalizer(array $data): array
    {
        $list = [];
        foreach ($data as $offer) {
            $list[] = [
                'id' => $offer->getId(),
                'title' => $offer->getTitle(),
                'price' => $offer->getPrice(),
            ];
        }

        return $list;
    }

    public static function showNormalizer(object $data): array
    {
        $modules = [];
        if ($data->getModules()) {
            foreach ($data->getModules() as $module) {
                $modules[] = [
                    'id' => $module->getId(),
                    'label' => $module->getTitle(),
                ];
            }
        }

        $offer[] = [
            'id' => $data->getId(),
            'title' => $data->getTitle(),
            'price' => $data->getPrice(),
            'modules' => $modules,
        ];

        return $offer;
    }
}
