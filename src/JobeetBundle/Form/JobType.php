<?php

namespace JobeetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class JobType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type')->add('company')->add('description')
        ->add('isActivated',CheckboxType::class,array('label' => false,'disabled' => true,'attr' => array('style' => 'display:none' )))
        ->add('expiresAt',DateType::class,array('label' => false, 'format' => 'dd-MM-yyyy','disabled' => true ,'attr' => array('style' => 'display:none')))
        ->add('email')->add('category')->add('ville');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JobeetBundle\Entity\Job'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jobeetbundle_job';
    }


}
