
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

      		<legend>Reservation </legend> <!-- Titre du fieldset --> 


       			<label for="prenom">Prenom    </label>
      			<div style="text-align:center;"><input type="text" name="prix" id="prix" /></div>
		

    			<label for="nom">Nom</label>
       			<div style="text-align:center;"><input type="text" name="comment" id="comment	" /></div>
			

			<label for="numero">Numero</label>
			<div style="text-align:center;"><input type="tel" name="numero" id="numero"></div>
			

			<label for="mail">Mail</label>
                        <div style="text-align:center;"><input type="email" name="mail" id="mail" /></div>
                        

			<label for="date">Date</label>
                        <div style="text-align:center;"><input type="date" name="date" id="date" /></div>
                  

			<label for="salle">Salle</label>
                        <div style="text-align:center;"><input type="text" name="salle" id="salle" /></div>
                   

			<label for="derangeable">Peut t-on deranger votre intervenant ?</label><br />
			<input type="radio" name="age" value="oui" id="oui" /> <label for="oui">oui</label>
      			<input type="radio" name="age" value="non" id="non" /> <label for="non">non</label><br />
                   

			<label for="nbr pains">nbr petit pains</label>
                        <div style="text-align:center;"><input type="number" min="0" name="nbr_petit_pains" id="nbr_petit_pains" /></div>


			<label for="nbr croissants">nbr croissants</label>
                        <div style="text-align:center;"><input type="number" min="0" name="nbr_croissants" id="nbr_croissants" /></div> 
                   

			
        		<input type="submit" value="Valider" />
			<input type="reset" value="reset" />


	</fieldset>



</center>

	<fieldset>

                <legend>a retirer car confidentiel </legend> <!-- Titre du fieldset -->
	<?php
		//connect to database
		$conn_pains = pg_connect("host=postgresql-pi-ux-ce.alwaysdata.net dbname=pi-ux-ce_pains user=pi-ux-ce_mini_root password=Exiamiam");

		if (!$conn_pains) {
  			echo "Une erreur s'est produite.\n";
  			exit;
		}
		//end of connection


		$user = $_POST['user'];
		$age = $_POST['age'];
		$password = $_POST['password'];

		//test if the password is good
		$result = pg_query($conn_pains, "select count(*) from users where username='pi-ux-ce_pains' and password='$password';");
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


		$result = pg_query($conn_pains, "SELECT * FROM client");
		while ($row = pg_fetch_row($result)) {
 			echo "Prenom: $row[1]"; 
			echo str_repeat('&nbsp;', 10);
			echo "Nom: $row[2] ";
			echo str_repeat('&nbsp;', 10);
			echo "Numero: $row[3]"; 
			echo str_repeat('&nbsp;', 10);
			echo "Mail: $row[4] ";
			echo str_repeat('&nbsp;', 10);
			echo "Date: $row[5] ";
			echo str_repeat('&nbsp;', 10);
			echo "Salle:$row[6] ";
			echo str_repeat('&nbsp;', 10);
			echo "Derangeable: $row[7] ";
			echo str_repeat('&nbsp;', 10);
			echo "Nbr petits pains: $row[8]"; 
			echo str_repeat('&nbsp;', 10);
			echo "Nbr croissant: $row[9]";
			echo "<br />\n";
			echo "<br />\n";
		}
		echo $age;

	?>
	</fieldset>
	</p>

</form>


