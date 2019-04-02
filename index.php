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
	Nom : <input type ="text" name="nom"> </br> 
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
				echo "<br/> Bienvenue ".$resultat["nom"]."  ".$resultat["prenom"];				
				$_SESSION['pseudo']=$resultat['nom'];
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
					case 1:
					//appel de la fonction select*from objets
					$lesLignes = selectALLObjets ();
					//var_dump($lesLignes);
					echo "
					<table border=1>
					<tr><td>Id Objet </td> <td>Désignation</td>
					<td> Etat</td> <td> Prix d'achat </td>
					<td>Date achat </td> <td>Marque</td>
					<td> Tranche Age </td> <td> Image </td> </tr>
					";
					//parcourir les lignes et les afficher dans la table
					foreach ($lesLignes as $uneLigne)
					{
						echo "<tr> <td>".$uneLigne['idobjet']."</td>
						<td>".$uneLigne['designation']."</td>
						<td>".$uneLigne['etat']."</td>
						<td>".$uneLigne['prixachat']."</td>
						<td>".$uneLigne['dateachat']."</td>
						<td>".$uneLigne['marque']."</td>
						<td>".$uneLigne['trancheage']."</td>
						<td>".$uneLigne['image']."</td></tr>";
					}
					echo "</table>";
					break;
					case 2:
					$mesObjets = selectALLObjetsEnfant($_SESSION['idenfant']);
					//afficher les resultats
					echo "
					<table border=1>
					<tr><td>Id Objet </td> <td>Désignation</td>
					<td> Etat</td> <td> Prix d'achat </td>
					<td>Date achat </td> <td>Marque</td>
					<td> Tranche Age </td> <td> Image </td> </tr>
					";
					//parcourir les lignes et les afficher dans la table
					foreach ($mesObjets as $uneLigne)
					{
						echo "<tr> <td>".$uneLigne['idobjet']."</td>
						<td>".$uneLigne['designation']."</td>
						<td>".$uneLigne['etat']."</td>
						<td>".$uneLigne['prixachat']."</td>
						<td>".$uneLigne['dateachat']."</td>
						<td>".$uneLigne['marque']."</td>
						<td>".$uneLigne['trancheage']."</td>
						<td>".$uneLigne['image']."</td></tr>";
					}
					echo "</table>";
					break;
					case 3: require_once ("ajoutObjet.php");break;
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
					case 5 : 
					//appel de la fonction select*from objets
					$lesLignes = objet_don ();
					//var_dump($lesLignes);
					echo "
					<table border=1>
					<tr><td>Id Objet </td> <td>Désignation</td>
					<td> Etat</td> <td> Prix d'achat </td>
					<td>Date achat </td> <td>Marque</td>
					<td> Tranche Age </td> <td> Image </td> </tr>
					";
					//parcourir les lignes et les afficher dans la table
					foreach ($lesLignes as $uneLigne)
					{
						echo "<tr> <td>".$uneLigne['idobjet']."</td>
						<td>".$uneLigne['designation']."</td>
						<td>".$uneLigne['etat']."</td>
						<td>".$uneLigne['prixachat']."</td>
						<td>".$uneLigne['dateachat']."</td>
						<td>".$uneLigne['marque']."</td>
						<td>".$uneLigne['trancheage']."</td>
						<td>".$uneLigne['image']."</td></tr>";
					}
					break;
					case 6 : 
					//appel de la fonction select*from objets
					$lesLignes = objet_echange ();
					//var_dump($lesLignes);
					echo "
					<table border=1>
					<tr><td>Id Objet </td> <td>Désignation</td>
					<td> Etat</td> <td> Prix d'achat </td>
					<td>Date achat </td> <td>Marque</td>
					<td> Tranche Age </td> <td> Image </td> </tr>
					";
					//parcourir les lignes et les afficher dans la table
					foreach ($lesLignes as $uneLigne)
					{
						echo "<tr> <td>".$uneLigne['idobjet']."</td>
						<td>".$uneLigne['designation']."</td>
						<td>".$uneLigne['etat']."</td>
						<td>".$uneLigne['prixachat']."</td>
						<td>".$uneLigne['dateachat']."</td>
						<td>".$uneLigne['marque']."</td>
						<td>".$uneLigne['trancheage']."</td>
						<td>".$uneLigne['image']."</td></tr>";
					}
					break;
					case 7 : require_once ("faire_vente.php");break;
					case 8 : require_once ("faire_don.php");break;
					case 9 : require_once ("faire_echange.php");break;
					case 10: session_destroy();
				}
		}
	?>
	
	</center>
	</body>
	</html>
	
