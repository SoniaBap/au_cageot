<?php

namespace App\Service;

use DateTime;
use DateTimeZone;
use Symfony\Contracts\Translation\TranslatorInterface;

class FooterService
{
    private $translator;
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    public function getVariables(): array
    {
        $footerMainMenu = [];
        $socialNetworksMenu = [
            0 => [
                'id' => 'facebook',
                'href' => 'https://www.facebook.com',
                'label' => $this->translator->trans('Facebook'),
                'icon' => 'facebook',
            ],
            1 => [
                'id' => 'twitter',
                'href' => 'https://twitter.com',
                'label' => $this->translator->trans('Twitter'),
                'icon' => 'twitter-x',
            ],
            2 => [
                'id' => 'instagram',
                'href' => 'https://www.instagram.com',
                'label' => $this->translator->trans('Instagram'),
                'icon' => 'instagram',
            ],
            3 => [
                'id' => 'youtube',
                'href' => 'https://www.youtube.com',
                'label' => $this->translator->trans('Youtube'),
                'icon' => 'youtube',
            ],
            4 => [
                'id' => 'mail',
                'href' => 'https://www.google.com',
                'label' => $this->translator->trans('Email'),
                'icon' => 'envelope-at-fill',
            ],
        ];

        $siteName = 'Crate Bar';
        $currentDate = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $currentYear = $currentDate->format('Y');
        $copyright = $currentYear . ' ' . $this->translator->trans('All right Reversed to') . ' ' . $siteName;

        $variables = [
            'copyright' => $copyright,
            'footer_main_menu' => $footerMainMenu,
            'social_networks_menu' => $socialNetworksMenu,
        ];

        return $variables;
    }
}
