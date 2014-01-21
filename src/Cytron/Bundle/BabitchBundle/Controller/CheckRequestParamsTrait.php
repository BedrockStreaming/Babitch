<?php

namespace Cytron\Bundle\BabitchBundle\Controller;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Vérification des paramètres de l'url
 *
 * @author Morgan Brunot <mbrunot.externe@m6.fr>
 */
trait CheckRequestParamsTrait
{
    /**
     * @param array $allowedFilters Liste des filtres authorisés dans la requête
     * @param array $filters        Liste des valeurs, si null on utilise la request
     *
     * @throws HttpException quand un paramétre est invalide
     */
    public function checkQueryParams($allowedFilters, $filters = null)
    {
        if (is_null($filters)) {
            $filters = $this->getRequest()->query->all();
        }

        foreach ($filters as $filter => $value) {
            // On autorise le delete dans tous les cas
            if ($filter == 'delete' && !strcmp($value, '1')) {
                continue;
            }

            // On autorise le debug en environnement de dev
            if ($this->get('kernel')->getEnvironment() == 'dev' && $filter == 'debug') {
                continue;
            }

            if (!array_key_exists($filter, $allowedFilters)) {
                throw new HttpException(400, 'Bad Parameter: "' . $filter . '" is not allowed');
            } elseif ($allowedFilters[$filter] !== null && $value != $allowedFilters[$filter]) {
                if (is_array($value) && is_array($allowedFilters[$filter])) {
                    $badValues = array_values(array_diff($value, $allowedFilters[$filter]));
                    $value     = isset($badValues[0]) ? $badValues[0] : null;
                } elseif (!is_array($value) && is_array($allowedFilters[$filter])) {
                    throw new HttpException(400, 'Bad Parameter: "' . $filter . '" must be an array');
                }
                if (!is_null($value)) {
                    throw new HttpException(400, 'Bad Parameter: "' . $value . '" is not an allowed value for "' . $filter . '"');
                }
            }
        }
    }
}
