<!-- Pagination system -->
<?php
    // $sql = 'SELECT COUNT(*) AS x FROM approval_signup';
    $query = $dbc->prepare($sql);
    $query->execute(isset($pagination_bindings) ? $pagination_bindings : []);
    $results = $query->fetch();
    $count = ceil($results['x'] / $perPage);
    function makePath($page, $path) {
        $query = $_GET;
        unset($query["pagina"]);
        return str_replace(":page", $page, $path . "?" . http_build_query($query));
    }
?>
<?php if ($results['x'] > $perPage) : ?>
<div class="col-xs-12">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="<?php echo makePath(1, $path); ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li>
                <a href="<?php echo makePath($page-1 <= 0 ? $page : $page-1, $path); ?>" aria-label="Next">
                    <span aria-hidden="true"><</span>
                </a>
            </li>
            <?php
            $diff = $count - $page;
            $x = $diff < 5 ? ($page - (4-$diff)) : $page;
            $y = (($page < $count-5) ? ($page + 5) : ($count+1));
            $x = $x < 1 ? 1 : $x;
            for ($x = $x; $x < $y; $x++) : ?>
                <li<?php echo ($x == $page) ? ' class="active"' : ''; ?>>
                    <a href="<?php echo makePath($x, $path); ?>"><?php echo $x; ?></a>
                </li>
            <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         endfor; ?>
            <li>
                <a href="<?php echo makePath($page+1 > $count ? $page : $page+1, $path); ?>" aria-label="Next">
                    <span aria-hidden="true">></span>
                </a>
            </li>
            <li>
                <a href="<?php echo makePath($count, $path); ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<?php endif; ?>