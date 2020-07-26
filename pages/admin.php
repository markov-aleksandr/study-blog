<?php
require 'db.php';
$create = $_POST;
$error = array();
if (isset($create['create'])) {
    if (trim($create['name']) == '') {
        $error[] = 'Enter your name!';
    }
    if (trim($create['article_name']) == '') {
        $error[] = 'Enter article name!';
    }
    if (trim($create['create_article']) == '') {
        $error[] = 'Enter text article!';
    }
    if (empty($error)) {
        $article = R::dispense('article');
        $article->name = $create['name'];
        $article->article_name = $create['article_name'];
        $article->text_article = $create['create_article'];
        $article->time = date("Y/m/d");
        R::store($article);
        echo '<div class="text-center text-success">Successfully </div>';
    } else {
        echo '<div style="color: #a52a2a;" class="text-center text-"> ' . array_shift($error) . ' </div>';
    }
}
echo "Today is " . date("Y/m/d") . "<br>";
?>

    <form method="POST">
        <h1>Create article</h1>
        <label>Your name</label>
        <input type="text" name="name" placeholder="Your name:">
        <br>
        <label>Article name</label>
        <input type="text" name="article_name" placeholder="Article name:">
        <br>
        <textarea name="create_article" cols="100" rows="10" placeholder="Text article"></textarea><br>
        <button class="btn btn-primary" name="create">Create</button>
    </form>

    <h1 class="text-dark text-center">All articles</h1>
    <form method="POST">
        <p>Delete post №
            <input type="text" placeholder="ID - " name="delete">
            <button class="btn-primary" name="do_delete">Delete</button>
        </p>
    </form>

<?php
$del = $_POST;
if (isset($del['do_delete'])) {
    $ids = (integer)$del['delete'];
    $book = R::load('article', $ids);
    R::trash($book);
}

$ids = array();
$count = R::count('article');//подсчет значений в базе;
for ($i = 1; $i <= $count; $i++) { //цикл на заполнение масива;
    $ids[] = $i;
//   var_dump($ids);
//    var_dump($count);
}
$article = R::loadAll('article', $ids); //подгрузка значений из БД;
//var_dump($article);
foreach ($article as $book) { //цикл на вывод данных из БД --> Нужно форматировать в божеский вид;
    echo '<div class="text-dark container ">' . $book->name . '</div>';
    echo '<div class="text-dark container">' . $book->article_name . '</div>';
    echo '<div class="text-dark container">' . $book->text_article . '</div>';
}
