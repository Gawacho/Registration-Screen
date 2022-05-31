<html>
<head><title>PHP TEST</title></head>
<body>

<?php
echo date('Y-m-d')."<br/>\n";//現在日付
?>
<p>ユーザ検索画面</p>

<form method="POST" action="<?php print($_SERVER['PHP_SELF']) ?>">
    ユーザー名<input type="text" name="personal_name"><br><br><!--inputの窓を作れる-->
    パスワード<input type="text" name="password"><br><br><!--inputの窓を作れる-->
    <!-- <textarea name="contents" rows="8" cols="40">
    </textarea><br><br> -->
    <input type="submit" name="btn1" value="検索">
</form>

<?php
    if(isset($_POST['btn1'])){//検索ボタンが押されたら
        readData();
    }


    function readData(){ //検索
        $flag = 0;//ユーザーが見つかっていない
        $personal_name = $_POST['personal_name'];
        $password = $_POST['password'];

        $keijban_file = 'keijiban.txt';#keijiban_fileを開く
        $fp = fopen($keijban_file, 'rb');
        if ($fp){
            if (flock($fp, LOCK_SH)){
                while (!feof($fp)) {
                    $buffer = fgets($fp);
                    if(preg_match('/ユーザー名:'.$personal_name.',パスワード:'.$password.',備考/' , $buffer , $namelist)!=FALSE){
                        $flag = 1;//ユーザーが見つかったよ
                        break;
                    }
                    //preg_match('/パスワード:[^!"#$%&()\*\+\-\.,\/:;<=>?@\[\\\]^_`{|}~]+,/' , $buffer , $passlist);
                    //print $passlist[0];
                    //preg_match('/備考:[^!"#$%&()\*\+\-\.,\/:;<=>?@\[\\\]^_`{|}~]+,/' , $buffer , $remarkslist);
                    //print $remarkslist[0];
                }
                if($flag == 1){
                    echo "ユーザーが見つかりました";
                }else{
                    echo "ユーザーが見つかりませんでした";
                }
                flock($fp, LOCK_UN);
            }else{
                print('ファイルロックに失敗しました');
            }
        }
        fclose($fp);
    }
?>
</body>
</html>
