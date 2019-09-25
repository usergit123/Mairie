<center>
<h2> Ajout d'enfant </h2>
<br>
<form method="post" action="">
<table border =0>
<tr> <td> idC : </td>
	 <td> <input type="text" name="idC"> </td> </tr>
<tr> <td> nomE : </td>
	 <td> <input type="text" name="nomE"> </td> </tr>
<tr> <td> prenomE </td>
	 <td> <input type="text" name="prenomE"> </td> </tr>
<td><label for="sexe"><strong> Sexe :</strong></label></td>
            <td><input type="radio" name="sexe" value="fille" > fille</td>
            <td><input type="radio" name="sexe" value="garcon" > garçon</td>
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
			
			
			$idC=$_POST['idC'];
			$nomE=$_POST['nomE'];
			$prenomE=$_POST['prenomE'];
			$sexe=$_POST['sexe'];
			
			$requete="insert into enfants (idE, idP, idC, nomE, prenomE, sexe) values (null, ".$_SESSION['idP'].", ".$idC.",'"
			.$nomE."', '".$prenomE."', '".$sexe."');";
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
<a href="facture.pdf">Facture (PDF)</a>
<a href="index.php"> Retour vers l'acceuil</a>
</center>