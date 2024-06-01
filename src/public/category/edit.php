

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDoアプリ</title>
</head>
<body>

    <?php include '../header/header.php'; ?>

    <div>

        <!-- カテゴリ編集 -->
        <form action="../../process/category/update.php" method="POST">
            <input type="text" name="name" value="カテゴリ">
            <button type="submit" name="">更新</button>
        </form>

        <!-- カテゴリ一覧リンク -->
        <div>
            <a href="index.php">戻る</a>
        </div>
    </div>
    
</body>
</html>
