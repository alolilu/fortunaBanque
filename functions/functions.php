<?php


function redirectNotification($message, $redirect = null, $class = "success")
{
    global $routes;
    if (!$redirect) $redirect = $routes['home'];
    $message = base64_encode($message);
    header("Location: $redirect?message=$message&class=$class");
    echo "<script>location.href='$redirect?message=$message&class=$class'</script>";
}

function printNotification()
{
    if (isset($_GET['message'])) {
        $message = base64_decode($_GET['message']);
        if (isset($_GET['class'])) $class = $_GET['class'];
?>
        <div class="notification <?= $class ?>">
            <p><?= $message ?></p>
            <div class="notification_toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                </svg>
            </div>
        </div>

        <script>
            history.replaceState(null, "", location.href.split("?")[0]);
            setTimeout(() => {
                let notifications = document.getElementsByClassName("notification");

                notifications[0].classList.add("hide");
                setTimeout(() => {
                    notifications[0].remove();
                }, 1000)
            }, 9000);
        </script>
<?php }
}

function asset($asset)
{
    global $slug;
    $offset = "";
    $array = explode("/", $slug);
    $i = 0;
    foreach ($array as $tab) {
        if ($i > 0) $offset .= "../";
        $i++;
    }
    return $offset . $asset;
}

function getClientId()
{
    global $dbh;
    $login = $_SESSION['login'];
    $sql = "SELECT id FROM user WHERE email = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(":email", $login, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    return intval($result->id);
}

function getRoute($route)
{
    global $base;
    global $routes;
    return $base . $routes[$route];
}

function getUser($userId = null)
{
    global $dbh;
    if (isset($_SESSION['user-id'])) {
        $id = ($userId == null) ? intval($_SESSION['user-id']) : $userId;
        $sql = "SELECT * FROM user WHERE id = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetchAll();
        if ($result) {
            return $result[0];
        }
    }
    return false;
}

function getUserAccount($userId = null)
{
    global $dbh;
    $id = ($userId == null) ? intval($_SESSION['user-id']) : $userId;
    $sql = "SELECT * FROM account WHERE user = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();

    $result = $query->fetchAll();
    if ($result) {
        return $result[0];
    }
    return false;
    return false;
}

function dd($data)
{
    var_dump($data);
    echo "<script>document.getElementById('navbar').style.display='none'</script>";
    die();
}

function isGranted($redirect = true)
{
    global $dbh;

    if (isset($_SESSION['user-id'])) {
        $id = intval($_SESSION['user-id']);
        $sql = "SELECT email FROM user WHERE ID = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_OBJ);

        if($user->email == $_SESSION['login']){
            return true;
        }
    }

    if($redirect) {
        return redirectNotification("Vous devez être connecté pour accéder à cette page ...", getRoute("home"));
    } 
    return false;
}
