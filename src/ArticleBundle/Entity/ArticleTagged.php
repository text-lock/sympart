<?php
// src/ArticleBundle/Entity/ArticleTagged.php
namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
*/
class ArticleTagged extends Article
{
    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="articles")
     * @ORM\JoinTable(name="articles_tags",)
     * @Assert\Count(
     *      min = "1",
     *      max = "3",
     *      minMessage = "You must specify at least one tag",
     *      maxMessage = "You cannot specify more than {{ limit }} tags"
     * )
     */
    private $tags;

    public function __construct() {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());   
    }

    /**
     * Add tags
     *
     * @param \ArticleBundle\Entity\Tag $tags
     * @return ArticleTagged
     */
    public function addTag(\ArticleBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \ArticleBundle\Entity\Tag $tags
     */
    public function removeTag(\ArticleBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }


}
