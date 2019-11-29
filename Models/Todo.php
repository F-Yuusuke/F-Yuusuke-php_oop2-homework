<?php
// １　1回だけしか呼び出さないからこの書き方
// 自分以外のファイルを読み込む時に使う組み込み関数
// config/dbconnect.phpを読み込んでくださいと言っている
// このファイルを読み込まないといけないのはもともとphpが持っているpdoというクラスを使えるようにするため
require_once('config/dbconnect.php');

?>