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
		


$id = $_GET['id'];

$sqlQueryRecipe = "
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
    
WHERE 
    id_recipe = :id
";  

$recipeStatement = $mysqlClient->prepare($sqlQueryRecipe); 	

$recipeStatement->execute(['id' => $id]);

$recipe = $recipeStatement->fetch();    // fetch car renvoie une seule ligne (sinon fetchAll)




$sqlQueryIngredients = "
SELECT                    
	*,
    ingredient.ingredient_name AS Nom_Ingrédient,
    recipe_ingredients.quantity AS Quantité,
    ingredient.unity AS Unité_De_Mesure          

FROM                                                         
    recipe_ingredients                                               

INNER JOIN                                                  
    ingredient                                                 

ON                                                          
    recipe_ingredients.id_ingredient = ingredient.id_ingredient      
    
WHERE 
    id_recipe = :id
";  

$ingredientsStatement = $mysqlClient->prepare($sqlQueryIngredients); 	

$ingredientsStatement->execute(['id' => $id]);

$ingredients = $ingredientsStatement->fetchAll();    // fetchAll car renvoie plusieurs lignes d'ingrédients (sinon fetch)



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
	
	<?php
			// affichage des données : la recette avec ses infos

			echo "<p>".$recipe['Recette']."</p>"; 						// affiche le nom de la recette 

			echo "<p>".$recipe['Catégorie']."</p>"; 					// afficher le nom de la catégorie  

			echo "<p>".$recipe['Temps_De_Préparation']." minutes </p><br>";		// affiche le temps de préparation 

	?>


    <table class="demo">
        <thead>
        <tr>
            <th>Ingrédient</th>
            <th>Quantité</th>
            <th>Unité de Mesure</th>
        </tr>
        </thead>
        <tbody>

            <?php
                // affichage des données : tous les ingrédients de la recette

                foreach ($ingredients as $ingredient) {
				
                    echo "<tr><td>".$ingredient['Nom_Ingrédient']."</td>"; 			

                    echo "<td>".$ingredient['Quantité']."</td>"; 													  

                    echo "<td>".$ingredient['Unité_De_Mesure']."</td></tr>";	
                }

            ?>

        </tbody>
    </table>


</body>
</html>

<!--

Une deuxième page detailRecette.php :

- on affichera le détail d'une recette avec les infos: nom, 
													   catégorie,
													   temps de préparation. 	                    FAIT

													   + liste des ingrédients de cette recette.	FAIT

- revenir page 1 et lier avec recette respective													FAIT

- STYLISATION													   									NON COMMENCÉE

-->