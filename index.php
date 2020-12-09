<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		/* сейчас пытается заказать звонок */
		$dt = date("Y-m-d H:i:s");
		$name = trim($_POST['name']);
		$phone = trim($_POST['phone']);
      
		setlocale(LC_ALL, "ru_RU.UTF-8");
		$regName = '/[а-яА-ЯёЁa-zA-Z0-9]{2,}/u';
		$regPhone = '/^\d*$/';

		if(preg_match($regName, $name) !== 1) {
        	echo 'Имя не ТРУ!';
		}
		else if(preg_match($regPhone, $phone) !== 1) {
        	echo 'Телефон не ТРУ!';
		}
		else {
			file_put_contents('apps.txt', "$dt $name $phone\n", FILE_APPEND);
			mail('admin@localhost', 'Новая заявка', "$dt $name $phone");

			$msg = 'Заявка принята! Ждите!';
		}
	}
	else{
		/* просто зашёл на страничку */
		$msg = 'Введите данные и мы перезвоним!';
	}
?>

<form method="post">
	Имя<br>
	<input type="text" name="name" value="<?=$_POST['name'] ?>"><br>
	Телефон<br>
	<input type="text" name="phone" value="<?=$_POST['phone'] ?>"><br>
	<button>Заказать звонок</button>
</form>

<div>
	<?php echo $msg; ?>
</div>