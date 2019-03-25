<?php
$db = mysqli_connect('localhost','root','','guestbook');
if (isset($_POST['user'])) {
	$user= $_POST['user'];
}; if ($user == '' ) {
	unset($user);
	goto a;
} 
if (isset($_POST['message'])) {
	$message = $_POST['message'];
}; if ($message == '') {
	unset($message);
	goto a;
}
// обрабатываем теги и скрипты в полях которые могли ввести
$user = stripslashes($user);
$user = htmlspecialchars($user);
$message = stripslashes($message);
$message = htmlspecialchars($message);

if (isset($_POST)) {
$result = mysqli_query($db, "INSERT INTO msg (date,user,message) VALUES (NOW(),'$user','$message')");

unset($_POST);
unset($_REQUEST);
header('Location: .');
}
a:
?>
<!DOCTYPE html>
<html>
<head>
	<title>Гостевая книга на MySQL</title>
</head>
<body>
<form method="post">
	Имя: <input type="text" name="user"></br>
	Сообщение: <input type="text" name="message"></br>
	<input type="submit" name="submit"></br>
</form>
<?php
$txt = mysqli_query($db, "SELECT * FROM msg ORDER BY id DESC");
while ($text = mysqli_fetch_assoc($txt)) {
	echo $text['date'], "</br><b>", $text['user'], "</b></br>", $text['message'], "</br></br>";
}

?>
</body>
</html>
