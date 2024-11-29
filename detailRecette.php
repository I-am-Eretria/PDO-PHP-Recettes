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
		






?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/detailRecette.css">
	<title>Détails Recette</title>
</head>
<body>
	




</body>
</html>

<!--

Une deuxième page detailRecette.php :

- on affichera le détail d'une recette avec les infos: nom, 
													   catégorie,
													   temps de préparation. 	

													   + liste des ingrédients de cette recette.	EN COURS

- revenir page 1 et lier avec recette respective													NON COMMENCÉE

- STYLISATION													   									NON COMMENCÉE


SELECT                                                       
    category.category_name AS Catégorie,                     
    recipe.recipe_name AS Recette,                           
    recipe.preparation_time AS Temps_De_Préparation

	ingredient.ingredient_name AS Ingrédient
	recipe_ingredients.          

FROM                                                         
    category                                                

INNER JOIN                                                  
    recipe                                                  

ON                                                          
    recipe.id_category = category.id_category               




-->