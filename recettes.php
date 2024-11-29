<?php

try
{
	$mysqlClient = new PDO('mysql:host=localhost;dbname=recettes;charset=utf8', 'root', '',
	[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],	
	);												
												
}
		
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
		

/*
Requêtes SQL avec PDO
PDO supporte deux méthodes principales pour exécuter des requêtes :

- query : pour exécuter des requêtes simples (lecture uniquement).
- prepare et execute : pour des requêtes sécurisées avec des paramètres.
*/


// On récupère tout le contenu nécessaire dans les tables pour la page

$sqlQuery = "
SELECT                    
	*,
    category.category_name AS Catégorie,                     
    recipe.recipe_name AS Recette,                           
    recipe.preparation_time AS Temps_De_Préparation          

FROM                                                         
    category                                                

INNER JOIN                                                  
    recipe                                                  

ON                                                          
    recipe.id_category = category.id_category               

ORDER BY preparation_time  
"; 

$recipesStatement = $mysqlClient->prepare($sqlQuery); 	// prend le contenu nécessaire dans les tables


// Pour récupérer les données, on demande à cet objet d'exécuter la requête SQL et de récupérer toutes les données dans un format "exploitable"
// pour nous sous la forme d'un tableau PHP.

// récupération des résultats
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();
	

?>


<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/recettes.css">
	<title>Recettes</title>
</head>
<body>
	


<table class="demo">
	<thead>
	<tr>
		<th>Recette</th>
		<th>Catégorie</th>
		<th>Temps de Préparation</th>
	</tr>
	</thead>
	<tbody>
		<?php
			// affichage des données : chaque recette avec ses infos

			foreach ($recipes as $recipe) {

				
				$id_link_recipe = $recipe['id_recipe'];
				
				echo "<tr><td><a href='detailRecette.php?id=$id_link_recipe'>".$recipe['Recette']."</a></td>"; 			// affiche le nom de la recette 

				echo "<td>".$recipe['Catégorie']."</td>"; 														// affiche le nom de la catégorie  

				echo "<td>".$recipe['Temps_De_Préparation']." minutes </td></tr>";										// affiche le temps de préparation 

			}

		?>
	</tbody>
</table>


</body>
</html>


<!--

Une première page recettes.php : 

- elle listera tous les recettes de la BDD dans un tableau HTML avec 3 colonnes : nom de la recette,
																			      nom de la catégorie,
																				  temps de préparation.    	FAIT

- On aura un lien < a > sur le nom de la recette qui mènera vers la 2e page.							   	FAIT

- Stylisation.																								NON COMMENCÉE

-->
