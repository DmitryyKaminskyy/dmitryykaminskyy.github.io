<?php
header("Content-Type: text/html; charset=utf-8");
$name = htmlspecialchars($_POST["name"]);
$tel = htmlspecialchars($_POST["tel"]);
$email = htmlspecialchars($_POST["email"]);

$refferer = getenv('HTTP_REFERER');
$date = date("d.m.y"); // число.месяц.год
$time = date("H:i"); // часы:минуты:секунды
$myemail = "drakon20000@gmail.com";

	$tema = "Заявка с сайта";
	$message_to_myemail = "У вас заявка с сайта:
	<table style='width: 100%;'>
	<tr style='background-color: #f8f8f8;'>
		<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Имя заявителя:</b></td>
		<td style='padding: 10px; border: #e9e9e9 1px solid;'>$name</td>
	</tr>

	<tr>
		<td style='padding: 10px; border: #e9e9e9 1px solid;'>
			<b>Номер телефона заявителя</b>
		</td>
		<td style='padding: 10px; border: #e9e9e9 1px solid;'>$tel/td>
	</tr>

	<tr style='background-color: #f8f8f8;'>
		<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>E-mail заявителя:</b></td>
		<td style='padding: 10px; border: #e9e9e9 1px solid;'>$email</td>
	</tr>

	<tr>
		<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Application time:</b></td>
		<td style='padding: 10px; border: #e9e9e9 1px solid;'>$date / $time/ $refferer</td>
	</tr>
	</table><br>
	<a download href='$refferer/leads.txt'>Download the full list of applications in txt-format</a><br><br>
	";

mail($myemail, $tema, $message_to_myemail, "From: KDB <$myemail> \r\n"."Content-type: text/html; charset=utf-8\r\n" );

$file_1 = 'leads.txt';
$tofile_1 = "===================================================================\n
	Заявка с сайта:\n
	Имя заявителя: $name\n
	Телефон заявителя: $tel\n
	E-mail заявителя: $email\n
	Application Time: $date / $time\n
	Refferer: $refferer\n\n";
file_put_contents($file_1, $bom . $tofile_1 . file_get_contents($file_1));
?>