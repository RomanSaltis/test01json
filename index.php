<?php


include('./jsonData.php');

//edit
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $contact = edit();
}

//store
if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['id'])){
    store();

    header('location:./');
    die;
    
}

// delete
if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['name'])){
    delete();
    header('location:./');
    die;
}


// update
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
    update();
    header('location:./');
    die;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <title>Contactlist</title>
</head>
<body>
    <form class="form" action="" method="POST">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Vardas</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="name" value="<?=(isset($contact))?$contact['name'] : "" ?>">
            </div> 
         </div>
         <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Pavardė</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="surename" value="<?=(isset($contact))?$contact['surename'] : "" ?>">
            </div>
         </div>
         <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Telefono numeris</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="phone" value="<?=(isset($contact))?$contact['phone'] : "" ?>" >
            </div>
         </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" >Adresas</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="address" value="<?=(isset($contact))?$contact['address'] : "" ?>" >
            </div>
         </div>
         <?php if(!isset($contact)){
            echo '<button class="btn btn-primary" type="submit">Įrašyti</button>';
    }else{
            echo '
            <input type="hidden" name="id" value="'. $contact['id'].' ">
            <button class="btn btn-info" type="submit">Atnaujinti</button>';
    } ?>
           
    </form>

    <table class="table">
        <tr>
            <th>id</th>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Telefono numeris</th>
            <th>Adresas</th>
            <th>Redaguoti</th>
            <th>Ištrinti</th>
        </tr>

        <?php $count = 0; foreach (getData() as $contact) { ?>
            <tr>
                <td><?= ++$count."/".$contact['id'] ?></td>
                <td><?= $contact['name']?></td>
                <td><?= $contact['surename']?></td>
                <td><?= $contact['phone']?></td>
                <td><?= $contact['address']?></td>
                <td><a class="btn btn-success" href="?id=<?= $contact['id']?>">Redaguoti</a></td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?=$contact['id']?>" >
                        <button class="btn btn-warning" type="submit">Ištrinti</button>
                    </form>
                </td>
                
            </tr>
        <?php } ?>
    </table>
    
</body>
</html>

