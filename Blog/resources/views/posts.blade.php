<!DOCTYPE html>
<?php  use App\Models\Post; ?>
<title> My Blog </title>
<link rel = "stylesheet" href="/app.css">

<body>

<?php foreach($posts as $post) : ?>
<article>
    <h1>
        <a href = "/posts/<?= $post->slug?>">
        <?= $post->title; ?>
        </a>
    </h1>
    <div>
    <p><?= $post->body; ?></p>
    </div>
</article>
<?php endforeach;?>

</body>

