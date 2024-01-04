<?php $pager->setSurroundCount(0); ?>
<tr class="row mb-4">

    <td class="col-lg-6 d-flex justify-content-start mb-4">
        <?php if ($pager->hasPrevious()) { ?>
            <a class="btn btn-primary text-uppercase" href="<?= $pager->getPrevious(); ?>">&lsaquo; Older Posts</a>
        <?php } ?>
    </td>
    <td class="col-lg-6 d-flex justify-content-end mb-4">
        <?php if ($pager->hasNext()) { ?>
            <a class="btn btn-primary text-uppercase" href="<?= $pager->getNext(); ?>">Newer Posts &rsaquo;</a>
        <?php } ?>
    </td>
</tr>