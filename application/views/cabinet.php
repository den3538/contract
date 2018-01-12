<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style>
html { background: #f5f5f5; }
.mainmenu { padding: 15px; background: #eee; border-style: groove; }
.mainmenu a { text-decoration: none; }
.mainmenu li { display: inline-block; padding: 10px; border-radius: 5px; font-family: Geneva, Arial, Helvetica, sans-serif;	color: white; }
.mainmenu li.item {	color: white; background: #aaa; }
.mainmenu li.activeitem { color: dimgrey; background: white; border: 1px solid dimgrey; }
text{color: #2f96b4; font-size: 1.1em; font-weight: bolder;}
text #between{font-size: 2em; color: #2f96b4;font-weight: bolder;}
</style>
</head>
<body>
	<div>
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
	</div>
	<div style='height:20px;'></div>  
    <div>
		 <?php echo $output; ?>
    </div>
</body>
</html>
