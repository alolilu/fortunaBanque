<?php
include("functions/compte/virements/nouveau.php");
isGranted();
?>

<div class="container my-5">
    <h1 class="my-5">Virements</h1>
    <div class="card">
        <div class="text-left my-4">
            <a href="<?= getRoute('compte/compte'); ?>" class="btn btn-outline-primary">Retour au compte</a>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h2>Nouveau virement</h2>
                <hr>
                <form action="" method="post" id="form_transaction">
                    <label for="type" class="form-label">Type de virement</label>
                    <select name="type" class="form-control">
                        <option value="Virement occasionnel">Virement occasionnel</option>
                        <option value="Virement programmé">Virement programmé</option>
                        <option value="Virement permanent">Virement permanent</option>
                    </select>
                    <label for="amount" class="form-label">Montant</label>
                    <input type="text" name="amount" id="form_amount" class="form-control">
                    <label for="to" class="form-label">Transférer à</label>
                    <input type="text" name="to" id="form_to" class="form-control" <?php if(isset($_GET['account_nb'])){ echo "value='" . $_GET['account_nb'] . "'"; } ?>>
                    <div class="text-right mt-4" id="target">
                        <button type="button" class="btn btn-outline-primary">
                            Virer l'argent
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Envoyer le virement ?</h5>
                                    <button onclick="closeModal()" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Souhaitez vous vraiment virer <e id="amount"></e>€ au compte <e id="account"></e>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">Annuler</button>
                                    <input type="submit" name="transfer" value="Envoyer l'argent" class="btn btn-outline-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <h2>Compte</h2>
                <hr>
                <p><b>Utilisateur:</b> <?= $user['firstname']; ?> <?= $user['lastname']; ?></p>
                <p><b>Type de compte:</b> <?= $user['type']; ?></p>
                <p><b>Créée le:</b> <?= $user['created_at']; ?></p>
                <p><b>Solde:</b> <?= $userAccount['balance']; ?> €</p>
            </div>
        </div>
    </div>
</div>

<script>
    let formAmount = document.getElementById("form_amount");
    let amount = document.getElementById("amount");
    let formAccount = document.getElementById("form_to");
    let account = document.getElementById("account");

    function fillModal(e) {
        if (formAmount.value > 0 && formAccount.value.length > 0) {
            document.getElementById('notification_erreur')?.remove();
            amount.innerText = formAmount.value;
            account.innerText = formAccount.value;
            $("#exampleModal").show();
            setTimeout(() => {
                document.getElementById("exampleModal").classList.add('show');
            }, 100);
        } else {
            let text = `
            <div class="notification danger">
                <p>Veuillez remplir les champs du formulaire !</p>
                <div class="notification_toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                        <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                    </svg>
                </div>
            </div>`;

            let notification = document.createElement("div");
            notification.innerHTML = text;
            notification.id = "notification_erreur";

            document.getElementById("notification_sandbox").appendChild(notification);

            let notification_toggle = document.getElementsByClassName("notification_toggle");

            let notifications = document.getElementsByClassName("notification");

            for (let i = 0; i < notification_toggle.length; i++) {
                notification_toggle[i].addEventListener("click", () => {
                    notifications[i].classList.add("hide");
                })
            }

            setTimeout(() => {
                let notifications = document.getElementsByClassName("notification");

                notifications[0].classList.add("hide");
                setTimeout(() => {
                    notifications[0].remove()
                }, 1000);
            }, 9000);
        }
    }

    function closeModal() {
        document.getElementById("exampleModal").classList.remove('show');
        setTimeout(() => {
            $("#exampleModal").hide();
        }, 200);
    }

    document.getElementById("target").addEventListener("click", (e) => {
        fillModal()
    })
</script>