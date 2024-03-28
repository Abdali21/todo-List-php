<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <?php 
        if(!isset($_POST['id'])){
            header('location:index.php');
        }
         include_once 'includes/nav.php';
         require_once 'includes/database.php';
         $id = $_POST['id'];
         $sqlState = $pdo -> prepare('SELECT * FROM items WHERE id = ?');
         $sqlState ->execute([$id]);
         $item = $sqlState-> fetch(PDO::FETCH_OBJ);

         if(isset($_POST['updateB'])){
            $title = $_POST['title'];
            $id = $_POST['id'];
           if(!empty($id) && !empty($title)){
            $sqlState = $pdo ->prepare('UPDATE items  SET title = ? WHERE id = ? ');
            $sqlState -> execute([$title, $id]);
           }
           else{
            ?>
            <div class="alert alert-danger" role="alert">
               <strong>Warning</strong> The title is required
            </div>
            <?php
           }
         }
    ?>
    
    <div class="container w-75 mx-auto mt-3">
        <div class="border border-primary p-3 rounded">
            <h4>Modifier une tache:</h4>
            <form method="post">
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Title<span style="color:red">*</span>:</label>
                    <input type="text" hidden name="id"  value=" <?php echo $item -> id ?>">
                    <input type="text" value="<?php echo $item-> title ?>" class="form-control" id="title" name="title" placeholder="modifier le titre"/>
                    <small id="helpId" class="form-text text-muted">Le titre de la tache</small>
                </div>
                <div class="mt-3">
                    <input type="submit" value="update" name="updateB" class="btn btn-primary rounded-1">
                </div>
            </form>
        </div> 
    </div>
</body>
</html>