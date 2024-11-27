<?php

try		// PHP essaie d'exécuter les instructions à l'intérieur du bloc try
{
		// On se connecte à MySQL
	$mysqlClient = new PDO('mysql:host=localhost;dbname=recettes;charset=utf8', 'root', ''
	[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],	// Si requête SQL « plante », bien souvent PHP vous dira qu'il y a eu une erreur à la ligne du fetchAll
	);												// Pour afficher les détails sur l'erreur -> on activer la gestion des erreurs
													// toutes les requêtes SQL qui comportent des erreurs s'afficheront avec un message beaucoup plus clair
}
		// S'il y a une erreur, il rentre dans le bloc catch et fait ce qu'on lui demande (ici, on arrête l'exécution de la page en affichant
		// un message décrivant l'erreur).
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
		// Si au contraire tout se passe bien, PHP poursuit l'exécution du code et ne lit pas ce qu'il y a dans le bloc catch


// Si tout va bien, on peut continuer



// On récupère tout le contenu de la table recipes
	$sqlQuery = 'SELECT * FROM recipe';
	$recipeStatement = $mysqlClient->prepare($sqlQuery); 	//Prendre tout ce qu'il y a dans la table recipes

	// Pour récupérer les données, on demande à cet objet d'exécuter la requête SQL et de récupérer toutes les données dans un format "exploitable"
	// pour nous sous la forme d'un tableau PHP.
	$recipeStatement->execute();
	$recipe = $recipeStatement->fetchAll();



// On affiche chaque recette une à une
foreach ($recipe as $solo_recipe) {
?>
    <p><?php echo $solo_recipe['recipe_name']; ?></p> 	<!-- affiche le nom de la recette -->
<?php
}

?>