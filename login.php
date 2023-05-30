<!-- ログイン機能 -->
<?php
//①エラーメッセージの初期状態を空に
$err_msg = "";

//②サブミットボタンが押されたときの処理
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //③データが渡ってきた場合の処理
    try {
        $pdo = new PDO(
            // ホスト名、データベース名
            'mysql:host=localhost;dbname=sys3_23_itdev_b',
            // ユーザー名
            'sys3_23_itdev_b',
            // パスワード
            'M3cVGWbY',
            // レコード列名をキーとして取得される
            [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
        $sql = 'select * from users where username=? and password=?';
        $stmt = $db->prepare($sql);
        $stmt->execute(array($username, $password));
        $result = $stmt->fetch();
        $stmt = null;
        $db = null;

        //④ログイン認証ができたときの処理
        if ($result[0] != 0) {
            header('Location: http://localhost/home.php');
            exit;

            //⑤アカウント情報が間違っていたときの処理
        } else {
            $err_msg = "アカウント情報が間違っています。";
        }

        //⑥データが渡って来なかったときの処理
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }finally{
        $pdo = null;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <div class="signin">
        <form action="" method="POST">
            <label for="signin-id">アカウント名</label>
            <input id="signin-id" name="username" type="text" placeholder="メールアドレスを入力">
            <label for="signin-pass">パスワード</label>
            <input id="signin-pass" name="password" type="text" placeholder="パスワードを入力">
            <button name="signin" type="submit">ログインする</button>
        </form>
    </div>
</body>

</html>