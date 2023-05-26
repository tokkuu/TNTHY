<?php
?>
<!-- ①フォームの説明 -->
<!-- ②$_FILEの確認 -->
<!-- ③バリデーション -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>アップロードフォーム</title>
  </head>
  <style>
    body {
      padding: 30px;
      margin: 0 auto;
      width: 50%;
    }
    textarea {
      width: 98%;
      height: 60px;
    }
    .file-up {
      margin-bottom: 10px;
    }
    .submit {
      text-align: right;
    }
    .btn {
      display: inline-block;
      border-radius: 3px;
      font-size: 18px;
      background: #67c5ff;
      border: 2px solid #67c5ff;
      padding: 5px 10px;
      color: #fff;
      cursor: pointer;
    }
  </style>
  <body>
  <form enctype="multipart/form-data" action="./file_upload.php" method="POST">
    <p>商品カテゴリー：
    <select name="category">
      <option value="---">選択してください。</option>
      <option value="化粧品">化粧品</option>
      <option value="食品">食品</option>
      <option value="日用品">日用品</option>
      <option value="医薬品・医薬部外品">医薬品・医薬部外品</option>
    </select>
    </p>
    <p>商品名：<input type="text" id="pname" name="pname" maxlength="50" value=""></p>
    <p>価格：<input type="number" id="num" name="number" min="1" max="999999" value=""></p>
    <div class="file-up">
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
    <p>商品画像：<input name="img" type="file" accept="image/*"></p>
    <!-- <textarea
          name="caption"
          placeholder="キャプション（140文字以下）"
          id="caption"
        ></textarea> -->
  </div>
    
  <div class="submit">
    <?php 
    $pname = @$_POST["pname"];
    $number = @$_POST["number"];
    if(!strlen($pname) and !strlen($number)){ ?>
      <button type="" class="btn" >追加</button>
    <?php }else{ ?>
      <input type="submit" value="追加" class="btn" />
    <?php } ?> 
  </div>
</form>
<div class="submit">
  <button class="btn" onclick="location.href='deleList.php'">商品を削除</button>
</div>
</body>
</html>
