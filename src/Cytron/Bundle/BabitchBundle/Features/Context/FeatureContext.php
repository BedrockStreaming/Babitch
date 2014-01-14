<?php

namespace Cytron\Bundle\BabitchBundle\Features\Context;

use Behat\Behat\Context\BehatContext;
use Sanpi\Behatch\Context\BehatchContext;
use Behat\MinkExtension\Context\MinkContext;

/**
* FeatureContext
*/
class FeatureContext extends BehatContext
{
    /**
    * @{inheritdoc}
    */
    public function __construct(array $parameters)
    {
        $this->useContext('mink', new MinkContext($parameters));
        $this->useContext('behatch', new BehatchContext($parameters));
    }
}
