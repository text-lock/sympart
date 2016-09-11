<?php
// src/ArticleBundle/DataFixtures/ORM/AuthorFixtures.php
namespace ArticleBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use ArticleBundle\Entity\Author;

class AuthorFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $author1 = new Author();
        $author1->setName('Nornik');
        $author1->setUrl("http://google.com");
        $manager->persist($author1);

        $author2 = new Author();
        $author2->setName('Lambda');
        $author2->setUrl("http://ya.ru");
        $manager->persist($author2);
        
        $manager->flush();

        $this->addReference('author-1', $author1);
        $this->addReference('author-2', $author2);

                
    }

    public function getOrder()
    {
        return 1;
    }

}