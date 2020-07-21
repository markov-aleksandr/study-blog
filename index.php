<?
require('./templates/header.php');

if (isset($_GET['pages'])){  
    $page = htmlentities($_GET['pages']);
    $path = './pages/'.$page.'.php';
    if (file_exists($path)){
        include($path);
    }
}else{
    include('./pages/home.php');
}

require('./templates/footer.php');