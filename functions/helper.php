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