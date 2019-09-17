<?mysqli_

error_reporting(E_ALL);
ini_set('display_errors', '1');
$uploaddir = 'img/account/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$name = $_POST['name'];

if (file_put_contents($uploaddir . $name, $uploadfile)) {

    echo "File is valid, and was successfully uploaded.\n";

    $image = $_GET[$name];
    echo '<img src = "img/account/<?mysqli_ echo $image; ?>">';
} else {
    echo "File upload failed,\n";
}


pg_close($conn);
?>