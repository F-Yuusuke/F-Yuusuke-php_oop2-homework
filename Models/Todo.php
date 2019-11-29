<?php
// １　1回だけしか呼び出さないからこの書き方
// 自分以外のファイルを読み込む時に使う組み込み関数
// config/dbconnect.phpを読み込んでくださいと言っている
// このファイルを読み込まないといけないのはもともとphpが持っているpdoというクラスを使えるようにするため
require_once('config/dbconnect.php');

// 2class Todoを作る
class Todo
{
    // ３　１行目はデータベースのtasks2を使いたいからそれを使ってねって言っていて
    // さらにはtasks2をtableに代入することによって他のところでもtableと書くだけで
    // tasks2を使えるようになるし（もしtasks2じゃなくともっと長い名前だったらめんどい）
    // 何かあってtasks2じゃなくtasks3になった時は今書いたコードをtasks3に変更するだけで
    // 全てのファイルに対応できる
    // ２行目はデータベースの中の値をこのclassの中で使えるように宣言
    // dbconnect.phpで作ったclass DbManagerを使いたいからここに書いている
    private $table = 'tasks2';
    private $db_manager;

    // ４　３の２行目で書いたやつを使えるようにDbManagerをnewしている
    // これが誕生した瞬間にデータベースに接続してくださいっていう命令を書いているのがconstruct
    // 上記の命令が初期値
    // ２行目の意味は自分が所属しているクラスのdb_managerさらにdb_managerのなかにある
    // connectを使ってってこと
    // thisはフォルダを管理するときの/と一緒の意味
    public function __construct()
    {
        $this->db_manager = new DbManager();
        $this->db_manager->connect();
    }
}

?>