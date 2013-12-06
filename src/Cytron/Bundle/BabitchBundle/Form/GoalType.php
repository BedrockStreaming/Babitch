<?php

namespace Cytron\Bundle\BabitchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Cytron\Bundle\BabitchBundle\Entity\Goal;

/**
 * GoalType Form class
 */
class GoalType extends AbstractType
{
    /**
     * Configures an Goal form.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('position', 'choice', array(
                'choices' => array(Goal::getAllowedPositions())
            ))
            ->add('player_id', 'entity', array(
                'empty_value'   => 'Select player',
                'property_path' => 'player',
                'class'         => 'CytronBabitchBundle:Player',
                'property'      => 'name',
            ))
            ->add('conceder_id', 'entity', array(
                'empty_value'   => 'Select player',
                'property_path' => 'conceder',
                'class'         => 'CytronBabitchBundle:Player',
                'property'      => 'name',
            ))
            ->add('autogoal', 'checkbox');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cytron\Bundle\BabitchBundle\Entity\Goal',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'goal';
    }
}
