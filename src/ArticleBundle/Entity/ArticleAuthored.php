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
    private $author;

   /**
     * Constructor
     */
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());   
    }

    /**
     * Set author
     *
     * @param \ArticleBundle\Entity\Author $author
     *
     * @return ArticleAuthored
     */
    public function setAuthor(\ArticleBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \ArticleBundle\Entity\Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

  
}
