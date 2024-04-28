<?php
$cssPage = "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700";
$cssCurrentPage = "flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700";
$cssPrevPage = "flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700";
$cssNextPage = "flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700";
?>

<nav aria-label="Page navigation" class="pb-4">
    <ul class="inline-flex -space-x-px text-sm">
        <?php if ($prev) { ?>
            <li>
                <a href="index.php?page=<?php echo $prev ?>" class="<?php echo $cssPrevPage ?>">Previous</a>
            </li>
        <?php } ?>
        <?php for ($i = 1; $i <= $pagesTotal; $i++) {
            $classes = ($i == $page) ? $cssCurrentPage : $cssPage;
            echo "<li><a href='index.php?page={$i}' class='{$classes}'>{$i}</a></li>";
        } ?>
        <?php if ($next) { ?>
            <li>
                <a href="index.php?page=<?php echo $next ?>" class="<?php echo $cssNextPage ?>">Next</a>
            </li>
        <?php } ?>
    </ul>
</nav>