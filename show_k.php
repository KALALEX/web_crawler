<!DOCTYPE html>
<?php
require_once('SQLconfig.php');
?>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Main</title>
</head>
<body>
<h1>Algorithm 2 Result</h1>
<div>
    <?php
    require_once('SQLconfig.php');
    $value = $_POST['url'];
    $dbconn = mysqli_connect(DB_HOST, DB_USER,DB_PASSWORD, DB_DATABASE) or die('MySQL connection failed!' . mysqli_connect_error());
    mysqli_set_charset($dbconn, "utf8");

    $querry = "SELECT homepages.link FROM homepages, pages GROUP BY COUNT(pages.*) ";

    $result = $dbconn->query($querry);
    foreach ($result as $item){
        $i = 0;
        foreach ($item as $value) {
            print "<p>" . $value . "</p>";
            if ($value == $i){
                break;
            }
        }
    }
    ?>
</div>
</body>
</html>