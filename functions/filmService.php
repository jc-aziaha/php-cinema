<?php

    /**
     * Permet d'insérer un nouveau film en base de données.
     *
     * @param PDO $db
     * @param array $postData
     * @param float|null $reviewRounded
     * 
     * @return void
     */
    function createFilm(PDO $db, array $postData, float|null $reviewRounded): void
    {
        try 
        {
            $req = $db->prepare("INSERT INTO film (title, actors, review, comment, created_at, updated_at) VALUES (:title, :actors, :review, :comment, now(), now() )");

            $req->bindValue(":title", $postData['title']);
            $req->bindValue(":actors", $postData['actors']);
            $req->bindValue(":review", $reviewRounded);
            $req->bindValue(":comment", $postData['comment']);

            $req->execute();
            $req->closeCursor();
        } 
        catch (\PDOException $exception) 
        {
            throw new \Exception($exception->getMessage());
        }
    }