<?php get_header(); ?>

<main class="container">
  <div class="bg-light p-5 rounded">
  	<h4>打發時間 搜尋教學範本 dafatime.idv.tw</h4>
    <p class="text-danger">search.php 頁面</p>
    <form class="row g-3" method="GET" action="<?php echo home_url(); ?>">
  <div class="col-auto">
    <label for="search" class="visually-hidden">搜尋</label>
    <input type="search" class="form-control" id="search" placeholder="搜尋" name="s" value="<?php echo get_search_query(); ?>">
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
      //判斷有沒有搜尋調內容
      if ( have_posts() ) : ?>
        <p class="text-danger">content-search.php 範本</p>
        <?php
        // 搜尋結果迴圈
        while ( have_posts() ) : the_post();
        //這裡會導到 content-search.php 範本檔案
        get_template_part( 'template/content', 'search' );
        endwhile; 
      
    else: ?>
       
       <p class="text-danger">content-none.php 範本</p>
       <?php
        // 沒有找到文章導到 content-none.php 沒找到範本檔案
        get_template_part( 'template/content', 'none' );
      endif; ?>
    </ul>
	</div>
</div>
</main>


<?php get_footer(); ?>