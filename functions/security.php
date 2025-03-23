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
            unset($_SESSION['csrf_token']);
            unset($_POST['csrf_token']);
            return false;
        }
        
        // Si le csrf_token n'est pas vide en session et dans le formulaire,
        if ( empty($postCsrfToken) || empty($sessionCsrfToken) )
        {
            unset($_SESSION['csrf_token']);
            unset($_POST['csrf_token']);
            return false;
        }

            // Si le csrf_token de la session est diiférent du csrf_token du formulaire,
        if ( $postCsrfToken !== $sessionCsrfToken)
        {
            unset($_SESSION['csrf_token']);
            unset($_POST['csrf_token']);
            return false;
        }

        unset($_SESSION['csrf_token']);
        unset($_POST['csrf_token']);
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
            unset($_POST['honey_pot']);
            return false;
        }
        
        unset($_POST['honey_pot']);
        return true;
    }


    /**
     * Protège le système contre les failles de stype Xss.
     *
     * @param string $data
     * @return string
     */
    function e(string|null $data): string
    {
        if ( isset($data) ) 
        {
            return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }

        return '';
    }