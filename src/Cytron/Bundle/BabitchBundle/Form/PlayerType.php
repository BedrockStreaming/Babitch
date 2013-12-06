<?php

namespace Cytron\Bundle\BabitchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * PlayerType Form class
 */
class PlayerType extends AbstractType
{
    /**
     * Configures an Player form.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('email', 'text');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cytron\Bundle\BabitchBundle\Entity\Player',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'player';
    }
}
