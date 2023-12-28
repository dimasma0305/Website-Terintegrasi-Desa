<div class="container">
    <h1><?= $article->title; ?></h1>
    <img class="img-thumbnail w-25" src="<?= base_url('uploads/artikel/'). $article->image_url ?>" alt="<?= $article->image_url ?>" >
    <p><?= $article->content; ?></p>
</div>
