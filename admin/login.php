<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>後台管理系統</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/fontawesone.css">
</head>

<body>
    <div class='w-100 p-3' style="box-shadow:0 0 5px #ccc">
        <div class="container text-center" style="font-size:32px;font-weight:bolder">後台問卷管理系統</div>
    </div>
    <div>
        <div class="container">
            <fieldset class='my-5 mx-auto ' style="width:280px!important">
                <legend>管理者登入</legend>
                <form action="api/login.php" method="post">
                    <p>
                        <label for="acc" class='row'>
                            <span class="col-4 text-right">帳　號：</span>
                            <input class="col-8" type="text" name='acc' id='acc'>
                        </label>
                    </p>
                    <p>
                        <label for="pw" class='row'>
                            <span class="col-4 text-right">密　碼：</span>
                            <input class="col-8" type="password" name='pw' id='pw'>
                        </label>
                    </p>
                    <p>
                        <input class='btn btn-primary d-block m-auto' type="submit" value="登入">
                    </p>
                </form>
            </fieldset>

        </div>
    </div>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
</body>

</html>