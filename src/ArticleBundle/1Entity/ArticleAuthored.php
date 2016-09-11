<?php
// src/ArticleBundle/Entity/ArticleAuthored.php
namespace ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
*/
 
class ArticleAuthored extends Article
{
    
  
    /**
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="articles")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $authors;

    public function __construct() {
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add authors
     *
     * @param \ArticleBundle\Entity\Author $authors
     * @return ArticleAuthored
     */
    public function addAuthor(\ArticleBundle\Entity\Author $authors)
    {
        $this->authors[] = $authors;

        return $this;
    }

    /**
     * Remove authors
     *
     * @param \ArticleBundle\Entity\Author $authors
     */
    public function removeAuthor(\ArticleBundle\Entity\Author $authors)
    {
        $this->authors->removeElement($authors);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set authors
     *
     * @param \ArticleBundle\Entity\Author $authors
     * @return ArticleAuthored
     */
    public function setAuthors(\ArticleBundle\Entity\Author $authors = null)
    {
        $this->authors = $authors;

        return $this;
    }
}
