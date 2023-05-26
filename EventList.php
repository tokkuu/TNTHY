<!-- 評価申請一覧 -->
<?php
try{
    // DB接続
    $pdo = new PDO(
        // ホスト名、データベース名
        'mysql:host=localhost;dbname=studb',
        // ユーザー名
        'dbuser',
        // パスワード
        'ecc',
        // レコード列名をキーとして取得される
        [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
    $sql = 'select * from user';
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>評価申請一覧</title>
</head>
<body>
    <table border="1" align="center" width="1000" height="85">
        <tr>
            <th>申請日</th>
            <th>申請者</th>
            <th>エリア区分</th>
            <th>仕事区分</th>
            <th>内容</th>
            <th>済</th>
        </tr>
        <?php foreach($rows as $row){ ?>
            <tr>
                <th><?php echo "{$row['USER_NO']}"; ?></th>
                <th><?php echo"{$row['NNAME']}" ?></th>
                <th><?php echo "{$row['RUBY']}"; ?></th>
                <th><?php echo "{$row['MAIL']}"; ?></th>
                <th><?php echo "{$row['PASSWORD']}"; ?></th>
                <th>
                    <?php if("{$row['']}" == 1){ ?>
                        <i class="fa-duotone fa-check fa-2xs" style="--fa-secondary-opacity: 0.1;"></i>
                    <?php }else{
                            
                    }?>
                </th>
            </tr>
        <?php } ?>
    </table>    
</body>
</html>
<script src="https://kit.fontawesome.com/841b98f2a1.js" crossorigin="anonymous"></script>
