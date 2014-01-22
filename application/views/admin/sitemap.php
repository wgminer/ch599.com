<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc><?php echo base_url(); ?></loc> 
        <priority>1.0</priority>
    </url>

    <?php foreach($authors as $author) : ?>
    <url>
        <loc><?php echo base_url(); ?><?php echo $author->author_slug ?></loc>
        <changefreq>Monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php endforeach; ?>

    <?php foreach($genres as $genre) : ?>
    <url>
        <loc><?php echo base_url(); ?>/<?php echo $genre->genre_slug ?></loc>
        <changefreq>Monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php endforeach; ?>

    <?php foreach($posts as $post) : ?>
    <url>
        <loc><?php echo base_url(); ?><?php echo $post->post_slug ?></loc>
        <changefreq>Monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php endforeach; ?>
    
</urlset>