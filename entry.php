<html>
<head><title>PHP TEST</title></head>
<body>

<?php
    echo date('Y-m-d')."<br/>\n";//現在日付
?>

<p>ユーザ登録画面</p>

<form method="POST" action="<?php print($_SERVER['PHP_SELF']) ?>">
    ユーザー名<input type="text" name="personal_name"><br><br><!--inputの窓を作れる-->
    パスワード<input type="text" name="password"><br><br><!--inputの窓を作れる-->
    備考<br><br>
<textarea name="remarks" rows="8" cols="40" required>
</textarea>
<input type="submit" name="btn1" value="登録">
</form>

<?php
    if(isset($_POST['btn1'])){
        writeData();
    }


    function writeData(){
        $personal_name = $_POST['personal_name'];
        $password = $_POST['password'];
        $remarks = $_POST['remarks'];

        $str_len = strlen($personal_name);
        if((preg_match( '/[!-~]{1,30}/', $personal_name)==FALSE)or($str_len > 30)){
            echo 'err :ユーザー名の入力文字は半角30字以内です';
            return;
        }

        $str_len = mb_strlen($password);
        if((preg_match( '/[!-~]{1,30}/', $password)==FALSE)or($str_len > 30)){
            echo 'err :パスワードの入力文字は半角30字以内です';
            return;
        }

        $str_len = mb_strlen($remarks);
        if((preg_match( '/[!-~]{0,300}/', $remarks)==FALSE)or($str_len > 300)){
            echo 'err :備考の入力文字は半角300字以内です';
            return;
        }

        $data = "ユーザー名:".$personal_name.",パスワード:".$password.",備考:".$remarks."\r\n";
        $keijban_file = 'keijiban.txt';

        $fp = fopen($keijban_file, 'ab');

        if ($fp){
            if (flock($fp, LOCK_EX)){
                if (fwrite($fp,  $data) === FALSE){#ここで$dataの書き込み
                    print('ファイル書き込みに失敗しました');
                }else{
                    echo "正常に登録されました";
                }
                flock($fp, LOCK_UN);
            }else{
                print('ファイルロックに失敗しました');
            }
        }
        fclose($fp);
        exit ;
    }
?>
</body>
</html>
