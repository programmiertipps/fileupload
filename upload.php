<!doctype html>
<html lang="de-DE">
<head>
    <meta charset="UTF-8">
    <title>Fileupload</title>
	<link rel="stylesheet" href="css/style.css">        
</head>
<body>

<?php

$file_name = pathinfo($_FILES['files']['name'], PATHINFO_FILENAME);
$file_extension = strtolower(pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION));
$allowed_file_extension = array('zip', 'gzip');
$max_file_size = 1000*1024; // 1MB
$upload_folder = 'uploads/files/'; 
$update_path = $upload_folder.$file_name.'.'.$file_extension;

// Abfragen ob erlaubte Endung
 
if(!in_array($file_extension, $allowed_file_extension)) {
   die('Ungültige Dateiendung');
}

// Abfragen ob Datei zu groß

if($_FILES['files']['size'] > $max_file_size) {
  die('Datei ist zu groß.');
}

// Abfragen ob Datei schon vorhanden, wenn ja Datum anhängen

if(file_exists($update_path)) { 
	$new_name = date('Y-m-d-H-i-s');
	do {
		$update_path = $upload_folder.$file_name.'_'.$new_name.'.'.$file_extension;
	} 
	while(file_exists($update_path));
}

// Wenn alles passt, dann hochladen

move_uploaded_file($_FILES['files']['tmp_name'], $update_path);

echo '<div class="upload-form"><h2>Upload erfolgreich</h2><p><a href="index.php">Neue Datei hochladen</a></div>'; 

?>

</body>
</html>