<?php
try{
    $pdo = new PDO(
        'mysql:host = localhost; dbname = sys3_23_itdev_b',//接続するホスト名（IPアドレスの指定）
        'user',//接続するユーザー名
        'root',//接続するパスワード名
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
    $sql = 'SELECT * FROM EV_LIST
            JOIN USER ON (EV_LIST.COME_ID = USER.ID)
            JOIN AREA_D ON (EV_LIST.AREARIST = AREA_D.AREA_D_ID)
            JOIN WORK_D ON (EV_LIST.WORK_ID = WORK_D.WORK_D_ID)';
    $statement = $pdo->query($sql);
    // レコード件数取得
    $row_count = $statement->rowCount();
    while($row = $statement->fetch()){
        $rows[] = $row;
    }

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
        <title>評価,OK・NG</title>
        <link rel="stylesheet" href="css/評価,OK・NG.css">
    </head>

    <body>



    <ul class="sidenav">

        </ul>
        <form action="" method="post">
            <table border="1">
            <div style="text-align:center">
                <a class = "active">申請日:</a><br>
                <a class = "active">申請者:</a><br>
                <a class = "active">基本給:</a><br>
                <a class="active">エリア</a><br>
                <a class="active">仕事</a><br>

                <label for="text">内容</label>
                <p><textarea cols="50" rows="5"></textarea></p>
                <a class="active">ポイント   0000p</a>
                <input type="point" name="point" id="point" required>
                <input type="submit" value="追加"><br>

                <!-- <p><textarea cols="50" rows="5"></textarea></p> -->
                <!-- <p><input type="submit" value="送信"></p> -->
                <button type="submit" name="add">OK</button>
                <button type="submit" name="delete">NG</button>
            </div>
        </form>

    </body>
</html>
