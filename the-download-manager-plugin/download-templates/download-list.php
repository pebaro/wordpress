<?php

if ( !have_posts() ) :
    echo '<h3>No downloads available.</h3>';
else :

    global $query_string;

    if(!isset($_GET["show"])){
        $amount_of_posts = '25';
    }else{
        $amount_of_posts = $_GET["show"];
    }
    $order_list_by = $_GET["order_by"];
    $order_sort = $_GET["sort"];
    $neworder = ($order_sort == 'asc') ? 'desc' : 'asc';
    query_posts( $query_string . '&posts_per_page='.$amount_of_posts.'&orderby='.$order_list_by.'&order='.$order_sort.'' );

?>
    <div id="download-list">
        <h1>Downloads</h1>
        <p class="text-right"><?php
$count_posts = wp_count_posts('downloads');

$published_posts = $count_posts->publish;

echo $published_posts .' downloads available.';

?></p>
<p>Order by <a href="?order_by=date&sort=<?php echo $neworder; ?>&show=<?php echo $_GET["show"]; ?>">Date</a> | <a href="?order_by=title&sort=<?php echo $neworder; ?>&show=<?php echo $_GET["show"]; ?>">Title</a> and show <a href="?order_by=<?php echo $_GET["order_by"]; ?>&sort=<?php echo $neworder; ?>&show=5">5</a> | <a href="?order_by=<?php echo $_GET["order_by"]; ?>&sort=<?php echo $neworder; ?>&show=10">10</a> | <a href="?order_by=<?php echo $_GET["order_by"]; ?>&sort=<?php echo $neworder; ?>&show=25">25</a> | <a href="?order_by=<?php echo $_GET["order_by"]; ?>&sort=<?php echo $neworder; ?>&show=-1">All</a> downloads.
</p>
        <hr>
        <table class="table table-striped table-download-list">
            <thead>
            <tr>
                <th colspan="2">Download Title</th>
                <th>Category</th>
                <th>Download</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ( have_posts() ) : the_post();
                ?>
                <tr>
                    <td>
                        <?php

                        if(has_post_thumbnail()){
                       the_post_thumbnail( array(50, 50) );
                        }
                        else {
                        echo '<img src="'. plugins_url( 'the-download-manager-plugin/assets/public/images/logo.svg' ) .'" height="50px" width="50px" >';
                        }
                         ?>
                    </td>
                    <td class="download-list-name">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                        <small><i class="fa fa-download"></i>Number of downloads: <?php echo get_post_meta( get_the_ID(), 'download_count', true ); ?> | <i class="fa fa-calendar"></i>posted on <?php echo get_the_date( 'd-m-Y' ); ?></small>
                    </td>
                    <td>
                        <?php
                            $categories = wp_get_post_terms( get_the_ID(), "download-categories" );
                            foreach ($categories as $category) {
                                echo '<a href="/'  . $category->taxonomy . "/" . $category->slug . '" class="download-category">'  . $category->name . '</a>';
                            }
                        ?>
                    </td>
                    <td>
                        <a href="<?php echo get_permalink(get_the_ID()); ?>" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            <?php
            endwhile;
            ?>
            </tbody>
        </table>
        <?php downloads_archive_pagination();?>
    </div>
<?php
endif;
?>