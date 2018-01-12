<!DOCTYPE html>
<html>
<head>
    <title>Отчет работы</title>
<!--    <link rel="stylesheet" href="../assets/css/style.css">-->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-theme.css">
</head>
<body>
<style>
    html { background: #f5f5f5; }
    .mainmenu { padding: 15px; background: #eee; border-style: groove; }
    .mainmenu a { text-decoration: none; }
    .mainmenu li { display: inline-block; padding: 10px; border-radius: 5px; font-family: Geneva, Arial, Helvetica, sans-serif;	color: white; }
    .mainmenu li.item {	color: white; background: #aaa; }
    .mainmenu li.activeitem { color: dimgrey; background: white; border: 1px solid dimgrey; }
    body,html{  margin: 0;  padding:0;  background: #eee!important;  }
    h1,h2{  text-align: center;  }
    form{  width: 300px;  height: 50px;  text-align: center; margin: 0 auto;}
    #set_id{  width: 150px;  height: 30px;  }
    form input[type='submit']{  width: 100px;  height: 30px;  }
    .wrapper{font-size: 1.2em; text-align: center;}
    table{ margin: 0 auto;}
    text{color: #2f96b4; font-size: 1.1em; font-weight: bolder;}
    text #between{font-size: 2em; color: #2f96b4;font-weight: bolder;}
</style>
<?php

$url = current_url();
$controller = $this->uri->segment(1);
$links = [
    ['url' => $controller. '/client_report', 'name' => 'Эффективность по клиентам'],
    ['url' => $controller. '/client_report_late', 'name' => 'Дебиторская задолженность'],
    ['url' => $controller. '/work_report', 'name' => 'Количество несвоевременно выполненных заказов'],
    ['url' => $controller. '/contract_management', 'name' => 'Договора'],
    ['url' => $controller. '/responsible_management', 'name' => 'Работы'],
    ['url' => $controller. '/counterparty_management', 'name' => 'Клиенты'],
    ['url' => $controller. '/staff_management', 'name' => 'Сотрудники']
];
?>
Accounting 1.0.0 &copy; <?=date('Y')?>
<ul class="mainmenu">
    <text>Показатели эффективности:</text>
    <? foreach($links as $link): ?>
        <?php if ($link['name'] == "Договора")
            echo "<br><br>";
        ?>
        <a href='<?=site_url($link['url']);?>'>
            <li class='<?=site_url($link['url']) == $url ? 'activeitem' : 'item';?>'><?=$link['name'];?></li>
        </a>
    <? endforeach; ?>
</ul>
<h1>Количество несвоевременно выполненных заказов</h1>


<?php



require_once 'connection.php';

    $sql = "SELECT * FROM  contract Inner Join responsible On responsible.contract_id = contract.id and responsible.end>contract.end";
$count = $mysqli->query($sql)->num_rows;
    if (!$result = $mysqli->query($sql)) {
        // О нет! запрос не удался.
        echo "Извините, возникла проблема в работе сайта.";

        // И снова: не делайте этого на реальном сайте, но в этом примере мы покажем,
        // как получить информацию об ошибке:
        echo "Ошибка: Наш запрос не удался и вот почему: \n";
        echo "Запрос: " . $sql . "\n";
        echo "Номер_ошибки: " . $mysqli->errno . "\n";
        echo "Ошибка: " . $mysqli->error . "\n";
        exit;

    }
    if ($result->num_rows === 0) {
        // Упс! в запросе нет ни одной строки! Иногда это ожидаемо и нормально, иногда нет.
        // Решать Вам. В данном случае, может быть actor_id был слишком большим?
        echo "Отсутствуют работы<br>".
        exit;
    }


    while ($row = $result->fetch_assoc()) {


      $staff_id = $row['staff_id'];
        $sql = "SELECT * FROM staff where id = '$staff_id'";
        if (!$result2 = $mysqli->query($sql)) {
            echo "Что-то пошло не так.";
        }
        echo "<br>
 <table border = 1 cellspacing
= 4px class = 'table table-hover table-condense'><tr>
<td>Код работы</td>
<td>Начало работы</td>
<td>Конец работы</td>
<td>Код сотрудника</td>
<td>Имя сотрудника</td>
<td>Адресс сотрудника </td>
<td>Телефон сотрудника </td>
<td>Зарплата сотрудника </td>

</tr>";
        while ($row2 = $result2->fetch_assoc()) {
            echo "
 <td class='info'>" . $row['id'] . "</td>
 <td class='info'>" . $row['start'] . "</td>
<td class='info'>" . $row['end'] . "</td>
 <td class='info'>" . $row2['id'] . "</td>
<td class='info'>" . $row2['name'] . "</td>
<td class='info'>" . $row2['address'] . "</td>
<td class='info'>" . $row2['phone'] . "</td>
 <td class='info'>" . $row2['salary'] . "</td></tr>";
        }
       echo "</table>";
}
echo "<h1>Количество работ = $count штуки</h1>";
?>
</div>
</body>
</html>
