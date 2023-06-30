<!-- 評価申請一覧 -->
<?php
try{
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
    $sql = 'SELECT * FROM EV_LIST
            JOIN USER ON (EV_LIST.COME_ID = USER.ID)
            JOIN AREA_D ON (EV_LIST.AREARIST = AREA_D.AREA_D_ID)
            JOIN WORK_D ON (EV_LIST.WORK_ID = WORK_D.WORK_D_ID)';
    // var_dump($sql);
    $statement = $pdo->query($sql);
    // var_dump($statement);
    // レコード件数取得
    $row_count = $statement->rowCount();
    while($row = $statement->fetch()){
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
                <a class="linkDetail" href="pushImg.php?sid=<?php echo $row['EV_ID']; ?>">
                    <th><?php echo $row['INPUT']; ?></th>
                        <th>
                            <a class="linkDetail" href="pushImg.php?sid=<?php echo $row['EV_ID']; ?>">    
                                <?php if($row['COME_ID'] == $row['ID']){ 
                                    echo $row['NAME'];
                                }?>
                            </a>
                        </th>
                    <th>
                        <?php if($row['AREA_D_ID'] == $row['AREARIST']){
                            echo $row['AREA_NAME'];
                        } ?>
                    </th>
                    <th>
                        <?php if($row['WORK_D_ID'] == $row['WORK_ID']){
                            echo $row['WORK_NAME'];
                        } ?>
                    </th>
                    <th><?php echo "{$row['TEXT']}"; ?></th>
                    <th>
                        <?php if("{$row['OK_NG']}" == 1){ ?>
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                            <!-- <i class="fa-duotone fa-check fa-2xs" style="--fa-secondary-opacity: 0.1;"></i> -->
                        <?php }elseif ("{$row['OK_NG']}" == 2) { ?>                      
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                        <?php }else{ ?>
                            
                        <?php } ?>
                    </th>
                </a>
            </tr> 
        <?php } ?>
    </table>    
</body>
</html>
<script src="https://kit.fontawesome.com/841b98f2a1.js" crossorigin="anonymous"></script>
