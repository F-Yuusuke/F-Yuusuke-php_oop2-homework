<!-- ６　create.phpを作った -->
<?php
// ７.５　他のファイルを呼び出すための組み込み関数　一回しか実行されない
require_once('Models/Todo.php');

// ８　index.phpのinput要素に入力された言葉をここに受け取るようにしている
// ここはindex.phpと繋がってる。詳しくはノートの４ページに書いてあります
$task = $_POST['task'];

// ９　ここでclassTodoが使えるぜって感じ
$todo = new Todo();
// １０　ここは８で送られてきた情報（$taskに代入されているのが８を見ればわかる）
// を利用してClassTodoのなかにあるcreateメソッドを
// 実行してもらえるようにコードを書いています
$todo->create($task);


?>