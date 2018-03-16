<hr/>
<div class="content">
    <p>Questa definizione è presente come ipotesi dei seguenti teoremi:</p>
</div>

<div class="tile is-ancestor">
    <?php for ($j = 0; $j < 2; $j++) { ?>
    <div class="tile is-vertical is-parent is-half">
        <?php for ($i=$j; $i<count($teoremi); $i=$i+2) { ?>

        <article class="tile is-child notification is-light">
            <h3 class="title is-5">
                <a href="<?= route('teoremi.show', ['codice' => $teoremi[$i]->codice]) ?>"><?= $teoremi[$i]->nome ?></a>
            </h3>
            <div class="content">
                <p><?= cut(refs($teoremi[$i]->ipotesi . $teoremi[$i]->tesi)) ?></p>
            </div>
        </article>

        <?php } ?>
    </div>
    <?php } ?>
</div>