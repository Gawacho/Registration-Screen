<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>POST_SAMPLE</title>

<?php
echo date('Y-m-d')."<br/>\n";//現在日付
?>
</head>
<body>
<form method="POST" action="entry.php">
    <input type="submit" value="登録" />
</form>

<form method="POST" action="serch.php">
    <input type="submit" value="検索" />
</form>
</body>
</html>
