<?php require_once 'includes/auth.php' ?>

<?php
if (!$is_admin) {
    exit();
}

require_once("includes/connection.php");

if (!empty($_POST)) {
    $table = htmlspecialchars($_POST['table']);
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        exit('Помилка з айді!');
    }
    extract(_switch($table));
    foreach ($n_cols as $col => $a) {
        $col_name = $col;
        break;
    }
    $i = 0;
    $_data = [];
    foreach ($_POST as $key => $data) {
        if ($i > 1) {
            $_data[$i - 2] = $data;
        }
        $i++;
    }

    $sql = "UPDATE `$table` SET ";
    $i = 0;
    foreach ($n_cols as $col => $a) {
        if ($i != 0) {
            if ($i > 1) {
                $sql .= ", ";
            }
            $sql .= "`" . $col . "` = '" . $_data[$i - 1] . "'";
        }
        $i++;
    }
    $sql .= " WHERE `$col_name` = '$id'";
    mysqli_query($con, $sql);
    msg('Запис успішно змінено!', false);
    header('Location: /?table=' . $table);
} else if ($_GET["table"] != "" && $_GET["id"] != "") {

    $table = htmlspecialchars($_GET['table']);
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        exit('Помилка з айді!');
    }
    extract(_switch($table));
    
    require 'includes/header.php';

    foreach ($n_cols as $col => $a) {
        $col_name = $col;
        break;
    }
    $data = mysqli_query($con, "SELECT * FROM `$table` WHERE `$table`.`$col_name` = '$id'");
    $data = mysqli_fetch_row($data);
    if (!$data) {
        header('Location: /?table=' . $table);
    }


    $_data = [];
    $i = 0;
    foreach ($n_cols as $col => $name) {
        $_data[$col] = $data[$i];
        $i++;
    }

?>

<style>

</style>

    <div class="container mregister">
        <div id="login" class="text-white">
            <h2 class="pt-4 text-center">Редагування запису</h2>
            <h3 class="py-2 text-center"><?= $name ?></h3>
            <form class="w-50 mx-auto" action="edit.php" id="loginform" method="post" name="loginform">
                <input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
                <input type="hidden" name="id" value="<?=htmlspecialchars($id) ?>">

                <?php $i = 0; ?>
                <?php foreach ($_data as $key => $data) : ?>
                    
                    <?php if ($i != 0) : ?>
                        <?php
                            $type = 'text';
                            if (stripos($name, 'password') !== false) {
                                $type = 'password';
                            }
                            else if (stripos($name, 'time') !== false) {
                                $type = 'time';
                            }
                            else if (stripos($name, 'email') !== false) {
                                $type = 'email';
                            }
                            else if (stripos($name, 'phone') !== false) {
                                $type = 'tel';
                            }
                            else if (stripos($name, 'date_') !== false) {
                                $type = 'date';
                            }
                            else if (stripos($name, 'date') !== false) {
                                $type = 'datetime-local';
                            }

                        ?>
                        <label class="form-label" for="<?= $key ?>"><?= $n_cols[$key] ?></label>
                        <input class="form-control mb-3" id="<?= $key ?>" name="<?= $key ?>" size="20" type="<?= $type ?>" value="<?= htmlspecialchars($data) ?>" required>
                    <?php endif; ?>
                    <?php $i++; ?>
                <?php endforeach; ?>
                <input class="btn btn-warning d-block mx-auto mb-5 mt-2 px-4 " type="submit" value="Редагувати">
            </form>
        </div>
    </div>

<?php

    require 'includes/footer.php';
} else {
    header('Location: /');
}
