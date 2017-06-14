<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/pains.css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <title>Exia miam</title>
	<link rel="shortcut icon" type="image/x-icon" href="pizza.ico"/>
	<meta name="viewport" content="width=device-width"/>
</head>

<body>
<nav class="navbar navbar-default">
    <div class="container">
        <img id="logo" src="img/exiamiam_logo.png" alt="">
    </div>
</nav>
<div class="body-content container">
    <div class="row">
    <form class="form-horizontal" method="post">
        <div class="col-md-4 col-sm-12">
            <h3 class="text-info">Mise à jour :</h3>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">€</span>
                    <input type="text" name="prix" id="prix" class="form-control">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-comment-o" aria-hidden="true"></i></span>
                    <input type="text" name="comment" id="comment" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <h3 class="text-danger">Suppression :</h3>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">id</span>
                    <input type="text" name="id_supp" id="id_supp" class="form-control">
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-comment-o" aria-hidden="true"></i></span>
                    <input type="text" name="comment_supp" id="comment_supp" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <h3 class="text-success">Validation :</h3>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                </div>
                <div class="btn-group pull-right col-sm-12">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit" class="btn btn-success">Valider</button>
                </div>
            </div>
        </div>
    </form>
    </div>
    <div class="row">
        <h3>Historique</h3>
        <?php
        //TODO: regex + sécurité
        //connect to database
        $conn_pains = pg_connect("host=postgresql-pi-ux-ce.alwaysdata.net dbname=pi-ux-ce_pains user=pi-ux-ce_mini_root password=Exiamiam");
        if (!$conn_pains) {
            echo "Une erreur s'est produite.\n";
            exit;
        }
        //end of connection
        $prix = $_POST['prix'];
        $comment=$_POST['comment'];
        $password = $_POST['password'];
        $id = $_POST['id_supp'];
        $comment_supp = $_POST['comment_supp'];
        unset($_POST);
        //test if the password is good
        if ($password = "Exiamiam"){
            $result = pg_query($conn_pains, "select count(*) from users where username='pi-ux-ce_pains' and password='$password';");
            $rows = pg_num_rows($result);
            $p = TRUE;
        }
        while ($row = pg_fetch_row($result)) {
            if($prix != NULL or $id != NULL and $p = TRUE)
            {
                $query1 = "insert into pains(horodateur,argent,comment) values (now(),$prix,'{$comment}');";
                $query2 = "delete from pains where idclient=$id";

                if ($prix != NULL){
                    pg_query($conn_pains,$query1);//insert argent
                }
                if ($id != NULL){
                    pg_query($conn_pains,$query2);//drop mistakes
                }
            }
        }
        $results = pg_query($conn_pains, "SELECT * FROM pains order by horodateur DESC");
        ?>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Bénéfices</th>
                    <th class="text-center">Commentaire</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = pg_fetch_row($results)) {?>
                    <tr>
                        <td class="text-center"><?php echo $row[0]?></td>
                        <td class="text-center"><?php echo $row[1]?></td>
                        <td class="text-center"><?php echo $row[2]?> €</td>
                        <td class="text-center"><?php echo $row[3]?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
