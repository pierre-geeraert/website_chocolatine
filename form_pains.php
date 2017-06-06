<head>

        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_aux.css" />
        <title>Exia miam</title>
	<link rel="shortcut icon" type="image/x-icon" href="pizza.ico" />
	<meta name="viewport" content="width=device-width"/>
</head>


<p>

    <center>Petits pains</center>
<form method="post"  >
		<p class="introduction">
			
			<input type="password" name="password" id="password" placeholder="Password" >
			</br>
			<input type="submit" value="Valider" />
						
			<input type="reset" value="reset" />

		</p>

</p>
<center>




 

	<fieldset>

      		<legend>Gestion prix </legend> <!-- Titre du fieldset --> 


       			<label for="prix">Prix    </label>
			<input type="tel" name="prix" id="prix" />
			<br />	

    			<label for="comment">Comment ?</label>
       			<input type="text" name="comment" id="comment" />
			<br />
	
			
        		

	</fieldset>


	<fieldset>

      		<legend>Suppression </legend> <!-- Titre du fieldset --> 


       			<label for="ID">ID    </label>
      			<input type="tel" name="id_supp" id="id_supp" />
			<br />	

    			<label for="comment">Comment ?</label>
       			<input type="text" name="comment_supp" id="comment_supp" />
			<br />
	
			
			


	</fieldset>

</form>

</center>

	<fieldset>

                <legend>Historique de la cagnotte </legend> <!-- Titre du fieldset -->
	<?php
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
		$result = pg_query($conn_pains, "select count(*) from users where username='pi-ux-ce_pains' and password='$password';");
		$rows = pg_num_rows($result);
		

		date_default_timezone_set('Europe/Paris');
		$date =  date('d M Y H:i:s');

		while ($row = pg_fetch_row($result)) {

			if($row[0]==1)
			{

				$query1 = "insert into pains(horodateur,argent,comment) values (now(),$prix,'{$comment}');";
				$query2 = "delete from pains where idclient=$id";
					
				pg_query($conn_pains,$query1);//insert argent
				pg_query($conn_pains,$query2);//drop mistakes
				

				?>
					<meta http-equiv="refresh" content="1; url=jeu.php" />
					
			<?php			
			}
		}


		$result = pg_query($conn_pains, "SELECT * FROM pains order by horodateur");
		while ($row = pg_fetch_row($result)) {
 			echo "ID: $row[0] Time: $row[1]     Argent: $row[2] Commentaire: $row[3]";
			
			echo "<br />\n";
			echo "<br />\n";
		}


	?>
	</fieldset>
	</p>


