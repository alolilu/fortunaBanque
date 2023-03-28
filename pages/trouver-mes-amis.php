<?php

$id = (isset($_SESSION['user-id'])) ? $_SESSION['user-id'] : 0;
$result = "";

if (isset($_POST['search'])) {
    $search = "%$_POST[search]%";
    $sql = "SELECT account_nb, firstname, lastname FROM user WHERE firstname LIKE :search OR lastname LIKE :search AND ID != :id LIMIT 100";
    $query = $dbh->prepare($sql);
    $query->bindParam(":search", $search, PDO::PARAM_STR);
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_OBJ);
} else {
    $sql = "SELECT account_nb, firstname, lastname FROM user WHERE ID != :id LIMIT 100";
    $query = $dbh->prepare($sql);
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_OBJ);
}

?>

<div class="container my-5 py-5">
    <div class="card my-5">
        <form method="POST" style="display: flex; flex-direction: row; justify-content: flex-end; margin-bottom: 15px; position: relative">
            <div style="position: relative; display: flex; flex-direction: row">
                <input type="text" class="form-control" name="search" style="width: fit-content; min-width: 250px; margin-right: 15px" placeholder="Nom / Prénom">
                <?php if (!isset($_POST['search'])) { ?><div class="guide">
                        <p>Cherchez un amis à qui faire un virement</p>
                    </div>
                <?php } ?>
            </div>
            <input type="submit" value="Chercher" class="btn btn-outline-primary">
        </form>
        <?php foreach ($result as $data) { ?>
            <div class="border-top p-2 row">
                <div class="col-sm-4">
                    <p style="text-transform: capitalize; margin: 0px;"><?= $data->firstname ?></p>
                </div>
                <div class="col-sm-4 text-center">
                    <p style="text-transform: capitalize; margin: 0px;"><?= $data->lastname ?></p>
                </div>
                <div class="col-sm-4 text-right">
                    <?php if (isGranted(false)) { ?>
                        <p style="margin: 0px;" title="Cliquez pour faire un virement instantané !">
                            <a href="
                            <?= getRoute("compte/virements/nouveau"); ?>?account_nb=<?= $data->account_nb ?>">
                                <?= $data->account_nb ?>
                            </a>
                        </p>
                    <?php } else { ?>
                        <p style="margin: 0px;" title="Connectez vous pour leur transmettre un virement instantané !"><?= $data->account_nb ?></p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>