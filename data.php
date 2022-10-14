<?php
#Include the connect.php file
include ('../../web/connect.php');

$mysqli = new mysqli($hostname, $username, $password, $database);


if (mysqli_connect_errno())
	{
	$mysqli -> query("SET NAMES 'utf8'");
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
	}
// get data and store in a json array
$query = "SELECT kategorie.id, n, sort_menu, menu_lewo, nazwa_krotka_kat FROM kategorie JOIN opis_kategorie ON kategorie.opisy_id = opis_kategorie.id";
if (isset($_POST['insert']))
	{
	// INSERT COMMAND
	$query = "INSERT INTO `kategorie`(`n`, `sort_menu`, `menu_lewo`, `nazwa_krotka_kat`) VALUES (?,?,?,?)";
	$result = $mysqli->prepare($query);
	$result->bind_param('ssss', $_POST['n'], $_POST['sort_menu'], $_POST['menu_lewo'], $_POST['nazwa_krotka_kat']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	// printf ("New Record has id %d.\n", $mysqli->insert_id);
	echo $res;
	}
  else if (isset($_GET['update']))
	{
	// UPDATE COMMAND
	$query = "UPDATE kategorie JOIN opis_kategorie ON kategorie.opisy_id = opis_kategorie.id SET n=?, sort_menu=?, menu_lewo=?, nazwa_krotka_kat=? WHERE kategorie.id = ?;";
	$result = $mysqli->prepare($query);
	$result->bind_param('ssssi', $_GET['n'], $_GET['sort_menu'], $_GET['menu_lewo'], $_GET['nazwa_krotka_kat'],$_GET['id']);
	$res = $result->execute() or trigger_error($result->error, E_USER_ERROR);
	echo $res;
	}
  else
	{
	// SELECT COMMAND
	$result = $mysqli->prepare($query);
	$result->execute();
	/* bind result variables */
	$result->bind_result($id, $n, $sort_menu, $menu_lewo, $nazwa_krotka_kat);
	/* fetch values */
	while ($result->fetch())
		{
		$drukarki[] = array(
			'id' => $id,
			'n' => $n,
			'sort_menu' => $sort_menu,
			'menu_lewo' => $menu_lewo,
            'nazwa_krotka_kat' => $nazwa_krotka_kat
		);
		}
	echo json_encode($drukarki);
	}
$result->close();
$mysqli->close();
/* close connection */
?>