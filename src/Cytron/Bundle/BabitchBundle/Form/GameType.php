<?php

namespace Cytron\Bundle\BabitchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Cytron\Bundle\BabitchBundle\Entity\Game;

/**
 * Class GameType
 */
class GameType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('blue_score', 'integer')
            ->add('red_score', 'integer')
            ->add('player', 'collection', array(
                'property_path' => 'gamePlayers',
                'type'          => new GamePlayerType(),
                'allow_add'     => true,
                'allow_delete'  => true,
                'by_reference'  => false,
            ))
            ->add('goals', 'collection', array(
                'type'          => new GoalType(),
                'allow_add'     => true,
                'allow_delete'  => true,
                'by_reference'  => false,
            ));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cytron\Bundle\BabitchBundle\Entity\Game',
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'game';
    }
}
 
