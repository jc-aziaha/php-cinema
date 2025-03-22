<?php


    /**
     * Protège le système contre les failles de type csrf.
     *
     * @param string $sessionCsrfToken
     * @param string $postCsrfToken
     * 
     * @return boolean
     */
    function isCsrfTokenValid(string $sessionCsrfToken, string $postCsrfToken): bool
    {
        // Si le csrf_token n'est pas déclaré ou est null en session et dans le formulaire,
        if ( !isset($postCsrfToken) || !isset($sessionCsrfToken) )
        {
            return false;
        }
        
        // Si le csrf_token n'est pas vide en session et dans le formulaire,
        if ( empty($postCsrfToken) || empty($sessionCsrfToken) )
        {
            return false;
        }

            // Si le csrf_token de la session est diiférent du csrf_token du formulaire,
        if ( $postCsrfToken !== $sessionCsrfToken)
        {
            return false;
        }

        return true;
    }



    /**
     * Protège le système contre les robots spameurs.
     *
     * @param string $postHoneyPot
     * @return boolean
     */
    function isHoneyPotLicked(string $postHoneyPotValue): bool
    {
        if ( $postHoneyPotValue === "" ) 
        {
            return false;
        }
        
        return true;
    }