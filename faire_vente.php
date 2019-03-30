<center>
<h2> Ajout d'objet </h2>
<br>
<form method="post" action="">
<table border =0>
<tr> <td> date de la vente : </td>
	 <td> <input type="text" name="datevente"> </td> </tr>
<tr> <td> Prix : </td>
	 <td> <input type="text" name="prixvente"> </td> </tr>
<tr> <td> lieu de livraison : </td>
	 <td> <input type="text" name="lieulivraison"> </td> </tr>
<tr> <td> payement </td>
	 <td> <input type="text" name="payement"> </td> </tr>
<tr> <td> commentaire </td>
<td> <input type="text" name="commentaire"> </td> </tr>
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
			$datevente=$_POST['datevente'];
			$prixvente=$_POST['prixvente'];
			$lieulivraison=$_POST['lieulivraison'];
			$payement=$_POST['payement'];
			$commentaire=$_POST['commentaire'];
			$idobjet=$_POST['idobjet'];
			
			$requete="insert into vente (idvente, datevente, prixvente, lieulivraison, payement, commentaire, idobjet, idenfant)
			values (null, '".$datevente."', ".$prixvente.", '"
			.$lieulivraison."', '".$payement."', '".$commentaire."', ".$idobjet.",".$_SESSION['idenfant'].");";
			echo $requete; 
			mysqli_query($connexion, $requete);
		}
		$requete = "select*from vente;";
		
		$resultats = mysqli_query($connexion, $requete);
		echo "<table border =1>
		<tr> <td> Id vente </td>
			 <td> date vente </td>
			 <td> prix de la vente </td> 
			 <td> lieu livraison</td>
			 <td> payement </td>
			 <td> commentaire </td>
			 <td> identifiant objet </td>
			 <td> identifiant enfant </tr>";
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			echo "<tr> <td>".$ligne["idvente"]."</td>
						<td>".$ligne["datevente"]."</td>
						<td>".$ligne["prixvente"]."</td>
						<td>".$ligne["lieulivraison"]."</td>
						<td>".$ligne["payement"]."</td>
						<td>".$ligne["commentaire"]."</td>
						<td>".$ligne["idobjet"]."</td>
						<td>".$ligne["idenfant"]."</td></tr>";
		}
		echo "</table>";
		mysqli_close($connexion);
	}
	?>

<a href="index.php"> Retour vers l'acceuil</a>
</center>