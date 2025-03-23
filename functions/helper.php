<?php

    /**
     * Permet de dumper et d'arrêter l'exécution du script.
     *
     * @param mixed $data
     * @return void
     */
    function dd(mixed $data): void
    {
        var_dump($data);
        die();
    }


    /**
     * Permet de dumper.
     *
     * @param mixed $data
     * @return void
     */
    function dump(mixed $data): void
    {
        var_dump($data);
    }


    /**
     * Affiche les anciennes données provenant du formulaire.
     *
     * @param array $data
     * @param string $input
     * @return string
     */
    function old(array $data, string $input): string
    {
        if ( isset($data[$input]) && $data[$input] !== "" ) 
        {
            unset($_SESSION['old'][$input]);
            return $data[$input];
        }

        return "";
    }


