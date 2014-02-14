
<?header('Content-type: text/html; charset=utf-8');
require_once "func.php";
?>

<form method = "POST">
	<fieldset>
		<legend>ЭКСПЕРТНОЕ ЗАКЛЮЧЕНИЕ</legend>
ФИО автора:<br>
		<input type = "text" name = "fioAutor"><br>
Название работы:<br>
		<input type = "text" name = "workName"><br>
Вид работы:<br>
		<input type = "text" name = "workType"><br>
ФИО эксперта:<br>
		<input type = "text" name = "fioExp"><br>
Разрешение на публикацию:<br>
		<input type = "checkbox" name = "option" value = "1">Разрешить/Не разрешить		
	</fieldset>	
		<input type = "submit" name = "submit" value = "Оправить">
</form>
<hr>
<a href = "?action=show">Показать</a>
<?
print_r($_GET);
if ($_POST['submit']) {
	$_POST = defender_xss($_POST);
	echo '<pre>';	
		print_r($_POST);
	echo '<pre>';

	$fioAutor = $_POST['fioAutor'];
	$fioExp = $_POST['fioExp']; 
	$workName = $_POST['workName'];
	$workType = $_POST['workType'];
	$check = $_POST['option'];
	

	if (empty($fioAutor) || empty($fioExp) || empty($workName) || empty($workType))
		echo ("Поля обязательны для заполнения!");
	else {
		$q = mysqli_query ($link, "INSERT INTO `table`(`fioautor`, `fioexp`, `workName`, `workType`, `check`) VALUES ('$fioAutor','$fioExp','$workName','$workType','$check')") or die(mysql_error());		
		echo "Данные добавлено успешно!";	
	}
}


if ($_GET['action']=="show")	{
	$q = mysqli_query ($link,"SELECT `fioautor`, `fioexp`, `workName`, `workType`, `check` FROM `table`") or die("error_log");
	$ar=array();
while ($res = mysqli_fetch_assoc($q)) {
	$ar[]=$res;	
		}
	echo '<pre>';	
		print_r($ar);
	echo '<pre>';
/*	
		foreach ($ar as $v) {
			foreach ()	{	
			echo 'ФИО автора:<br>'.$k['fioautor'].'<br>';
			echo 'ФИО эксперта:<br>'.$k['fioexp'].'<br>';
			echo 'Название работы:<br>'.$k['workName'].'<br>';
			echo 'Вид работы:<br>'.$k['workType'].'<br>';	
			if ($k['check']=="1")
				echo 'Публикация разрешена<hr>';
			else
				echo 'Публикация запрещена<hr>';

		}	
	}	

*/
}
?>
