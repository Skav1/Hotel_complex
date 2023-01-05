<?php
session_start();

if (isset($_SESSION['msg']) && $_SESSION['msg']) {
    echo("<script>setTimeout(() => alert('" . $_SESSION['msg'] .  "'), 500)</script>");
    unset($_SESSION['msg']);
}

function msg($msg, $redir=true) {
    $_SESSION['msg'] = $msg;
    if ($redir) {
        header("location: " . $_SERVER["REQUEST_URI"]);
        exit();
    }
}

$is_login = false;
$is_admin = false;


if (isset($_SESSION['user'])) {
    $is_login = true;
}
if ($is_login && $_SESSION['user'][1] == 'admin') {
    $is_admin = true;
}


function is_login() {
    if (isset($_SESSION['user'])) {
        return true;
    }
    return false;
}

function debug($var) {
    echo('<pre style="color: #fff !important">');
    var_dump($var);
    echo('</pre>');
}

function check_POST_() {
    return (!empty($_POST) && isset($_POST['login']) && isset($_POST['pass']));
}


if (isset($_GET['a']) && $_GET['a'] == 'reg') {
    if (check_POST_()) {
        $login = $_POST['login'];
        $pass  = $_POST['pass'];
        $pass  = password_hash($pass, PASSWORD_DEFAULT);
        
        require 'includes/connection.php';
        $sql = "SELECT * FROM usertbl WHERE login = '$login'";
        $check = mysqli_query($con, $sql);
        $check = mysqli_fetch_assoc($check);

        if ($check) {
            msg("Такий логін вже існує! Введіть інший");
        } else {
            $sql = "INSERT INTO usertbl (username, password, roles) VALUES ('$login', '$pass', 'user')";
    
            mysqli_query($con, $sql);
    
            $_SESSION['user'] = [$login, 'user'];
            header('Location: /');
        }

        exit();
    } else {
        require 'includes/header.php';
        ?>


<div class="container mregister">
    <div id="login" class="text-white">
        <div class="py-4"></div>
        <div class="py-4"></div>
        <div class="py-4"></div>
        <h2 class="pt-4 text-center">Реєстрація</h2>
        <div class="py-2"></div>
        <form class="w-25 mx-auto" action="" id="loginform" method="post" name="loginform">
            <div class="mb-3">
                <label class="form-label" for="">Логін</label>
                <input class="form-control" id="" name="login" size="20" type="text" value="" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Пароль</label>
                <input class="form-control" id="" name="pass" size="20" type="password" value="" required>
            </div>
            <input class="btn btn-warning mb-3 mt-5 px-4 mx-auto d-block" type="submit" value="Зареєструватися">
            <p><a class="fs-6 text-warning text-decoration-none text-right log-add-link" href="?">Зайти в акаунт</span></a>
        </form>
    </div>
</div>



        <?php
        require 'includes/footer.php';
        exit();
    }
} else {

    if (is_login()) {

    } else {
        if (check_POST_()) {
            $login = $_POST['login'];
            $pass  = $_POST['pass'];

            require 'includes/connection.php';
            
            $sql = "SELECT * FROM usertbl WHERE username = '$login'";
            $check = mysqli_query($con, $sql);
            $check = mysqli_fetch_assoc($check);

            if ($check) {
                if (password_verify($pass, $check['password'])) {
                    $_SESSION['user'] = [$login, $check['roles']];
                    header('Location: /');

                    exit();
                } else {
                    msg("Пароль не вірний! Спробуйте ще раз");
                }
            } else {
                msg("Такого облікового запису не існує! Спробуйте ще раз");
            }

            exit();
        } else {

            require 'includes/header.php';
            ?>


<div class="container mregister">
    <div id="login" class="text-white">
        <div class="py-4"></div>
        <div class="py-4"></div>
        <div class="py-4"></div>
        <h2 class="pt-4 text-center">Авторизація</h2>
        <div class="py-2"></div>
        <form class="w-25 mx-auto" action="" id="loginform" method="post" name="loginform">
            <div class="mb-3">
                <label class="form-label" for="">Логін</label>
                <input class="form-control" id="" name="login" size="20" type="text" value="" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Пароль</label>
                <input class="form-control" id="" name="pass" size="20" type="password" value="" required>
            </div>
            <input class="btn btn-warning mb-3 mt-5 px-4 mx-auto d-block" type="submit" value="Авторизація">
            <p><a class="fs-6 text-warning text-decoration-none text-right log-add-link" href="?a=reg">Зареєструватися</span></a>
        </form>
    </div>
</div>

            <?php
            require 'includes/footer.php';
            exit();
        }
    }

}