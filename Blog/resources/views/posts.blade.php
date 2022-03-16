<!DOCTYPE html>
<?php  use App\Models\Post; ?>
<title> My Blog </title>
<link rel = "stylesheet" href="/app.css">

<body>

<?php foreach($posts=Post::all() as $post) : ?>
<article>
<?= $post; ?>
</article>
<?php endforeach;?>

</body>

