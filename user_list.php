<!-- 評価申請一覧 -->
<?php
try {
    // DB接続
    $pdo = new PDO(
        // ホスト名、データベース名
        'mysql:host=localhost;dbname=sys3_23_itdev_b',
        // ユーザー名
        'root',
        // パスワード
        'root',
        // レコード列名をキーとして取得される
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
    $sql = 'SELECT * FROM USER';
    // var_dump($sql);
    $statement = $pdo->query($sql);
    // var_dump($statement);
    // レコード件数取得
    $row_count = $statement->rowCount();
    while ($row = $statement->fetch()) {
        $rows[] = $row;
    }
    // var_dump($rows);
} catch (PDOException $e) {
    // エラー発生
    echo $e->getMessage();
} finally {
    // DBを閉じる
    $pdo = null;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メンバー</title>
</head>

<body>
    <table border="1" align="center" width="1000" height="85">
        <tr>
            <th>登録番号</th>
            <th>名前</th>
            <th>区分</th>
            <th>評価</th>
            <th>ポイント</th>
            <th>時給</th>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <th><?php echo $row['ID']; ?></th>
                <th>
                    <a class="linkDetail" href="pushImg.php?sid=<?php echo $row['ID']; ?>">
                        <?php echo $row['NAME']; ?>
                    </a>
                </th>
                <th>
                    <?php if($row['EMPLOYEE'] == 1){
                        echo "社員";
                    }else if($row['EMPLOYEE'] == 2){
                        echo "アルバイト";
                    }else if($row['EMPLOYEE'] == 3){
                        echo "パート";
                    }else{
                        echo "NULL";
                    } ?>
                </th>
                <th><?php echo $row['EVALUATE']; ?></th>
                <th><?php echo $row['POINT']; ?></th>
                <th><?php echo $row['P_HOUR']; ?></th>
            </tr>
        <?php } ?>
    </table>
</body>

</html>
<script src="https://kit.fontawesome.com/841b98f2a1.js" crossorigin="anonymous"></script>