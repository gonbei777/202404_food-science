<?php get_header(); ?>

<main>
  <section class="section section-foodList">
    <div class="section_inner">
      <div class="section_header">
        <h2 class="heading heading-primary"><span>フード紹介</span>FOOD</h2>
      </div>

      <?php
      $menu_terms = get_terms(['taxonomy' => 'menu']);
      ?>

      <?php if ($menu_terms): ?>
        <?php foreach ($menu_terms as $menu): ?>
          <section class="section_body">
            <h3 class="heading heading-secondary">
              <a href="<?= get_term_link($menu); ?>"><?= $menu->name; ?></a>
              <span><?= strtoupper($menu->slug); ?></span>
            </h3>
            <ul class="foodList">

              <?php
              $args = [
                'post_type' => 'food',
                'posts_per_page' => -1, //全件取得
                'tax_query' => [
                  'relation' => 'AND',
                  // [],[],[],... 条件を配列で指定（複数ある場合は配列を必要数用意する）
                  [
                    'taxonomy' => 'menu',
                    'terms' => $menu->slug,
                    'field' => 'slug'
                  ]
                ],
              ];
              $the_query = new WP_Query($args);
              ?>

              <?php if ($the_query->have_posts()):  ?>
                <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                  <li class="foodList_item">
                    <?php get_template_part('template-parts/loop', 'food'); ?>
                  </li>
                <?php endwhile;
                wp_reset_postdata();
                ?>
              <?php endif; ?>

            </ul>
          </section>
        <?php endforeach; ?>
      <?php endif; ?>

    </div>
  </section>
</main>

<?php get_footer(); ?>