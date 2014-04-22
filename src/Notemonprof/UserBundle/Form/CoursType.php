<?php

namespace Notemonprof\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CoursType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('abrv')
            ->add('intitule')
            ->add('duree')
            ->add('date')
            ->add('user','entity',array(
        'class' => 'Notemonprof\UserBundle\Entity\User',
        'query_builder' => function(EntityRepository $er) use($options) {
                return $er->createQueryBuilder('u')
                    ->where('u.roles LIKE \'%PROF%\'')
                    ;
            }))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Notemonprof\UserBundle\Entity\Cours'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'notemonprof_userbundle_cours';
    }
}
