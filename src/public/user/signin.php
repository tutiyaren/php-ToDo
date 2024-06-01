

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDoアプリ</title>
</head>
<body>
    <div>
        <div>
            <h1>ログイン</h1>
        </div>
        <div>
            <!-- <?php echo $success ?>
            <?php echo $error ?>  -->
        </div>
        <!-- form -->
        <form action="../../process/user/signin_complete.php" method="post">
            <div>
                <input type="email" name="email" placeholder="Email">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div>
                <button type="submit">ログイン</button>
            </div>
        </form>
        <div>
            <a href="signup.php">アカウントを作る</a>   
        </div>
    </div>
</body>
</html>