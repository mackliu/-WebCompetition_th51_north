<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問卷系統</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fontawesone.css">    
</head>
<body>
<h1 class="container text-center">問卷調查</h1>
<div class="code-block container col-md-3 m-auto">
    <label for="code">您好！請輸入填寫問卷邀請碼：
        <form class="d-flex align-items-center" action="quiz.php" method="get">
            <input type="text" name="code" id="code">
            <input class="btn btn-primary mx-2" type="submit" value="繼續">
        </form>
    </label>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>