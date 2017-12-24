<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Props
 *
 * @ORM\Table(name="props")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Props
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\OneToOne(targetEntity="Post")
     * @ORM\JoinColumn(name="id", referencedColumnName="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $post;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255, nullable=true)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=2048, nullable=true)
     * 
     * @Assert\Url()
     */
    private $url;

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Props
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Props
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set post
     *
     * @param \AppBundle\Entity\Post $post
     *
     * @return Props
     */
    public function setPost(\AppBundle\Entity\Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \AppBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }
    
    public function setId($id) {
        $this->post = $id;
    }
}
