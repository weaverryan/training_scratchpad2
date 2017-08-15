<?php

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;

require __DIR__.'/vendor/autoload.php';

$kernel = new AppKernel('dev', true);
$kernel->boot();

$container = $kernel->getContainer();

$cat1 = new Category();
$cat1->name = 'Electronics';

$cat2 = new Category();
$cat2->name = 'Baby';

$cat3 = new Category();
$cat3->name = 'Musical Instruments';

$prod1 = new Product();
$prod1->name = 'Amazon Echo';
$prod1->price = 179.99;
$prod1->description = 'Alexa... are you spying on me?';

$prod2 = new Product();
$prod2->name = 'Trombone';
$prod2->price = 500;
$prod2->description = 'The most excellent of the brass';

$prod3 = new Product();
$prod3->name = '500 Diapers';
$prod3->price = 50;
$prod3->description = '1 week\'s supply of diapers!';

/** @var EntityManager $em */
$em = $container->get('doctrine')->getManager();

$em->createQuery('DELETE FROM AppBundle:Category')->execute();
$em->createQuery('DELETE FROM AppBundle:Product')->execute();

$em->persist($cat1);
$em->persist($cat2);
$em->persist($cat3);
$em->persist($prod1);
$em->persist($prod2);
$em->persist($prod3);

$em->flush();
