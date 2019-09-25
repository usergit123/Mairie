<?php
session_start();
?>
<center>
<h2> s'incrire à une activité </h2>
<br>
<form method="post" action="">
<table border =0.2>
<tr> <td> Choix du loisir : </td>
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
	 
<tr> <td> <input type="reset" name="Annuler" values="Annuler">
	 </td>
	 <td> <input type="submit" name="valider" value="valider">
	 </td> </tr>
</table>
</form> 
<?php

	$connexion = mysqli_connect("localhost","root","","mairie");
	
	if (! $connexion)
	{
		echo "<br/> ERREUR de connection à la base de données";
	}
	else
	{
		if (isset($_POST['valider']))
		{
			
			$idL=$_POST['idL'];
			echo $idL;
		
			$requete="insert into participer (idL, idP, datePL)
			values ('".$idL."', '".$_SESSION['idP']."', curdate());";
			echo $requete; 
			mysqli_query($connexion, $requete);

			$requete = "select*from participer;";
		
			$resultats = mysqli_query($connexion, $requete);
			echo "<table border =1>
			<tr> <td> IdL </td>
			 <td> idP </td>
			 <td> datePL </td> 
			  </tr>";
			while ($ligne = mysqli_fetch_assoc($resultats))
			{
				echo "<tr> <td>".$ligne["idL"]."</td>
							<td>".$ligne["idP"]."</td>
							<td>".$ligne["datePL"]."</td>
							</tr>";
			}
			echo "</table>";
			mysqli_close($connexion);
		}	
	}
	?>

<a href="index.php"> Retour vers l'acceuil</a>
</center>