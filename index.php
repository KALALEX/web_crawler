<!DOCTYPE html>
<?php
//require_once('db_operations.php');
?>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Main</title>
</head>
<body>
<h1>Result</h1>
<div>
    <h1>Result</h1>

    <form action="show_all_links.php", method="post">
        Enter Webpage to show all links for: <br>
        <input type="text" name="url" value="">
        <br>
        <input type="submit" value="Submit">
    </form>
    <br>
    <br>
    <form action="title_show_link.php", method="post">
        Enter link to show page title: <br>
        <input type="text" name="url" value="">
        <br>
        <input type="submit" value="Submit">
    </form>
    <br>
    <br>
    <form action="keyword_show_links.php", method="post">
        Enter keyword to show page pages: <br>
        <input type="text" name="url" value="">
        <br>
        <input type="submit" value="Submit">
    </form>
    <br>
    <br>
    <form action="show_all_link_num.php", method="">
        Show num of links: <br>
        <input type="submit" value="Submit">
    </form>
    <br>
    <br>
    <form action="show_k.php", method="post">
        Show top-k pages: <br>
        <input type="text" name="url" value="">
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>