<?php

namespace App\EventListener;

use Random\RandomException;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final readonly class CartSessionIdListener
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    /**
     * @throws RandomException
     */
    #[AsEventListener(event: KernelEvents::REQUEST)]
    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        if (!$this->requestStack->getSession()->has('cart_id')) {
            $this->requestStack->getSession()->set('cart_id', bin2hex(random_bytes(16)));
        }
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}
