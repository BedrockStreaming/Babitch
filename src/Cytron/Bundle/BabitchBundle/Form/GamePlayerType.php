<?php

namespace Cytron\Bundle\BabitchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

use Cytron\Bundle\BabitchBundle\Entity\Game;
use Cytron\Bundle\BabitchBundle\Entity\GamePlayer;

/**
 * Class GamePlayerType
 */
class GamePlayerType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('team', 'choice', array(
                'choices' => array(GamePlayer::getAllowedTeams())
            ))
            ->add('position', 'choice', array(
                'choices' => array(GamePlayer::getAllowedPositions())
            ))
            ->add('player_id', 'entity', array(
                'empty_value'   => 'Select player',
                'property_path' => 'player',
                'class'         => 'CytronBabitchBundle:Player',
                'property'      => 'name',
            ));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cytron\Bundle\BabitchBundle\Entity\GamePlayer',
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'game_player';
    }
}
 
