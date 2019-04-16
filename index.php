<?php

	session_start(); //demarrage d'une session

	require_once ("fonctions.php"); 

?>

<html>

<head>

<title> Site de la Mairie </title>

<meta charset ="utf-8">; 

<meta name ="viewport" content="width=device-width,initial-scale=1.0"/>


<link rel="stylesheet" type="text/css" href="./css/style.css">

</head>


<body>
	
	<img src="img/mairie.jpg"width="100%"height="100%">

<center>

	<h1> SITE DE LA MAIRIE </h1>

	<form method ="post" action ="">

	Pseudo : <input type ="text" name="pseudo"> </br> 

	MDP : <input type ="password" name="mdp"> </br> 

	<input type ="reset" name ="Annuler" value ="Annuler">

	<input type ="submit" name ="SeConnecter" value ="Se Connecter"><br/>

	</form>

	<a href="inscription.php"> cliquez ici pour vous inscrire </a>

	<?php

		if (isset($_POST['SeConnecter']))

		{

			$pseudo = $_POST['pseudo'];

			$mdp = $_POST['mdp'];

			$resultat = verif_connexion ($pseudo, $mdp);

			//var_dump($resultat);

			if($resultat==null)

			{

				echo"<br/> veuillez vérifier vos identifiants ";

			}else{

				echo "<br/> Bienvenue ".$resultat["nom"]." , ".$resultat["prenom"]."";			

				$_SESSION['nom']=$resultat['nom'];

				$_SESSION['prenom']=$resultat['prenom'];

				$_SESSION['idP']=$resultat['idP'];





			}

		}

		if (isset($_SESSION['IdP']))

		{

			 echo "</center>

			 <br/> <a href='index.php?page=1'> Cantines </a>";

			 echo "<br/> <a href='index.php?page=2'> Voir les loisirs </a>";

			 echo "<br/> <a href='index.php?page=3'> Voir les événements </a>";

			 echo "<br/> <a href='index.php?page=4'> Voir les associations </a>";

			 echo "<br/> <a href='index.php?page=5'> Voir les mariages </a>";

			 echo "<br/> <a href='index.php?page=6'> Voir les actes </a>";

			echo "<br/> <a href='index.php?page=7'> Voir les enfants </a>";

               		 echo "<br/> <a href='index.php?page=10'> Se Déconnecter </a>";

				

				if (isset($_GET['page']))

				{

					$page=$_GET['page'];

				}else{

					$page=0;

				}

				switch ($page)

				{

					case 1 :

					$lesLignes = afficher_cantine();

					//var_dump($lesLignes);

					echo "

					<table border=1>

					<tr><td>Ville </td> <td>Code postal</td>

					<td> Prix</td> </tr>

					";

					//parcourir les lignes et les afficher dans la table

					foreach ($lesLignes as $uneLigne)

					{

						echo "<tr> <td>".$uneLigne['ville']."</td>

						<td>".$uneLigne['codepostal']."</td></tr>"

						.$uneLigne['prix']."</td><tr>";

					}

					break;

					



					case 2:

					$lesLignes = afficher_loisir();

					//var_dump($lesLignes);

					echo "

					<table border=1>

					<tr><td>Id Loisir </td> <td>Libelle</td>

					<td> Lieu</td> </tr>

					";

					//parcourir les lignes et les afficher dans la table

					foreach ($lesLignes as $uneLigne)

					{

						echo "<tr> <td>".$uneLigne['idL']."</td>

						<td>".$uneLigne['libelle']."</td>

						<td>".$uneLigne['lieu']."</td></tr>";

					}

					break;



					case 3:

					$lesLignes = afficher_evenement();

					//var_dump($lesLignes);

					echo "

					<table border=1>

					<tr><td>Lieu </td> <td>Libelle</td>

					";

					//parcourir les lignes et les afficher dans la table

					foreach ($lesLignes as $uneLigne)

					{

						echo "<tr> <td>".$uneLigne['lieu']."</td>

						<td>".$uneLigne['Libelle']."</td></tr>";

					}

					break;



					case 4:

					$lesLignes = afficher_association();

					echo " <table border=1>

					<tr><td> libelleA </td>

					 <td> adresse </td> 

					 <td> tel </td>

					 <td> codeP </td> ";

					foreach ($lesLignes as $uneLigne)

					{

						echo "<tr> <td>".$uneLigne['libelleA']." </td>

						<td> ".$uneLigne['adresse']." </td>

						<td>".$uneLigne['tel']." </td>

						<td>".$uneLigne['codeP']." </td>

						</tr>";

					}

					break;

					case 5:

					$lesLignes = afficher_mariage();

					echo " <table border=1>

					<tr><td> nom 1er marié(é) </td>

					 <td> prenom 1er marié(é)</td>

					 <td> nom 2ème marié(é) </td>

					 <td> prenom 2ème marié(é) </td> ";

					foreach ($lesLignes as $uneLigne)

					{

						echo "<tr> <td>".$uneLigne['a']." </td>

						<td> ".$uneLigne['b']." </td>

						<td>".$uneLigne['c']." </td>

						<td>".$uneLigne['d']." </td>

						</tr>";

					}

					break;

					case 6:

					$lesLignes = afficher_acte($_SESSION['idP']);

					echo " <table border=1>

					<tr><td> id acte </td>

					 <td> id personne </td>

					 <td> date de mariage </td>

					 <td> date de naissance </td>

					 <td> date de décès </td>";

					foreach ($lesLignes as $uneLigne)

					{

						echo "<tr> <td>".$uneLigne['idF']." </td>

						<td> ".$uneLigne['idP']." </td>

						<td>".$uneLigne['mariage']." </td>

						<td>".$uneLigne['naissance']." </td>

						<td>".$uneLigne['deces']." </td>

						</tr>";

					}

					break;

					case 7:

					$lesLignes = afficher_enfants($_SESSION['idP']);

					echo " <table border=1>

					<tr><td> id enfant </td>

					 <td> id parent </td>

					 <td> id cantine </td>

					 <td> Nom </td>

					 <td> Prénom </td>

					 <td> Sexe </td>";

					foreach ($lesLignes as $uneLigne)

					{

						echo "<tr> <td>".$uneLigne['idE']." </td>

						<td> ".$uneLigne['idP']." </td>

						<td>".$uneLigne['idC']." </td>

						<td>".$uneLigne['nomE']." </td>

						<td>".$uneLigne['prenomE']." </td>

						<td>".$uneLigne['sexe']." </td>

						</tr>";

					}

					break;

					case 10: session_destroy();

				}

		}

	?>

	

	</center>

	</body>

	</html>
