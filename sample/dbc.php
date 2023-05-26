<?php

    function dbc(){
        $host = "localhost";
        $dbname = "sys1_iesk2bc_h";
        $user = "sys1_iesk2bc_h";
        $pass = "xW6YcJE9";

        $dns = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try{
            $pdo = new PDO(
            $dns,$user,$pass,
            [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC  
            ]);
            return $pdo;
        }catch(PDOEException $e){
            exit($e->getMessage());
        }
    }
    /**
    *ファイルデータを保存
    *@param string $category
    *@param string $save_path
    *@param string $pname
    *@param string $number
    *@return bool $result
    */

function fileSave($category,$save_path,$pname,$number){
     $result = false;

     $sql = "INSERT INTO `PRODUCTLIST`(CATEGORY, IMGPAS, PRODUCT, PRICE) VALUES (?, ?, ?, ?)";
try{
    $stmt = dbc()->prepare($sql);
    $stmt->bindValue(1,$category);
    $stmt->bindValue(2,$save_path);
    $stmt->bindValue(3,$pname);
    $stmt->bindValue(4,$number);
    $result = $stmt->execute();
    return $result;
}catch(\Exception $e){
    echo $e->getMessage();
    return $result;
}
}
?>