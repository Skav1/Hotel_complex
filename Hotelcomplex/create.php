<?php require_once 'includes/auth.php' ?>


<?php
if (!$is_admin) {
    exit();
}

require_once("includes/connection.php");


if (!empty($_POST)) {
    $table = htmlspecialchars($_POST['table']);
    extract(_switch($table));
    $sql = "INSERT INTO `$table` (";
    $i = 0;
    foreach ($n_cols as $col => $a) {
        if ($i == 0) {
            $col_id_name = $col;
        }
        if ($i > 1) {
            $sql .= ", ";
        }
        if ($i > 0) {
            $sql .= '`' . $col . '`';
        }
        $i++;
    }
    $sql .= ") VALUES (";
    $i = 0;

    $last_id = mysqli_query($con, "SELECT $col_id_name FROM `$table` ORDER BY $col_id_name DESC LIMIT 1");
    $last_id = mysqli_fetch_row($last_id);
    $last_id = $last_id[0] + 1;
    foreach ($_POST as $key => $data) {

        if ($i == 0) {
        } else {
        }
        if ($i > 1) {
            $sql .= ", ";
        }
        if ($i != 0) {
            $sql .= "'$data'";
        }
        $i++;
    }
    $sql .= ")";
    mysqli_query($con, $sql);
    msg('Запис успішно додано!', false);
    header('Location: /?table=' . $table);
    exit();
}

require 'includes/header.php';

$table = htmlspecialchars($_GET['table']);


extract(_switch($table));

?>

<div class="container mregister">
    <div id="login" class="text-white">
        <h2 class="pt-4 text-center">Додавання запису</h2>
        <h3 class="pb-2 pt-2 text-center"><?= $name ?></h3>
        <form class="w-50 mx-auto" action="create.php" id="loginform" method="post" name="loginform">
            <input type="hidden" name="table" value="<?= $table ?>">
            
            <?php $i = 0; ?>
            <?php foreach ($n_cols as $name => $col) : ?>
                
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
                    <div class="mb-3">
                        <label for="<?= $name ?>" class="form-label"><?= $col ?></label>
                        <input class="form-control" id="<?= ($name); ?>" name="<?= ($name); ?>" size="20" type="<?= $type ?>" value="<?= ($type == 'datetime-local') ? date('Y-m-d H:i:s') : '' ?>" required></label></p>
                    </div>
                <?php endif; ?>
                <?php $i++; ?>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-warning mt-1 mb-5 mx-auto d-block px-4">Додати</button>
        </form>
    </div>
</div>

<?php
require 'includes/footer.php';
?>