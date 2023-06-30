<?php
    $ID = 1;
    $dbname = 'mysql:host=localhost;dbname=sys3_23_itdev_b';
    $user = 'root';
    $pass = 'root';
    try{
        $pdo = new PDO(
            $dbname,
            $user,
            $pass,
            [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
    $sql = 'SELECT * FROM USER WHERE ID ='.$ID;
    $statement = $pdo->query($sql);
    // レコード件数取得
    $row_count = $statement->rowCount();
    while($row = $statement->fetch()){
        $rows[] = $row;
    }

    
    }catch(PDOException $e){
        echo $e->getMessage();
    }finally{
        $pdo = null;
    }
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>
<?php foreach($rows as $row){ ?>
    <p><?php echo $row['P_HOUR']; ?>円</p>
    <p><?php echo $row['POINT']; ?>p</p>
     
    <?php if($row['POINT'] >= 100){ ?>
            <a>100p → 10円</a>
    <?php }elseif($row['POINT'] >= 350){ ?>
        <a>100p → 10円</a>
        <a>350p → 20円</a>
    <?php }else{ ?>
        <h1>ポイントが足りません。</h1>
    <?php } ?>
    <button>評価申請</button>
<?php } ?>
</body>
</html>