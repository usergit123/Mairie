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
	IDP : <input type ="text" name="idP"> </br> 
	MDP : <input type ="password" name="mdp"> </br> 
	<input type ="reset" name ="Annuler" value ="Annuler">
	<input type ="submit" name ="SeConnecter" value ="Se Connecter"><br/>
	</form>
	<a href="inscription.php"> cliquez ici pour vous inscrire </a>
	<?php
		if (isset($_POST['SeConnecter']))
		{
			$idP = $_POST['idP'];
			$mdp = $_POST['mdp'];
			$resultat = verif_connexion ($idP, $mdp);
			//var_dump($resultat);
			if($resultat==null)
			{
				echo"<br/> veuillez vérifier vos identifiants ";
			}else{
				echo "<br/> Bienvenue ".$resultat["nom"]."  ".$resultat["prenom"];				
				$_SESSION['nom']=$resultat['nom'];
				$_SESSION['idP']=$resultat['idP'];
			}
		}
		if (isset($_SESSION['nom']))
		{
						echo "</center>
					<br/> <a href='index.php?page=1'> loisir </a>";
				echo "<br/> <a href='index.php?page=2'> Voir les loisirs </a>";
				 echo "<br/> <a href='index.php?page=3'> voir evenement </a>";
                echo "<br/> <a href='index.php?page=4'> Voir les objets en vente </a>";
                echo "<br/> <a href='index.php?page=5'> Voir les objets en don </a>";
                echo "<br/> <a href='index.php?page=6'> Voir les objets en échange </a>";
                echo "<br/> <a href='index.php?page=7'> Faire une vente d'objet </a>";
                echo "<br/> <a href='index.php?page=8'> Faire un don d'objet</a>";
                echo "<br/> <a href='index.php?page=9'> Faire un échange d'objet </a>";
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
						echo "<tr> <td>".$uneLigne['Ville']."</td>
						<td>".$uneLigne['Codepostal']."</td></tr>"
						.$uneLigne['Ville']."</td><tr>";
					}
					break;
						
					case 2:
					
					$lesLignes = afficher_evenement();
					//var_dump($lesLignes);
					echo "
					<table border=1>
					<tr><td>Lieu </td> <td>Libelle</td>
					";
					//parcourir les lignes et les afficher dans la table
					foreach ($lesLignes as $uneLigne)
					{
						echo "<tr> <td>".$uneLigne['Lieu']."</td>
						<td>".$uneLigne['Libelle']."</td></tr>";
					}
					break;
					
						
					CASE 4:
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
					
					case 10: session_destroy();
				}
		}
	?>
	
	</center>
	</body>
	</html>
	
