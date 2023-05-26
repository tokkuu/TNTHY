<?php

require_once "./dbc.php";
//ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name']; //一時に与えられる名前
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = './image/';
$save_filename =  date('YmdHis').$filename;
// var_dump($file);
$err_msgs = array();
$save_path = "image/".$save_filename;


$category = $_POST['category'];
//キャプションを取得
// $caption = filter_input(INPUT_POST,'caption',FILTER_SANITIZE_SPECIAL_CHARS);

//商品名を取得
$pname=filter_input(INPUT_POST,"pname");
if(!strlen($pname) < 1){
    echo $pname."が登録されました。";
    echo '<br>';
}else if(strlen($pname)>=50){
        echo "商品名は50文字以内です。";
        echo '<br>';
}else{
    echo "商品名が入力されていません。";
    echo '<br>';
}

//値段を取得
$number=filter_input(INPUT_POST,"number");
if(!strlen($number) < 1){
    echo $number."が登録されました。";
    echo '<br>';
}else{ 
    echo "値段が入力されていません。";
    echo '<br>';
}
if(strlen($number)>6){
    echo "値段の桁数は6桁以内です。";
    echo '<br>';
}

if($category == "---"){
    $category = false;
    echo "選択されていません。";
    echo "<br>";
}else{
    echo $category."が選択されました。";
    echo "<br>";

// //キャプションのバリデーション
// //未入力
// if(empty($caption)){
//     array_push($err_msgs,'キャプションを入力してください。') ;
//     echo '<br>';
// }
// if(strlen($caption)>140){
//     array_push($err_msgs,'キャプションは140文字以内で入力してください。');
//     echo '<br>';
// }
//ファイルのバリデーション
//ファイルサイズ
if($filesize > 1048576 || $file_err==2){
    array_push($err_msgs,'ファイルサイズは1MB未満です。');
    echo '<br>';
}

//拡張は画像形式
$allow_ext = array('jpg','jpeg','png');
$file_ext = pathinfo($filename,PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext),$allow_ext)){
    array_push($err_msgs,'画像ファイルを添付してください。');
    echo '<br>';
}

if(count($err_msgs) == 0){
//var_dump($tmp_path);
if(is_uploaded_file($tmp_path)){ //ファイルはあるか
    if(move_uploaded_file($tmp_path,"image/".$save_filename)){ //ファイルを移動
        echo $filename.'を'.$upload_dir.'にアップしました。';
        echo "<br>";
        //DBに保存(カテゴリー、商品名、値段、ファイルパス)
        $result = fileSave($category,$save_path,$pname,$number);
        if($result){
            echo "データベースに保存されました！";
            echo "<br>";
        }else{
            echo "データベースへの保存に失敗しました。";
        }
    }else{ //移動できなければ
       echo 'ファイルが保存できませんでした。';
    }
}else{
    echo 'ファイルが選択されていません。';
    echo '<br>';
}
}else{
    foreach($err_msgs as $msg){
        echo $msg;
        echo '<br>';
    }
}


}
?>

<a href="./upload_form.php">戻る</a>
