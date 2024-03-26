

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
        <!-- カテゴリを追加リンク -->
        <div>
            <a href="../category/index.php">カテゴリを追加</a>
        </div>
        <!-- タスク追加 -->
        <form action="../../process/task/store.php" style="display: flex;">
            <div>
                <select name="" id="">
                    <option value="" disabled selected style="display:none;">カテゴリを選んでください</option>
                    <option value="">カテゴリ1</option>
                </select>
            </div>
            <div>
                <input type="text" name="contents" placeholder="タスクを追加">
            </div>
            <div>
                <input type="date">
            </div>
            <div>
                <button type="submit" name="">追加</button>
            </div>
        </form>
        <!-- ホームリンク -->
        <div>
            <a href="../index.php">戻る</a>
        </div>
    </div>
    
</body>
</html>
