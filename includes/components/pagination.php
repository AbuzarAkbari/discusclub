<?php
$limit = 10;
$page = $_GET['p'];

if($page == '')
{
    $page = 1;
    $start = 0;
}
else
{
    $start = $limit * ($page-1);
}

$tot = mysqli_query("SELECT COUNT(id) FROM topics");
$total = mysqli_num_rows($tot);
$num_page = ceil($total/$limits);

function pagination($page,$num_page)
{
    echo '<ul>';
    for ($i = 1; $i <= $num_page; $i++) {
        if ($i == $page) {
            echo'<li><a href="#">'.$i.'</a></li>';
        }
        else
        {
            echo'<li><a href="#">'.$page.'</a></li>';
        }
    }
    echo '</ul>';
}