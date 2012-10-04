<?php

namespace Pff\ServiceProvider\AcceptHeaderServiceProvider;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class KernelListener implements EventSubscriberInterface
{
    public static function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->getRequest()->headers->get('Accept') != '')
        {
            $raw_accepts = explode(',', $event->getRequest()->headers->get('Accept'));

            $accepts = array_map(function($line) { return trim($line); }, $raw_accepts);

            $event->getRequest()->request->set('_accept', $accepts);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(KernelEvents::REQUEST => array('onKernelRequest', 100));
    }

}
