<?php
require "lib/requires.php";

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
            $id = (int) $_GET['id'];
			$select = $db->prepare("UPDATE categories SET name = :name, slug = :slug WHERE id=$id");
			$select->execute(array(
				'name' => $name,
				'slug' => $slug
			));
			$session->setFlash("La catégorie a bien été modifiée", "error"); header('Location:index.php'); die();
		}else{
			$select = $db->prepare("INSERT INTO categories (name, slug) VALUES(:name, :slug) ");
			$select->execute(array(
				'name' => $name,
				'slug' => $slug
			));

			$session->setFlash("La catégorie a bien été ajoutée", "sucess"); header('Location:index.php'); die();
		}
	}
}

if(isset($_GET['id'])){
	$id = (int) $_GET['id'];

	$select = $db->prepare("SELECT name, slug FROM categories WHERE id = :id LIMIT 1");
	$select->bindParam(':id', $id, PDO::PARAM_INT);
	$select->execute();

	$result = $select->fetch();

	$form->set(array(
		'name' => $result->name,
		'slug' => $result->slug
	));

	if($select->rowCount() == 0){
		$session->setFlash("Il y a pas de catégorie avec ce ID", "error"); header('Location:index.php'); die();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo (isset($result->name))?'<title>'.$result->name.'</title>':'<title> Forum </title>'; ?>
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