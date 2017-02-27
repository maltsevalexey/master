<section class="body">
    <? foreach ($total_inf as $v_inf) {

        $inform_name = $v_inf['inform_name'];
        $inform = $v_inf['inform'];
    ?>
        <div>
            <label><?=  $inform_name; ?> </label><br>
            <?= $inform; ?>
        </div>
    <? }; ?>
</section>