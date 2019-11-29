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

     // ７　これをかく prepare excuteが関わってくるよ
    // Todo用のデータを作成するために（レコードの中にデータを入れるため）以下を書いています
    // このcreateメソッドでやっていることはtasks2にINSERTで情報を追加しますということを書いている
    // ５３　更新した日付と登録した日付の更新がうまく表示されないので以下のメソッドの内容を書き換えます。
    public function create($word)
    {
        $stmt = $this->db_manager->dbh->prepare('INSERT INTO '.$this->table.' (name, created_at) VALUES (? ,?)');
        $created = date('Y-m-d H:i:s', time());
        $stmt->execute([$word,$created]);
    }
}

?>