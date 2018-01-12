<!DOCTYPE html>
<html>
<head>
    <title>Поиск клиента</title>
<link rel = "stylesheet" href = "../assets/css/bootstrap.css">
<link rel = "stylesheet" href = "../assets/css/bootstrap-theme.css">
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
    text{color: #2f96b4; font-size: 1.1em;}
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
<h1>Дебиторская задолженность</h1>
<h1>Поиск клиента</h1>
<h2>Введите код клиента</h2>

<form action= '<?php site_url() ?>' method="post">
<input type="number" id="set_id" name = "id" size = 20 placeholder="Введите id Клиента" min="1" max = 99999>
<input type="submit" value="Проверить">
</form><br>
<div class = "wrapper">

<?php

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    require_once 'connection.php';

$sql = "SELECT * FROM counterparty WHERE id = '$id'";
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
    echo "Мы не смогли найти клиента с кодом $id, простите. Пожалуйста, попробуйте еще раз.";
    exit;
}


    while ($row = $result->fetch_assoc()) {

        echo "<h2>Наименование клиента - ".$row['name']."</h2>";
        echo "<table border = 1 cellspacing
= 4px class = 'table table-hover'><tr><td>Контактное лицо</td><td>" . $row['full_name'] . "</td></tr>
<tr><td>Код клиента</td><td>" .$id . "</td></tr>
<tr><td>Номер клиента </td><td>" . $row['phone'] . "</td></tr>
<tr><td>Банк клиента </td><td>" . $row['bank'] . "</td></tr>
<tr><td>Рассчетный счет клиента </td><td>" . $row['account'] . "</td></tr></table>
";
    }
//    $sql = "SELECT * FROM project WHERE klient_id = '$id'";
//    if (!$result = $mysqli->query($sql)) {
//        echo "Извините, у клиента отсутствуют договора.";
//        exit;
//    }

    $sum = 0;
//while ($row2 = $result->fetch_assoc()) {
//
//    $contract_id = $row2['contract_id'];

    $sql = "SELECT * FROM contract WHERE pay_date>plan_date and client_id = '$id' ORDER BY cipher";
    if (!$result2 = $mysqli->query($sql)) {
        echo "<br>Извините, у клиента отсутствуют договора.";
        exit;
    }
    echo "<br>
 <table border = 1 cellspacing
= 4px class = 'table table-hover'><tr>
<td>Шифр договора</td>
<td>Наименование договора</td>
<td>Дата регистрации </td>
<td>Примечание Договора </td>
<td>Сумма Договора </td>
<td>Дата начала </td>
<td>Дата окончания </td>
<td>Дата по плану </td>
<td>Дата оплаты </td>
</tr>";
    while ($row = $result2->fetch_assoc()) {
        echo "<tr>
<td>" . $row['cipher'] . "</td>
<td>" . $row['name'] . "</td>
<td>" . $row['registration'] . "</td>
<td>" . $row['note'] . "</td>
<td> " . $row['amount'] . "</td>
<td> " . $row['start'] . "</td>
<td> " . $row['end'] . "</td>
<td> " . $row['plan_date'] . "</td>
 <td>" . $row['pay_date'] . "</td>
";

        $sum += $row['amount'];
    }
//}
    echo "</table>";
    }
if(!empty($sum))
    if ($sum!=0)
        echo "<h2>Сумма задолжености - $sum</h2>";


?>
</div>
</body>
</html>
