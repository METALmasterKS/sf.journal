<?php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToTagTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an collection (tags) to a string (implode of names).
     *
     * @param  Collection|null $tags
     * @return string
     */
    public function transform($tags)
    {
        if (!($tags instanceof \Doctrine\Common\Collections\Collection)) 
            return '';

        return implode(', ', array_map(function($tag) { return (string) $tag; }, $tags->toArray()));
    }

    /**
     * Transforms a string (names) to an collection (tags).
     *
     * @param  string $tagNames
     * @return Collections|array
     */
    public function reverseTransform($string)
    {
        // no tag name? It's optional, so that's ok
        if (!$string) {
            return;
        }
        
        $tagNames = array_map('trim', explode(',', $string));

        $tags = $this->manager
            ->getRepository(Tag::class)
            ->findBy(['name' => $tagNames])
        ;
        $existNames = array_map(function($tag) {
            return $tag->getName();
        }, $tags);
        
        $notExistNames = array_diff($tagNames, $existNames);
        
        foreach ($notExistNames as $name){
            $tag = new Tag();
            $tag->setName($name);
            $this->manager->persist($tag);
            $tags[] = $tag;
        }
        $this->manager->flush();
        
        return $tags;
    }
}