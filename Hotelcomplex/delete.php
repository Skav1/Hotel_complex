<?php require_once 'includes/auth.php' ?>

<?php
if (!$is_admin) {
    exit();
}
require_once("includes/connection.php");

if ($_GET['table'] != "" && $_GET['id'] != "") {
    $table = htmlspecialchars($_GET['table']);
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    extract(_switch($table));
    if (filter_var($id, FILTER_VALIDATE_INT)) {
        
    } else {
        exit('Помилка з айді!');
    }

    foreach ($n_cols as $col => $a) {
        $col_name = $col;
        break;
    }

    mysqli_query($con, "DELETE FROM `$table` WHERE `$table`.`$col_name` = $id");
    msg('Запис успішно видалено!', false);
    header('Location: /?table=' . $table);
} else {
    header('Location: /');
}
