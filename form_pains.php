
<head>

        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_aux.css" />
        <title>Exia miam</title>
	<link rel="shortcut icon" type="image/x-icon" href="pizza.ico" />

</head>


<p>

    <center>Petits pains</center>

</p>
<center>


<form method="post"  >

 

	<fieldset>

      		<legend>Gestion prix </legend> <!-- Titre du fieldset --> 


       			<label for="prix">Prix</label>
       			<input type="text" name="prix" id="prix" />


    			<label for="comment">Comment ?</label>
       			<input type="text" name="comment" id="comment" />
	
	
			<label for="password">Password ?</label>
			<input type="password" name="password" id="password" />

        		<input type="submit" value="Valider" />



	</fieldset>



</center>


	<?php
		//connect to database
		$conn_users = pg_connect("host=postgresql-pi-ux-ce.alwaysdata.net dbname=pi-ux-ce_bdd user=pi-ux-ce password=Palyp557");
		$conn_pains = pg_connect("host=postgresql-pi-ux-ce.alwaysdata.net dbname=pi-ux-ce_pains user=pi-ux-ce_mini_root password=Exiamiam");

		if (!$conn_users) {
  			echo "Une erreur s'est produite.\n";
  			exit;
		}
		//end of connection


		$user = $_POST['user'];
		$password = $_POST['password'];

		//test if the password is good
		$result = pg_query($conn_users, "select count(*) from users where username='pi-ux-ce_pains' and password='$password';");
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
				echo "insert DONE";

			}
		}


		$result = pg_query($conn_pains, "SELECT * FROM pains order by horodateur");
		while ($row = pg_fetch_row($result)) {
 			echo "Time: $row[0]  Argent: $row[1] Comment: $row[2]";
			echo "<br />\n";
			echo "<br />\n";
		}


	?>
	</p>

</form>

