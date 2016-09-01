<?php

namespace ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('email', 'email')
             ->add('username')
             ->add('plainPassword', 'password')
             ->add('password', 'password')
    //           "id": 1,
    // "username": "admin",
    // "username_canonical": "admin",
    // "email": "admin@example.com",
    // "email_canonical": "admin@example.com",
    // "enabled": true,
        ;
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'ApiBundle\Entity\User',
                'csrf_protection' => false,
                'allow_extra_fields' => true
            )
        );
    }

    public function getName()
    {
        return 'user';
    }
}
