
<head>

        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_aux.css" />
        <title>Exia miam</title>
	<link rel="shortcut icon" type="image/x-icon" href="pizza.ico" />
	<meta name="viewport" content="width=device-width"/>
</head>


<p>

    <center>Petits pains</center>

</p>
<center>


<form method="post"  >

 

	<fieldset>

      		<legend>Gestion prix </legend> <!-- Titre du fieldset --> 


       			<label for="prix">Prix    </label>
      			<input type="tel" name="prix" id="prix" />
			<br />	

    			<label for="comment">Comment ?</label>
       			<input type="text" name="comment" id="comment" />
			<br />
	
			<label for="password">Password ?</label>
			<input type="password" name="password" id="password">
			<br />
        		<input type="submit" value="Valider" />
			<input type="reset" value="reset" />
			<li><a href="#" class="call-to-action">Contact</a></li>

	</fieldset>



</center>

	<fieldset>

                <legend>Historique des prix </legend> <!-- Titre du fieldset -->
	<?php
		//connect to database
		
		$conn_pains = pg_connect("host=postgresql-pi-ux-ce.alwaysdata.net dbname=pi-ux-ce_pains user=pi-ux-ce_mini_root password=Exiamiam");

		if (!$conn_pains) {
  			echo "Une erreur s'est produite.\n";
  			exit;
		}
		//end of connection


		$user = $_POST['user'];
		$password = $_POST['password'];

		//test if the password is good
		$result = pg_query($conn_pains, "select count(*) from users where username='pi-ux-ce_pains' and password='$password';");//changement de connection car users et dans bdd pains 
		$rows = pg_num_rows($result);
		$prix = $_POST['prix'];
		$comment=$_POST['comment'];

		date_default_timezone_set('Europe/Paris');
		$date =  date('d M Y H:i:s');

		while ($row = pg_fetch_row($result)) {

			if($row[0]==1)
			{

				$query1 = "insert into pains(horodateur,argent,comment) values (now(),$prix,'{$comment}');";

				pg_query($conn_pains,$query1);
				//faire qqchose si ca marche
				//<audio src="musique.mp3"> </audio>
				?>
				<script language="javascript">
					alert("Felicitation c'est bon");
				</script>
			<?php			
			}
		}


		$result = pg_query($conn_pains, "SELECT * FROM pains order by horodateur");
		while ($row = pg_fetch_row($result)) {
 			echo "Time: $row[0]     Argent: $row[1] Commentaire: $row[2]";
			echo "<br />\n";
			echo "<br />\n";

		}


	?>
	</fieldset>
	</p>

</form>


