<aside class="menu">
    <p class="menu-label"><i class="fa fa-indent"></i> ARGOMENTI</p>
    <ul class="menu-list">
        <?php foreach ($indice as $s) { ?>
        <li>
            <a class="<?php if ($sezione && !$argomento && $sezione->numero==$s->numero) echo 'is-active'; ?>" href="<?= route($indice_route, ['sezione' => $s->numero]) ?>">
                <?= $s->numero ?>. <?= $s->nome ?>
            </a>

            <?php if (!empty($s->argomenti)) { ?>
            <ul>
                <?php foreach ($s->argomenti as $a) { ?>
                <li><a class="<?php if ($argomento && $s->numero == $sezione->numero && $a->numero == $argomento->numero) echo 'is-active'; ?>" href="<?= route($indice_route, ['sezione' => $s->numero, 'argomento' =>$a->numero]) ?>">
                    <?= $a->numero ?>. <?= $a->nome; ?>
                </a></li>
                <?php } ?>
            </ul>
            <?php } ?>
        </li>
        <?php } ?>
    </ul>
</aside>