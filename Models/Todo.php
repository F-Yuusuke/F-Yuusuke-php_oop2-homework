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

    public function all()
    {
        // $stmt = $this->db_manager->dbh->prepare(ここにsql文);
        // SELECT * FROM テーブル名

        //１２ 登録したデータを表示してくれる
        // prepareとexecuteはセットだからこの２行はかく
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table);
        $stmt->execute();
        // １２　一覧が欲しい時には　->fetchAll();メソッドを使う　取ってきたデータを使いやすくしてくれている
        // 使いやすくしたものを$tasksに入れている
        $tasks = $stmt->fetchAll();
        // １２　この取得したデータを他のところへ持っていけるようにするコードがreturn
        return $tasks;

       }

    //２６　新しいメソッドをこのclassの中に追加
    //editするためのデータを取得 editがgetに変わっている？よくわからない　これは
    // このメソッドは情報を更新するための情報をくださいと言っているだけのメソッドだから
    // もし登録してとか更新してとかっというお願いになるとPOSTになるよ
    // stmtにidの情報を取得している
    // executeとgetのidは繋がっているから入る
    public function get($id)
    {
    $stmt = $this->db_manager->dbh->prepare('SELECT * FROM '.$this->table.' WHERE id = ?');
    $stmt->execute([$id]);
    // ２６　fetchは一個だけ単体で取れるfetchallは全ての情報を取得する
    // 今回だとidごとの情報を取っている
    $task = $stmt->fetch();
    // ２６　この後どこかで使うからこのreturnを使っている
    return $task;
    }

        // ３４　どんなメソッドを作れば更新できる設計図を書くのかを考える
    // 以下のupdateって書かれているところはメソッドの名前だから他の人がみても何をするメソッドなのかがわかるようにしておく
    // ５１　今しているのはupdateして更新された日が登録できる
    public function update($word,$id)
    {
    // ５１　updated_at = ?を付け足した
    // $updated = date('Y-m-d H:i;s', time());を付け足した　Y-m-d H:i;s'は年月とかそれぞれ意味がある
    $stmt = $this->db_manager->dbh->prepare('UPDATE '.$this->table.' SET word = ? , updated_at = ? WHERE id = ?');
    $updated = date('Y-m-d H:i;s', time());
    $stmt->execute([$word, $updated, $id]);
    }

    // ４２　削除機能ができる設計図をかく
    // 削除するに必要なのはidだけだからdeleteの横のかっこに入っている
    // 変数は$idのみ
    public function delete($id)
    {
    // ４２　合致するデータを探してそれを削除している
    $stmt = $this->db_manager->dbh->prepare('DELETE FROM '.$this->table.' WHERE id = ?');
    $stmt->execute([$id]);  
    }


    
    
}

?>