<?php

namespace AppBundle\Serializer;

use AppBundle\Model\Product;
use AppBundle\Service\DiscountManager;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\JsonSerializationVisitor;

class ProductSerializerSubscriber implements EventSubscriberInterface
{
    private $discountManager;

    public function __construct(DiscountManager $discountManager)
    {
        $this->discountManager = $discountManager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            array(
                'event' => 'serializer.post_serialize',
                'method' => 'onPostSerialize',
                'class' => Product::class,
            ),
        );
    }

    public function onPostSerialize(ObjectEvent $event)
    {
        /** @var JsonSerializationVisitor $visitor */
        $visitor = $event->getVisitor();
        $visitor->setData('salesPrice', $this->discountManager->getDiscountedPrice($event->getObject()));
    }
}