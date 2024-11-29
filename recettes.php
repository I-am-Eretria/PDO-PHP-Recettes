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
		


// On récupère tout le contenu de la table recipes
	$sqlQuery = 'SELECT * FROM recipe';
	$recipeStatement = $mysqlClient->prepare($sqlQuery); 	//Prendre tout ce qu'il y a dans la table recipes

	// Pour récupérer les données, on demande à cet objet d'exécuter la requête SQL et de récupérer toutes les données dans un format "exploitable"
	// pour nous sous la forme d'un tableau PHP.
	$recipeStatement->execute();
	$recipe = $recipeStatement->fetchAll();


// On récupère tout le contenu de la table category
$sqlQuery = 'SELECT * FROM category';
$categoryStatement = $mysqlClient->prepare($sqlQuery); 	

$categoryStatement->execute();
$category = $categoryStatement->fetchAll();
	



// On affiche chaque recette une à une
foreach ($recipe as $solo_recipe) {
?>
    <p><?php echo $solo_recipe['recipe_name']; ?></p> 	<!-- affiche le nom de la recette -->



	<p><?php echo $solo_recipe['id_category'[$solo_category['category_name']]]; ?></p> 	<!-- affiche  -->

	<?php
		foreach ($category as $solo_category) {
		?>
		<p><?php echo $solo_category['category_name']; ?></p> 	<!-- affiche  -->
		<?php
		}
	?>
	<!-- chercher comment afficher le nom de la catégorie pour chaque recette -->


	

	<p><?php echo $solo_recipe['preparation_time']; ?></p> 	<!-- affiche le temps de préparation -->
<?php
}

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
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</tbody>
</table>



</body>
</html>


<!--

Une première page recettes.php : elle listera tous les recettes de la BDD dans un tableau HTML 
(avec 3 colonnes : nom de la recette, nom de la catégorie, temps de préparation). 
On aura un lien < a > sur le nom de la recette qui mènera vers la 2e page.

-->
