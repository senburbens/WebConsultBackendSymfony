<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RequestStack;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;


class JWTCreatedListener
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $request = $this->requestStack->getCurrentRequest();

        $payload = $event->getData();
        $payload['ip'] = $request->getClientIp();


        // $expiration = new \DateTime('+1 day');
        // $expiration->setTime(2, 0, 0);
        // $payload['exp'] = $expiration->getTimestamp();

        $event->setData($payload);
        
        //$header = $event->getHeader();
        //$header['cty'] = 'JWT';
        //$event->setHeader($header);
    }
}