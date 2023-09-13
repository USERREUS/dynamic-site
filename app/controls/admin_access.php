<?

if (isset($_SESSION['id'])){
    if ($_SESSION['admin'] != 1){
        echo "Доступ на страницу запрещен";
        exit();
    }
}else{
    header('location: ' . BASE_URL . 'forms/signin/signin.php');
}

?>