<?php
	session_start(); //demarrage d'une session
	require_once ("fonctions.php"); 
?>
<html>
<head>
<title> Site de la Mairie </title>
<meta charset ="utf-8">
</head>
<body>
<center>
	<h1> SITE DE LA MAIRIE </h1>
	<form method ="post" action ="">
	Pseudo : <input type ="text" name="nom"> </br> 
	MDP : <input type ="password" name="mdp"> </br> 
	<input type ="reset" name ="Annuler" value ="Annuler">
	<input type ="submit" name ="SeConnecter" value ="Se Connecter"><br/>
	</form>
	<a href="inscription.php"> cliquez ici pour vous inscrire </a>
	<?php
		if (isset($_POST['SeConnecter']))
		{
			$nom = $_POST['nom'];
			$mdp = $_POST['mdp'];
			$resultat = verif_connexion ($nom, $mdp);
			//var_dump($resultat);
			if($resultat==null)
			{
				echo"<br/> veuillez vérifier vos identifiants ";
			}else{
				echo "<br/> Bienvenue ".$resultat["nom"]." , ".$resultat["prenom"]."";			
				$_SESSION['nom']=$resultat['nom'];
				$_SESSION['prenom']=$resultat['prenom'];
				$_SESSION['Idp']=$resultat['Idp'];


			}
		}
		if (isset($_SESSION['Idp']))
		{
						echo "</center>
					<br/> <a href='index.php?page=1'> Cantines </a>";
				echo "<br/> <a href='index.php?page=2'> Voir les loisirs </a>";
				 echo "<br/> <a href='index.php?page=3'> Voir evenement </a>";
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
					

					case 4:
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
						echo "<tr> <td>".$uneLigne['libelle']."</td>
						<td>".$uneLigne['lieuL']."</td></tr>";
					}
					break;

					case 5:
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

					case 6:
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
						".$uneLigne['tel']." </td>
						".$uneLigne['codeP']." </td>
						<td>";
					}
					break;

					case 10: session_destroy();
				}
		}
	?>
	
	</center>
	</body>
	</html>
	
