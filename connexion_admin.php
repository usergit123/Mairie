<?php
	session_start(); //demarrage d'une session
	require_once ("fonctions.php"); 
?>
<html>
<head>
<title> Site de la Mairie </title>
<meta charset ="utf-8">
<meta name ="viewport" content="width=device-width,initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<?php 
if (isset($_POST['supprimer'])) 
{ 
header('Location: connexion_admin.php'); 
} ?>
</head>
<body>
<img src="img/mairie.jpg"width="100%"height="100%">
<center>
	<h1> SITE DE LA MAIRIE </h1>
	<form method ="post" action ="">
	Pseudo : <input type ="text" name="pseudo"> </br> 
	MDP : <input type ="password" name="mdp"> </br> 
	<input type ="reset" name ="Annuler" value ="Annuler">
	<input type ="submit" name ="SeConnecter" value ="SeConnecter"><br/>
	</form>
	<?php
		if (isset($_POST['SeConnecter']))
		{
			$pseudo = $_POST['pseudo'];
			$mdp = $_POST['mdp'];
			$resultat = verif_connexion_admin($pseudo, $mdp);
			//var_dump($resultat);
			if($resultat==null)
			{
				echo"<br/> veuillez vérifier vos identifiants ";
			}else{
				echo "<br/> Bienvenue ".$resultat["pseudo"];			
				$_SESSION['numA']=$resultat['numA'];
				$int='prenom';
				echo strlen((string)$int); 
				
			}
		}
		if (isset($_SESSION['numA']))
		{
			 echo "</center>
			 <br/> <a href='connexion_admin.php?page=1'> Cantines </a>";
			 echo "<br/> <a href='connexion_admin.php?page=2'> voir les loisirs </a>";
			 echo "<br/> <a href='connexion_admin.php?page=3'> Voir evenement </a>";
			 echo "<br/> <a href='connexion_admin.php?page=4'> Voir association </a>";
			 echo "<br/> <a href='connexion_admin.php?page=5'> Voir les mariages </a>";
			 echo "<br/> <a href='connexion_admin.php?page=6'> Voir les actes </a>";
			 echo "<br/> <a href='connexion_admin.php?page=7'> Voir les enfants </a>";
             echo "<br/> <a href='connexion_admin.php?page=10'> Se Déconnecter </a>";
				
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
						<td>".$uneLigne['codepostal']."</td>
						<td>".$uneLigne['prix']."</td><tr>";
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
					echo "</table>";
					?>
					<h1> ajouter un loisir </h1>
					<form method ="post" action ="">
					<tr>Nom du loisir : <input type='text' name='libelle'> </tr>
					<tr>Lieu du loisir: <input type='text' name='lieu'> </tr>
					<input type ="reset" name ="Annuler" value ="Annuler">
					<input type ="submit" name ="ajouter" value ="ajouter"><br/>
					</form>
					<?php
					if(isset($_POST['ajouter']))
					{
						
						 $libelle=$_POST['libelle'];
						 $lieu=$_POST['lieu'];
						 
						 $requete="insert into loisir values (null,'".$libelle."','".$lieu."');";
						 echo $requete;
						 mysqli_query(connexion(),$requete);
					} ?>
					
					<h1> Supprimer un loisir </h1>
					<form method ="post" action ="">
					Loisir à supprimer : 
					<td><SELECT name="idL" size="1">
					<?php
					$connexion = mysqli_connect("localhost","root","","mairie");
					$requete="select * from loisir;";
					$resultats=mysqli_query($connexion,$requete);
					while ($ligne = mysqli_fetch_assoc($resultats))
							{
								echo"<option value ='".$ligne["idL"]."'>".$ligne["libelle"]."</option>";
							}	 

						 ?>
						 </SELECT></td>
					<input type ="reset" name ="Annuler" value ="Annuler">
					<input type ="submit" name ="supprimer" value ="supprimer"><br/>
					</form>
					<?php
					if(isset($_POST['supprimer']))
					{
						 $idL=$_POST['idL'];
						 
						 $requete="delete from loisir where idL=".$idL.";";
						 mysqli_query(connexion(),$requete);
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
						<td>".$uneLigne['libelle']."</td></tr>";
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
					}break;
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
	