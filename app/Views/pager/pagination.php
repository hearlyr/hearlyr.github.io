<nav class="datatable-pagination">
    <ul class="datatable-pagination-list">
        <!-- <li class="datatable-pagination-list-item"><a data-page="6" class="datatable-pagination-list-item-link">6</a></li>
        <li class="datatable-pagination-list-item"><a data-page="2" class="datatable-pagination-list-item-link">›</a></li> -->
        <?php foreach ($pager->links() as $link) { ?>
            <?php $linkact = $link['active'] ? 'active' : ''; ?>
            <li class="<?= $linkact; ?>">
                <a href="<?= $link['uri']; ?>"><?= $link['title']; ?></a>
            </li>
        <?php } ?>
    </ul>
</nav>