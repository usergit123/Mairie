<center>
<h2> Ajout d'objets </h2>
<br>
<form method="post" action="">
<table border =0>
<tr> <td> date du don : </td>
	 <td> <input type="text" name="datede"> </td> </tr>
<tr> <td> commentaire : </td>
	 <td> <input type="text" name="commentaire"> </td> </tr>
<tr> <td> lieu de livraison : </td>
	 <td> <input type="text" name="lieulivraison"> </td> </tr>
<tr> <td> identifiant de l'objet </td>
	<td> <input type="text" name="idobjet"> </td> </tr>
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
			$datede=$_POST['datede'];
			$commentaire=$_POST['commentaire'];
			$lieulivraison=$_POST['lieulivraison'];
			$idobjet=$_POST['idobjet'];
			
			$requete="insert into donEchange (idde, datede, commentaire, lieulivraison, typeoperation, idobjet, idenfant)
			values (null, '".$datede."', '".$commentaire."', '"
			.$lieulivraison."', 'don', ".$idobjet.",".$_SESSION['idenfant'].");";
			echo $requete; 
			mysqli_query($connexion, $requete);
		}
		$requete = "select*from donEchange where typeoperation='don';";
		
		$resultats = mysqli_query($connexion, $requete);
		echo "<table border =1>
		<tr> <td> Id don </td>
			 <td> date don </td>
			 <td> commentaire </td> 
			 <td> lieu livraison</td>
			 <td> type d'operation </td>
			 <td> identifiant objet </td>
			 <td> idenfant enfant </tr>";
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			echo "<tr> <td>".$ligne["idde"]."</td>
						<td>".$ligne["datede"]."</td>
						<td>".$ligne["commentaire"]."</td>
						<td>".$ligne["lieulivraison"]."</td>
						<td>".$ligne["typeoperation"]."</td>
						<td>".$ligne["idobjet"]."</td>
						<td>".$ligne["idenfant"]."</td></tr>";
		}
		echo "</table>";
		mysqli_close($connexion);
	}
	?>

<a href="index.php"> Retour vers l'acceuil</a>
</center>
