<?php

require_once 'includes/auth.php';

if (is_login()) {
    unset($_SESSION['user']);
}
header('Location: /');
exit();