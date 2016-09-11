<?php
// src/ArticleBundle/DataFixtures/ORM/ArticleAuthoredFixtures.php
namespace ArticleBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use ArticleBundle\Entity\ArticleAuthored;
use ArticleBundle\Entity\Author;

class ArticleAuthoredFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $article1 = new ArticleAuthored();
        $article1->setTitle('Hello world');
        $article1->setBody('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $article1->setAuthor($manager->merge($this->getReference('author-1')));
        $manager->persist($article1);

        $article2 = new ArticleAuthored();
        $article2->setTitle('Are you ready?');
        $article2->setBody('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $article2->setAuthor($manager->merge($this->getReference('author-1')));
        $manager->persist($article2);

        $article3 = new ArticleAuthored();
        $article3->setTitle('Hope, this is a good job!');
        $article3->setBody('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $article3->setAuthor($manager->merge($this->getReference('author-2')));
        $manager->persist($article3);

        $manager->flush();


                
    }

    public function getOrder()
    {
        return 2;
    }

}