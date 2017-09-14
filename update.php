<?php

$timestamp = date('Y-m-d H:i:s', time());
$pdo = new PDO("mysql:host=127.0.0.1;dbname=article", 'dbuser', '123');

if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['created_at'])) {


    $stmt = $pdo->prepare('UPDATE article SET name = :name, description = :description, created_at = :created_at WHERE id = :id');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->bindValue(':name', $_POST['name']);
    $stmt->bindValue(':description', $_POST['description']);
    $stmt->bindValue(':created_at', $_POST['created_at']);

    $stmt->execute();
//    var_dump($pdo->errorInfo());
//    var_dump($stmt->errorInfo());

    header('Location: index.php');
}

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM article WHERE id = :id');
    $stmt->bindValue(':id', $_GET['id']);
    $stmt->execute();
    $article = $stmt->fetch();
} else {
    header('Location: index.php');
}


?>

<form method="post">
    <input type="text" required name="name" placeholder="name" value="<?php echo $article['name'] ?>">
    <br>
    <input type="text" required name="description" placeholder="description" value="<?php echo $article['description'] ?>">
    <br>
    <input type="text" required name="created_at" placeholder="created_at" value="<?php echo $article['created_at'] ?>">
    <br>
    <input type="submit">
</form>
