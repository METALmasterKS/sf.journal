<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Form\DataTransformer\StringToTagTransformer;
use Doctrine\Common\Persistence\ObjectManager;

class PostType extends AbstractType
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('name')
            ->add('text')
            ->add('date')
        ;
        
        if ($options['type'] == 'auth') {
            $builder->add('props', PropsType::class);
        } else {
            $builder
                ->add('tags', TextType::class, [
                    'required' => false,
                ]);

            $builder->get('tags')
                ->addModelTransformer( new StringToTagTransformer($this->manager));
        }
        
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Post',
            'type' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_post';
    }


}
