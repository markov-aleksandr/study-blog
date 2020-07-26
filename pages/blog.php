<h1 class="text-dark text-center">Все статьи блога</h1>
<?php
require 'db.php';
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
    echo '<div class="text-primary container-fluid bg-light">'. $book->name . '</div>';
    echo '<div class="text-dark container-fluid bg-black-50">' . $book->article_name . '</div>';
    echo '<div class="text-light container-fluid bg-dark">'. $book->text_article . '</div>';
}

