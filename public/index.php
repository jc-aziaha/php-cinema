<?php
session_start();

    require __DIR__ . "/../functions/dbConnector.php";
    require __DIR__ . "/../functions/filmService.php";
    require __DIR__ . "/../functions/helper.php";
    require __DIR__ . "/../functions/security.php";

    $title = "Accueil";
    $description = "Liste des films";
    $keywords = "accueil, liste, films";
    $fontAwesome = <<<HTML
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
HTML;

    $db = connectDb();

    $films = findAll($db);

    // dd($films);

?>
<?php require __DIR__ . "/../partials/head.php"; ?>

    <?php require __DIR__ . "/../partials/nav.php"; ?>

    <!-- Le contenu spécifique à cette page -->
    <main>
        <h1 class="text-center my-3 display-5">Liste des films</h1>

        

        <div class="container">
            <div class="d-flex justify-content-end align-items-center my-3">
                <a href="/create.php" class="btn btn-primary shadow"><i class="fa-solid fa-plus"></i> Nouveau film</a>
            </div>

            <div class="row">
                <div class="col-md-8 col-lg-5 mx-auto rounded">

                    <?php if(isset($_SESSION['success']) && !empty($_SESSION['success']) ): ?>
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <?= $_SESSION['success'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif ?>

                    <?php if(count($films) > 0) : ?>
                        <?php foreach($films as $film) : ?>
                            <div class="card p-3 shadow mb-3">
                                <p><strong>Titre du film</strong>: <?= e($film['title']); ?></p>
                                <p><strong>Nom du/des acteurs</strong>: <?= e($film['actors']); ?></p>
                                <hr>
                                <div>
                                    <a title="Voir les détails du film: <?= e($film['title']); ?>" class="mx-2 text-dark" href="#" data-bs-toggle="modal" data-bs-target="#modal-<?= e($film['id']) ?>"><i class="fa-solid fa-eye"></i></a>
                                    <a class="mx-2 text-secondary" href=""><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="mx-2 text-danger" href=""><i class="fa-solid fa-trash"></i></a>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modal-<?= e($film['id']) ?>" tabindex="-1" aria-labelledby="modal-label-<?= e($film['id']) ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modal-label-<?= e($film['id']) ?>"><?= e($film['title']) ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>La note</strong>: <?= isset($film['review']) && $film['review'] !== "" ? e($film['review']) : 'Non renseignée'; ?></p>
                                            <p><strong>Le commentaire</strong>: <?= isset($film['comment']) && $film['comment'] !== "" ? nl2br(e($film['comment'])) : 'Non renseigné'; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php else : ?>
                        <p>Aucun film dans la liste</p>
                    <?php endif ?>

                </div>
            </div>
        </div>
    </main>

    <?php require __DIR__ . "/../partials/footer.php"; ?>

<?php require __DIR__ . "/../partials/scripts_foot.php"; ?>
