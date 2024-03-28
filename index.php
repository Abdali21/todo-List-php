<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo-List</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <?php require_once 'includes/database.php'; ?>
    <?php include_once 'includes/nav.php'; ?>
    <div class="container w-75 mx-auto mt-3">
        <div class="border border-primary p-3 rounded">
            <?php 
            $title = '';
            if(isset($_POST['ajouter'])) {
                $title =htmlspecialchars( $_POST['title']);
                if(!empty($title)){
                    $sqlState = $pdo ->prepare("INSERT INTO items values(null,?)");
                    $sqlState ->execute([$title]);

                    ?>
                    <div class="alert alert-success" role="alert">
                        <strong>Title:</strong> <?php echo $title ?>
                    </div>
                    <?php
                }else{
                 ?>
                 <div class="alert alert-danger" role="alert">
                    <strong>Warning</strong> The title is required
                 </div>
                 <?php
                }
            } 
            ?>
            <h4>Ajouter une tache:</h4>
            <form method="post">
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Title<span style="color:red">*</span>:</label>
                    <input type="text"  class="form-control" id="title" name="title" placeholder="entrez le titre de la tache"/>
                    <small id="helpId" class="form-text text-muted">Le titre de la tache</small>
                </div>
                <div class="mt-3">
                    <input type="submit" value="ajouter" name="ajouter" class="btn btn-primary rounded-1">
                </div>
            </form>
        </div>   
        
            <?php 
            $sqlState = $pdo -> query("SELECT * FROM items");
            $items = $sqlState -> fetchAll(PDO::FETCH_OBJ);
             ?>

           <div class="table-responsive">
                <table class="table table-light">
                <tbody>
                    <?php 
                     foreach($items as $key => $item){
                    ?>
                    <tr>
                        <td scope='row'>
                            <span class="badge rounded-pill text-bg-primary">
                                <?php echo $item->id?>
                            </span>
                        </td>
                        <td><?php echo $item->title ?></td>
                        <td>
                            <form method="post">
                                <input type="text" name="id" hidden value="<?php echo $item -> id ?>">
                                <input  formaction="delete.php" type="submit" name="delete" value="delete" class="btn btn-danger">
                                 <input formaction="update.php" type="submit" name="update" value="update" class="btn btn-primary">
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
