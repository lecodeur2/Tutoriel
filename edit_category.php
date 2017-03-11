<?php
$filename = "lib/config.php";
require "lib/form.class.php";
$form = new form();

if(file_exists($filename)){
	require $filename;
}else{
	echo "Le fichier est manquant";
	exit();
}


if(!empty($_POST)){
	extract($_POST);
	$valid = true;

	if(empty($name)){
		$error_name = "Erreur : ce champ est vide";
		$valid = false;
	}

	if(empty($slug)){
		$error_slug = "Erreur : ce champ est vide";
		$valid = false;
	}

	if($valid){

		if(isset($_GET["id"])){
            $id = $db->quote($_GET['id']);
			$select = $db->prepare("UPDATE categories SET name = :name, slug = :slug WHERE id=$id");
			$select->execute(array(
				'name' => $name,
				'slug' => $slug
			));

			echo "Modification effectuée";
		}else{
			$select = $db->prepare("INSERT INTO categories (name, slug) VALUES(:name, :slug) ");
			$select->execute(array(
				'name' => $name,
				'slug' => $slug
			));

			echo "La catégorie a bien été ajouté";
		}
	}
}

/*

if(empty($_POST['name'])){
	$error_name = "Erreur : ce champ est vide";
}

if(empty($_POST['slug'])){
	$error_slug = "Erreur ce champ est vide";
}

if(isset($_POST['name']) && isset($_POST['slug'])){
	$name = $db->quote($_POST['name']);
	$slug = $db->quote($_POST['slug']);
	if(isset($_GET['id'])){
		 $id = (int) $_GET['id'];
		 $select = $db->prepare("UPDATE categories SET name = :name, slug = :slug WHERE id=$id");
		 $select->execute(array(
		 	'name' => $name,
		 	'slug' => $slug
	 	));
	 echo "Modification effectuée";
	}else{
			$select = $db->prepare("INSERT INTO categories (name, slug) VALUES(:name, :slug) ");
			$select->execute(array(
				'name' => $name,
				'slug' => $slug
			));
	echo "Ajout effectué";
	}
}
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add category</title>
	<meta charset="utf-8">
</head>
<body>
	<section id="addpost">
		<h2>Add Category</h2>
		<form method="post">
			<div class="input">
				<?= $form->input("text", "name", "Nom de la catégorie :", array("placeholder" => "Nom de la catégorie")); ?>
				<?php if(isset($error_name)): ?>
				<span class="error-name">
					<?= $error_name; ?>
				</span>
				<?php endif; ?>
			</div>
			<div class="input">
				<?= $form->input("text", "slug", "Slug de la catégorie :", array("placeholder" => "Slug de la catégorie")); ?>
				<?php if(isset($error_slug)): ?>
				<span class="error-name">
					<?= $error_slug; ?>
				</span>
				<?php endif; ?>
			</div>
			<div class="input">
				<?= $form->submit('submit', 'Envoyer'); ?>
			</div>
		</form>
	</section>
</body>
</html>