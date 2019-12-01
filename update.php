<!-- ３３　情報を更新できるようにするためにこのupdate.phpファイルを作る -->
<!-- 次はここに更新するために必要なコードを書いていく -->
<?php
// 35 'Models/Todo.php'ファイルをリクワイヤー(他ファイルを呼ぶための組み込み関数)する
// なぜならclassTodoの中に使いたいメソッドがあるから
require_once ('Models/Todo.php');

// ３６　ediat.phpで入力された情報を以下で受け取れるようにしている
// （var_dump(この中は変数);何か値を取得できているかどうかを確認したい時に使う）
// $idのなかにPOSTで送られてきたidを格納し、taskの情報も$taskに格納している
$id =$_POST['id'];
$task =$_POST['task'];

// 37　ここでclassTodoが使えるぜって感じ
$todo = new Todo();

// ３８　classTodoのupdateっていうメソッドを実行 更新したいから
// ここは$todoの中のupdateをさっき３６で受け取った$task,$idを使って実行してってこと
$todo->update($task,$id);

// ３９　登録した後にトップのページに戻るためだけに以下を書いた
header('Location: index.php');

// ４０　ここのページはcreate.phpのファイルと同じことをやっている
?>