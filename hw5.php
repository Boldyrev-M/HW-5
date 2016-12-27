<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo PHP_EOL;

$fileName = "phonetable.json";
(file_exists($fileName)) ? $fp_PhoneTableFile = fopen( $fileName ,"r") :  die("Не найден файл $fileName ") ;
$filecontent = fread ($fp_PhoneTableFile, filesize($fileName));
fclose($fp_PhoneTableFile);
$phonetable = json_decode($filecontent, true);
echo '<html><head>
		<meta charset="utf-8">';
if($phonetable!==null)
	{
	echo '<table border = "2" align = "center"><caption>Телефонная книга</caption><tr><th>Имя</th><th>Фамилия</th><th>Адрес</th><th>Телефон</th></tr>';
	
	foreach ($phonetable as $personalData)
	{	
		echo "<tr><td>".$personalData['firstName']."</td>";
		echo "<td>".$personalData['lastName']."</td>";
		echo "<td>"
				.$personalData['address']['street']."<br />"
				.$personalData['address']['city']."<br />"
				.$personalData['address']['zipCode']."
				</td>";
		echo '<td align = "right" valign = "top">';
		foreach ($personalData['phoneNumbers'] as $number)
		echo $number."<br />";
		echo "</td>";
		
		/*
		"firstName", 		
		"lastName",
		"address": { "street", "city", "zipCode"},
		"phoneNumbers"
		*/
	}
	echo "</tr></table>";
	
//var_dump($phonetable);
	}
	else
	{
	//http://php.net/manual/en/function.json-last-error.php
	switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }
	}
?>