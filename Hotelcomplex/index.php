<?php require_once 'includes/auth.php' ?>

<style>
    #particles-js {
        z-index: 0;
    }

    .particles-js-canvas-el {
        z-index: 0;
    }
</style>

<?php
require_once("includes/connection.php");
require 'includes/header.php';

$table = htmlspecialchars($_GET['table']);

if ($table == "") {
    $table = 'hotel';
}

extract(_switch($table));

$sql = "SELECT * FROM `$table`";
if (isset($_POST['q'])) {
    $q = mysqli_escape_string($con, $_POST['q']);
    if ($q != '') {
        $sql = "SELECT * FROM `$table` WHERE ";
    
        $i = 0;
        foreach ($n_cols as $key => $col) {
            if ($i > 0) {
                $sql .= " OR ";
            }
            $sql .= "$key LIKE ('%$q%')";
            $i++;
        }
    } else {
        msg('Не можливо шукати пусту строку!');
    }
}
$data = mysqli_query($con, $sql);

if ($data) {
?>
    <div class="container-fluid text-center text-white">
        <h1 class="pt-5"><?= $name ?></h1>
    </div>
    <?php if ($is_admin): ?>
        <div class="container d-flex justify-content-center pt-4 pb-2">
            <a href="create.php?table=<?= $table ?>" class="btn btn-warning px-5">Додати</a>
        </div>
    <?php endif; ?>
    <div class="container">
    <form class="d-flex py-3" role="search" method="POST" action="<?= $_SERVER['REQUEST_URI'] ?>">
        <input class="form-control me-2" name="q" type="search" autocomplete="off" placeholder="Пошук інформації..." value="<?= (isset($_POST['q'])) ? $q : '' ?>" aria-label="Search">
        <button class="btn btn-warning px-4" type="submit">Пошук</button>
      </form>
    <table class="mt-4 table table-dark table-bordered table-striped">

        <tr>
            <?php foreach ($cols as $col) : ?>
                <th><?= htmlspecialchars($col) ?></th>
            <?php endforeach; ?>
            <?php if ($is_admin): ?>
                <th>&#9998;</th>
                <th>&#10006;</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($data as $row) : ?>
            <tr>
                <?php $i = 0; ?>
                <?php foreach ($row as $key => $field) : ?>
                    <?php
                    if ($i == 0) {
                        $temp_id = $field;
                    }
                    ?>
                    <td>
                        <?= htmlspecialchars($field) ?>
                    </td>
                    <?php $i++; ?>
                <?php endforeach; ?>

                <?php if ($is_admin): ?>
                    <td>
                        <a href="edit.php?table=<?= htmlspecialchars($table) ?>&id=<?=htmlspecialchars($temp_id) ?>" class="text-decoration-none">&#9998;</a>
                    </td>
                    <td>
                        <a href="delete.php?table=<?= htmlspecialchars($table) ?>&id=<?= htmlspecialchars($temp_id) ?>" class="text-decoration-none">&#10006;</a>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
<?php
} else {
    echo ('<h1 style="color: #fff;">This table is empty!</h1>');
}

require 'includes/footer.php';
?>
