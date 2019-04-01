<center>
<h2> Ajout d'objet </h2>
<br>
<form method="post" action="">
<table border =0>
<tr> <td> Designation : </td>
	 <td> <input type="text" name="designation"> </td> </tr>
<tr> <td> Etat : </td>
	 <td> <input type="text" name="etat"> </td> </tr>
<tr> <td> Prix : </td>
	 <td> <input type="text" name="prixachat"> </td> </tr>
<tr> <td> marque : </td>
	 <td> <input type="text" name="marque"> </td> </tr>
	 <tr> <td> categorie </td>
	 <td> <input type="text" name="idcategorie"> </td> </tr>
<tr> <td> <input type="reset" name="Annuler" values="Annuler">
	 </td>
	 <td> <input type="submit" name="valider" value="valider">
	 </td> </tr>
</table>
</form>
<?php
	$connexion = mysqli_connect("localhost","root","","troc");
	
	if (! $connexion)
	{
		echo "<br/> ERREUR de connection à la base de données";
	}
	else
	{
		if (isset($_POST['valider']))
		{
			$designation=$_POST['designation'];
			$etat=$_POST['etat'];
			$prixachat=$_POST['prixachat'];
			$marque=$_POST['marque'];
			$idcategorie=$_POST['idcategorie'];
			
			$requete="insert into objet (idobjet, designation, etat, prixachat, marque, idcategorie, idenfant) values (null, '".$designation."', '".$etat."', "
			.$prixachat.", '".$marque."', ".$_SESSION['idenfant'].", ".$idcategorie.");";
			echo $requete; 
			mysqli_query($connexion, $requete);
		}
		$requete = "select*from objet;";
		
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
		echo "</table>";
		mysqli_close($connexion);
	}
	?>

<a href="index.php"> Retour vers l'acceuil</a>
</center>
