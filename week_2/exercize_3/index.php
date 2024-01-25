<?php

require "/OSPanel/domains/php_ilukon2/week_2/exercize_3/src/function.php";

for ($i = 0; $i < 50; $i++) {
  $users[]= createUsers();
}

//echo '<pre>';
//var_dump($users);
//echo '</pre>';

file_put_contents('users.json', json_encode($users));

$content = file_get_contents('users.json');
$newUsers = json_decode($content, true);

//echo '<pre>';
//var_dump($newUsers);
//echo '</pre>';

$count = [];
$summ = 0;
foreach($newUsers as $ar) {
   if (isset($count[$ar['name']])) {
    $count[$ar['name']]++;
   }else {
    $count[$ar['name']] = 1;
   }
   $summ += $ar['age'];
}

print_r($count);
echo "Средний возраст " . round($summ / sizeof($newUsers));


