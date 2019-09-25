<center>
<h2> Inscription evenement </h2>
<br>
<form method="post" action="">
<table border =0>
<tr> <td> idEV : </td>
	 <td> <input type="text" name="idEV"> </td> </tr>

<tr> <td> <input type="reset" name="Annuler" values="Annuler">
	 </td>
	 <td> <input type="submit" name="valider" value="valider">
	 </td> </tr>
</table>
</form>
<?php
	session_start();
	$connexion = mysqli_connect("localhost","root","","mairie");
	
	if (! $connexion)
	{
		echo "<br/> ERREUR de connection à la base de données";
	}
	else
	{
		if (isset($_POST['valider']))
		{
			
			
			$idEV=$_POST['idEV'];
			
			
			$requete="insert into assister (idP, idEV) values (".$_SESSION['idP'].", ".$idEV.");";
			echo $requete; 
			mysqli_query($connexion, $requete);
		}
		/*$requete = "select*from enfant;";
		
		$resultats = mysqli_query($connexion, $requete);
		echo "<table border =1>
		<tr> <td> Id objet </td>
			 <td> designation </td>
			 <td> etat de l'objet </td> 
			 <td> prix </td>
			 <td> categorie </td>
			 <td> marque </tr>";
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			echo "<tr> <td>".$ligne["idobjet"]."</td>
						<td>".$ligne["designation"]."</td>
						<td>".$ligne["etat"]."</td>
						<td>".$ligne["prixachat"]."</td>
						<td>".$ligne["idcategorie"]."</td>
						<td>".$ligne["marque"]."</td></tr>";
		}
		echo "</table>";*/
		mysqli_close($connexion);
	}
	?>
	

</form>

<a href="index.php"> Retour vers l'acceuil</a>
</center>