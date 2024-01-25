<?php

//1. **[Скачайте](https://drive.google.com/file/d/1mrOJkfsk4lIwV-xSfSpqfRpMgeFXEMj-/view?usp=sharing)** верстку сайта **“Бургерная”**
//2. Внизу вы найдете форму заказа, напишите **скрипт**, обрабатывающий эту форму. **Скрипт должен:**
//- Проверить, существует ли уже пользователь с таким email, если нет - создать его, если да - увеличить число заказов по этому email. Двух пользователей с одинаковым email быть не может.
//- Сохранить данные заказа - id пользователя, сделавшего заказ, дату заказа, полный адрес клиента.
//- Скрипт должен вывести пользователю:

//```jsx
//Спасибо, ваш заказ будет доставлен по адресу: “тут адрес клиента”
//Номер вашего заказа: #ID
//Это ваш n-й заказ!
//```

//Где **ID** - уникальный идентификатор только что созданного заказа **n** - общий кол-во заказов, который сделал пользователь с этим email включая текущий

//**Оформление не требуется, достаточно текста на белом фоне, отбитого переходами строк.**

//*В задании необходимо использовать базы данных. Дамп БД необходимо приложить к репозиторию.*

require "/OSPanel/domains/php_ilukon2/week_2/exercize_3_2/burgers/src/functions.php";
require "/OSPanel/domains/php_ilukon2/week_2/exercize_3_2/burgers/src/class.db.php";
require "/OSPanel/domains/php_ilukon2/week_2/exercize_3_2/burgers/src/config.php";
require "/OSPanel/domains/php_ilukon2/week_2/exercize_3_2/burgers/src/class.burger.php";

ini_set('display_errors', 'on');
ini_set('error_reporting', E_NOTICE | E_ALL);

$burger = new Burger();

$email = $_POST['email'];
$name = $_POST['name'];

$addressFields = ['phone', 'street', 'home', 'part', 'appt', 'floor'];
$address = '';
foreach ($_POST as $field => $value) {
    if ($value && in_array($field, $addressFields)) {
        $address .= $value . ',';
    }
}
$data = ['address' => $address];

$user = $burger->getUserByEmail($email);

if ($user) {
    $userId = $user['id'];
    $burger->incOrders($user['id']);
    $orderNumber = $user['orders_count'] + 1;
} else {
    $orderNumber = 1;
    $userId = $burger->createUser($email, $name);
}

$orderId = $burger->addOrder($userId, $data);

echo "Спасибо, ваш заказ будет доставлен по адресу: $address<br>
Номер вашего заказа: #$orderId <br>
Это ваш $orderNumber-й заказ!";