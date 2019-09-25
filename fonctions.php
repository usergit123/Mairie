<?php
	
function connexion ()
	{
			$con = mysqli_connect("localhost","root","","mairie"); 
			if ($con == null)
			{
				echo "Erreur de connexion au serveur localhost";
				return null;
			}
			else{
				mysqli_set_charset($con, "utf8");
				return $con;
			}
	}
function deconnexion ($con)
	{
		if ($con != null ) { mysqli_close($con); }
	}
function verif_connexion ($pseudo, $mdp)
	{
		$requete = "select * from personne where pseudo='".$pseudo."' and mdp ='".$mdp."';"; 
		$con = connexion (); 
		if ($con==null) {
			return null; 
		}else {
			$resultat = mysqli_query($con, $requete);
			$ligne = mysqli_fetch_assoc($resultat);
			return $ligne; 
		}
		deconnexion($con);
	}
function verif_connexion_admin ($pseudo, $mdp)
	{
		$requete = "select * from admin where pseudo='".$pseudo."' and mdp ='".$mdp."';"; 
		$con = connexion (); 
		if ($con==null) {
			return null; 
		}else {
			$resultat = mysqli_query($con, $requete);
			$ligne = mysqli_fetch_assoc($resultat);
			return $ligne; 
		}
		deconnexion($con);
	}
function afficher_loisir()
{
	$requete="select l.idL, l.libelle, l.lieu from loisir l;";
		$con = connexion ();
		if($con == null)
		{
			return null;
		}
		else{
			//execution de la requete et recuperer les tuples
			$resultats=mysqli_query($con, $requete);
			//declaration d'un tableau vide
			$lesLignes = array();
			//parcours des resultats et leur insertion dans le tableau lesLignes
			while ($ligne = mysqli_fetch_assoc($resultats))
			{
				$lesLignes[]=$ligne;
			}
			//retourner le tableau lesLignes
			return $lesLignes;
		}
}
function afficher_Cantine()
{
	$requete="Select ville, codepostal, prix from cantine;";
		$con = connexion();
		if($con == null )
		{
			return null;
		}
		else{
			$resultats=mysqli_query($con, $requete);
			$lesLignes =array();
			while ($ligne = mysqli_fetch_assoc($resultats))
			{
				$lesLignes[]=$ligne;
			}
			return $lesLignes;
		}
}
function afficher_Evenement()
{
	$requete="Select libelle, lieu from evenement;";
	$con =connexion();
	if($con == null)
		{ 
			return null;
		}
	else
	{
		$resultats=mysqli_query($con, $requete);
		$lesLignes = array();
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			$lesLignes[]=$ligne;
		}
		return $lesLignes;
	}
}
function afficher_association ()
{
	$requete="Select libelleA, tel, adresse, codeP from association;";
	$con=connexion();
	if($con==null)
	{
		return null;
	}
	else
	{
		$resultats=mysqli_query($con, $requete);
		$lesLignes = array();
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			$lesLignes[]=$ligne;
		}
		return $lesLignes;
	}
}
function afficher_mariage($idPer)
{
	$requete="select p1.nom a,p1.prenom b,p2.nom c,p2.prenom d
    from personne p1, personne p2, mariage m
    where p1.idP=m.idP1 and p2.idP=m.idP2    and   idPer=".$_SESSION['idP']." and (idPer=p1.idP or idPer=p2.idP);";
	$con=connexion();
	if($con==null)
	{
		return null;
	}
	else
	{
		$resultats=mysqli_query($con, $requete);
		$lesLignes = array();
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			$lesLignes[]=$ligne;
		}
		return $lesLignes;
	}
}
function afficher_mariage_admin ()
{
	$requete="select p1.nom a,p1.prenom b,p2.nom c,p2.prenom d
    from personne p1, personne p2, mariage m
    where p1.idP=m.idP1 and p2.idP=m.idP2;";
	$con=connexion();
	if($con==null)
	{
		return null;
	}
	else
	{
		$resultats=mysqli_query($con, $requete);
		$lesLignes = array();
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			$lesLignes[]=$ligne;
		}
		return $lesLignes;
	}
}
function afficher_acte ($idP)
{
	$requete="select*from actes where idP=".$_SESSION['idP'].";";
	$con=connexion();
	if($con==null)
	{
		return null;
	}
	else
	{
		$resultats=mysqli_query($con, $requete);
		$lesLignes = array();
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			$lesLignes[]=$ligne;
		}
		return $lesLignes;
	}
}
function afficher_acte_admin ()
{
	$requete="select*from actes;";
	$con=connexion();
	if($con==null)
	{
		return null;
	}
	else
	{
		$resultats=mysqli_query($con, $requete);
		$lesLignes = array();
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			$lesLignes[]=$ligne;
		}
		return $lesLignes;
	}
}
function afficher_enfants ($idP)
{
	$requete="select*from enfants where idP=".$_SESSION['idP'].";";
	$con=connexion();
	if($con==null)
	{
		return null;
	}
	else
	{
		$resultats=mysqli_query($con, $requete);
		$lesLignes = array();
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			$lesLignes[]=$ligne;
		}
		return $lesLignes;
	}
}
function afficher_enfants_admin ()
{
	$requete="select*from enfants;";
	$con=connexion();
	if($con==null)
	{
		return null;
	}
	else
	{
		$resultats=mysqli_query($con, $requete);
		$lesLignes = array();
		while ($ligne = mysqli_fetch_assoc($resultats))
		{
			$lesLignes[]=$ligne;
		}
		return $lesLignes;
	}
}
?>
