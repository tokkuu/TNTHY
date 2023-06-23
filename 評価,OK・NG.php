<?php
try{
    // $pdo = new PDO(
    //     'mysql:host=localhost;dbname=sys3_23_itdev_b',//接続するホスト名（IPアドレスの指定）
    //     'sys3_23_itdev_b',//接続するユーザー名
    //     'M3cVGWbY',//接続するパスワード名
    //     [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    // );
    $pdo = new PDO(
        'mysql:host=localhost;dbname=sys3_23_itdev_b',//接続するホスト名（IPアドレスの指定）
        'root',//接続するユーザー名
        'root',//接続するパスワード名
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
    $sql = 'SELECT * FROM EV_LIST
            JOIN USER ON (EV_LIST.COME_ID = USER.ID)
            JOIN AREA_D ON (EV_LIST.AREARIST = AREA_D.AREA_D_ID)
            JOIN WORK_D ON (EV_LIST.WORK_ID = WORK_D.WORK_D_ID) WHERE EV_ID = 1';
            // var_dump($sql);
    $statement = $pdo->query($sql);
    // レコード件数取得
    $row_count = $statement->rowCount();
    //var_dump($row_count);
    while($row = $statement->fetch()){
        $rows[] = $row;
    }

    } catch (PDOException $e) {
        // エラー発生
        echo $e->getMessage();
    } finally {
        //$pdo->commit();
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

                <a class = "active">申請日:</a>
                <?php foreach($rows as $row)?>
                <?php echo $row['INPUT']; ?>
                <br>

                <a class = "active">申請者:</a>
                <?php echo $row['NAME']; ?><br>

                <a class = "active">基本給:</a>
                <?php echo $row['P_HOUR']; ?><br>

                <a class="active">エリア:</a>
                <?php echo $row['AREA_NAME']; ?><br>

                <a class="active">仕事:</a>
                <?php echo $row['WORK_NAME']; ?><br>

                <a class="active">内容:</a>
                <?php echo $row['TEXT']; ?><br>

                <a class="active">ポイント:</a>
                <?php echo $row['POINT']; ?>
                <a class="active">p</a><br>

                <input type="number" value="" name="point" id="point" required>
                <input type="submit" value="追加"><br>

                <?php
                    // $pdo = new PDO(
                    //     'mysql:host=localhost;dbname=sys3_23_itdev_b',//接続するホスト名（IPアドレスの指定）
                    //     'sys3_23_itdev_b',//接続するユーザー名
                    //     'M3cVGWbY',//接続するパスワード名
                    //     [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
                    // );
                    $pdo = new PDO(
                        'mysql:host=localhost;dbname=sys3_23_itdev_b',//接続するホスト名（IPアドレスの指定）
                        'root',//接続するユーザー名
                        'root',//接続するパスワード名
                        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
                    );
                    $recpoint = 800;
                    $id = 2;
                    // $recpoint = $_POST['point'];
                    // $id = $_POST['id'];
                    $sql = "UPDATE USER SET POINT = " . $recpoint . " WHERE ID = " . $id . ";";
                    // var_dump($sql);
                    $stmt = $pdo->prepare($sql);
                    // $stmt->bindparam(':point','1000',PDO::PARAM_INT);
                    // $stmt->bindparam(':id','2',PDO::PARAM_INT);
                    $res = $stmt->execute();
                    // $pdo->commit();
                    $pdo = null;
                ?>

                <?php //foreach($rows as $row)  ?>
            </div>
        </form>
    </body>
</html>
