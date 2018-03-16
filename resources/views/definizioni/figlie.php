<hr/>
<div class="content">
    <p>Da questa definizione derivano:</p>
</div>

<div class="tile is-ancestor">
    <?php for ($j = 0; $j < 2; $j++) { ?>
    <div class="tile is-vertical is-parent is-half">
        <?php for ($i=$j; $i<count($figlie); $i=$i+2) { ?>

        <article class="tile is-child notification is-light">
            <h3 class="title is-5">
                <a href="<?= route('definizioni.show', ['codice' => $figlie[$i]->codice]) ?>"><?= $figlie[$i]->nome ?></a>
            </h3>
            <div class="content">
                <p><?= cut(refs($figlie[$i]->testo)) ?></p>
            </div>
        </article>

        <?php } ?>
    </div>
    <?php } ?>
</div>