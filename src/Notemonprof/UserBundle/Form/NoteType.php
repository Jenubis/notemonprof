<?php

namespace Notemonprof\UserBundle\Form;

use Notemonprof\UserBundle\Entity\Cours;
use Notemonprof\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\EntityRepository;

class NoteType extends AbstractType
{
    protected $user;
    protected $cours;
    function __construct(User $user,$cours)
    {
        $this->user=$user;
        $this->cours=$cours;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note','number')
            ->add('commentaire')
            ->add('cours','entity',array(
                'class' =>'Notemonprof\UserBundle\Entity\Cours',
                'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                           ->where('c.id = '.$this->cours) ; },
            ))



        ;
          }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Notemonprof\UserBundle\Entity\Note'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'notemonprof_userbundle_note';
    }
}
