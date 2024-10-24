<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Services\ImageConfigServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class RequestSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private Environment $twig,
        private ImageConfigServiceInterface $configurationService,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => [
                ['setTwigGlobals', 10],
            ],
        ];
    }

    public function setTwigGlobals(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $this->twig->addGlobal('image_host', $this->configurationService->getImageHost());
    }
}
