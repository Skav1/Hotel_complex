<?php

require("constants.php");

$con = mysqli_connect(DB_SERVER,DB_USER, DB_PASS) or die(mysqli_error($con));
mysqli_select_db($con, DB_NAME) or die("Cannot select DB");


function _switch($table) {
    switch ($table) {
        case 'bill':
            $name = 'Таблиця чеків';
            $cols = ['ID', 'ID резервації', 'ID клієнта', 'Ціна за комнату', 'Ціна за обслуговування', 'Ціна за мінібар', 'Дата оплати', 'Дата закінчення аренди'];
            $n_cols = [
                'id' => $cols[0],
                'reservation_id' => $cols[1],
                'client_id' => $cols[2],
                'room_charge' => $cols[3],
                'room_service_charge' => $cols[4],
                'minibar_charge' => $cols[5],
                'payment_date' => $cols[6],
                'expire_date' => $cols[7],
            ];
            break;
        case 'client':
            $name = 'Таблиця клієнтів';
            $cols = ['ID', 'Пароль', 'Ел. пошта', 'Номер паспорту', "Ім`я", 'Призвіще', 'Телефон'];
            $n_cols = [
                'id' => $cols[0],
                'password' => $cols[1],
                'email' => $cols[2],
                'passport_no' => $cols[3],
                'fname' => $cols[4],
                'lname' => $cols[5],
                'phone' => $cols[6],
            ];
            break;
        case 'hotel':
            $name = 'Таблиця готелів';
            $cols = ['ID', 'Назва', 'Країна', "Місто", "Адреса", "Рейтинг"];
            $n_cols = [
                'id' => $cols[0],
                'name' => $cols[1],
                'country' => $cols[2],
                'city' => $cols[3],
                'address' => $cols[4],
                'star_rating' => $cols[5]
            ];
            break;
        case 'reservation':
            $name = 'Таблиця бронювань';
            $cols = ['ID', 'ID клієнта', 'Код готелю', 'Кількість кімнат', "Дата бронювання", "Час бронювання", "Кількість людей"];
            $n_cols = [
                'id' => $cols[0],
                'client_id' => $cols[1],
                'hotel_code' => $cols[2],
                'room_number' => $cols[3],
                'reservation_date_' => $cols[4],
                'reservation_time' => $cols[5],
                'quantity_peoples' => $cols[6],
            ];
            break;
        case 'room':
            $name = 'Таблиця кімнат';
            $cols = ['Номер кімнати', 'Код готелю', 'Статус', 'Поверх', "Стиль кімнати", "Площа", "Швидкість інтернету", "Ліжка"];
            $n_cols = [
                'room_number' => $cols[0],
                'hotel_code' => $cols[1],
                'status' => $cols[2],
                'floor' => $cols[3],
                'style' => $cols[4],
                'room_area' => $cols[5],
                'internet' => $cols[6],
                'beds' => $cols[7],
            ];
            break;
        case 'staff':
            $name = 'Таблиця персоналу';
            $cols = ['ID', 'Код готелю', "Ім'я", 'Призвіще', "Телефон", "Ел. пошта", "Зарплатня"];
            $n_cols = [
                'id' => $cols[0],
                'hotel_code' => $cols[1],
                'fname' => $cols[2],
                'lname' => $cols[3],
                'phone' => $cols[4],
                'email' => $cols[5],
                'salary' => $cols[6],
            ];
            break;
        default:
            exit('Такої таблиці  не існує!');
            break;
    }

    return [
        'name'   => $name, 
        'cols'   => $cols,
        'n_cols' => $n_cols
    ];
}