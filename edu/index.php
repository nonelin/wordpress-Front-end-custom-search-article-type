
<?php get_header();?>
<main class="container">
  <div class="bg-light p-5 rounded">
    <h4>打發時間 搜尋教學範本 dafatime.idv.tw</h4>
    <p class="text-danger">index.php 頁面</p>
    <form class="row g-3" method="GET" action="<?php echo home_url(); ?>">
  <div class="col-auto">
    <label for="search" class="visually-hidden">搜尋</label>
    <input type="search" class="form-control" id="search" placeholder="搜尋" name="s" value="<?php get_search_query(); ?>">
  </div>
   <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">搜尋</button>
  </div>
</form>
</div>
</main>

<?php get_footer(); ?>

