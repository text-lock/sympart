<?php
// src/ArticleBundle/DataFixtures/ORM/TagFixtures.php
namespace ArticleBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use ArticleBundle\Entity\Tag;

class TagFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tag1 = new Tag();
        $tag1->setTitle('Hi');
        $manager->persist($tag1);

        $tag2 = new Tag();
        $tag2->setTitle('By');
        $manager->persist($tag2);

        $tag3 = new Tag();
        $tag3->setTitle('Well');
        $manager->persist($tag3);

        $tag4 = new Tag();
        $tag4->setTitle('Bell');
        $manager->persist($tag4);

        $tag5 = new Tag();
        $tag5->setTitle('Hell');
        $manager->persist($tag5);
        
        $manager->flush();

        $this->addReference('tag-1', $tag1);
        $this->addReference('tag-2', $tag2);
        $this->addReference('tag-3', $tag3);
        $this->addReference('tag-4', $tag4);
        $this->addReference('tag-5', $tag5);

                
    }

    public function getOrder()
    {
        return 1;
    }

}