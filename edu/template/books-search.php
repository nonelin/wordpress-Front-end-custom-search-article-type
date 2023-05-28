<?php
/**
 * Template Name: Books 搜尋頁面
 */
get_header();
?>

<main class="container">
  <div class="bg-light p-5 rounded">
  	<h4>打發時間 搜尋 books 文章類型 dafatime.idv.tw</h4>
    <p class="text-danger">books-search.php 頁面</p>
    <form class="row g-3" method="GET" action="<?php echo home_url('/books-search/'); ?>">
  <div class="col-auto">
    <label for="search" class="visually-hidden">搜尋</label>
    <input type="search" class="form-control" id="search" placeholder="搜尋" name="b" value="<?php echo $_GET['b'] ?? ''; ?>">
  </div>
   <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">搜尋</button>
  </div>
</form>
</div>
<div class="row">
	<div class="col">
    <ul class="list-group">
      <?php 
      global $wpdb;
      $wp_posts = $wpdb->prefix . 'posts';
      $wp_postmeta = $wpdb->prefix . 'postmeta';
      $books_word = $_GET['b'] ?? '';
      $join_sql = $wpdb->prepare("SELECT  p.ID,   
                                          p.post_title, 
                                          p.post_content,
                                          pm.isbn,
                                          pm.publish_date
                                          FROM (SELECT
                                            post_id,
                                            MAX(CASE WHEN meta_key = 'isbn' THEN meta_value END) AS isbn,
                                            MAX(CASE WHEN meta_key = 'publish_date' THEN meta_value END) AS publish_date
                                          FROM {$wp_postmeta}
                                          GROUP BY post_id) AS pm
                                          JOIN {$wp_posts} AS p
                                          ON p.ID = pm.post_id 
                                          WHERE post_type = 'books' AND
                                                post_status = 'publish'
                                                AND p.post_title LIKE '%".$books_word."%'
                                                OR p.post_content LIKE '%".$books_word."%'
                                                OR pm.isbn LIKE '%".$books_word."%'
                                                OR pm.publish_date LIKE '%".$books_word."%'");
    // echo $join_sql;
      // 執行查詢
    $results = $wpdb->get_results($join_sql);
      // var_dump($books_query->request);
      //判斷有沒有搜尋調內容
      if ($results) {
        //這個判斷可以在無值時不會顯示出所有文章
        if ( empty($books_word) ){
            return;
        }
        // 搜尋結果迴圈
       foreach ($results as $result) {?>
        <li id="post-<?php echo $result->ID; ?>" class="list-group-item">
        <?php echo $result->post_title;?>
        </li>
       
       <?php }}else{ ?>

        <li  class="list-group-item">
        <span class="text-danger">沒有找到任何文章! </span>
        </li>
      <?php }; ?>
    </ul>
	</div>
</div>
</main>

<?php get_footer();