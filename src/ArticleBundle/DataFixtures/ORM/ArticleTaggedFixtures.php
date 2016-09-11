<?php
// src/ArticleBundle/DataFixtures/ORM/ArticleTaggedFixtures.php
namespace ArticleBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use ArticleBundle\Entity\ArticleTagged;
use ArticleBundle\Entity\Tag;

class ArticleTaggedFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $article1 = new ArticleTagged();
        $article1->setTitle('Hi, i am  tagged a little ');
        $article1->setBody('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $article1->addTag($manager->merge($this->getReference('tag-1')));
        $article1->addTag($manager->merge($this->getReference('tag-2')));
        $article1->addTag($manager->merge($this->getReference('tag-3')));
        $manager->persist($article1);

        $article2 = new ArticleTagged();
        $article2->setTitle('No?');
        $article2->setBody('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $article2->addTag($manager->merge($this->getReference('tag-3')));
        $article2->addTag($manager->merge($this->getReference('tag-4')));
        $manager->persist($article2);

        $article3 = new ArticleTagged();
        $article3->setTitle('Okay!');
        $article3->setBody('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $article3->addTag($manager->merge($this->getReference('tag-1')));
        $article3->addTag($manager->merge($this->getReference('tag-4')));
        $article3->addTag($manager->merge($this->getReference('tag-5')));
        $manager->persist($article3);

        $manager->flush();


                
    }

    public function getOrder()
    {
        return 2;
    }

}