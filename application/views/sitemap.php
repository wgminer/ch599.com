<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>
        <loc><?php echo base_url(); ?></loc> 
        <priority>1.0</priority>
    </url>

    <?php foreach($authors as $author) : ?>
    <url>
        <loc><?php echo base_url(); ?>author/<?php echo $author->slug ?></loc>
        <changefreq>Monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php endforeach; ?>

    <?php foreach($genres as $genre) : ?>
    <url>
        <loc><?php echo base_url(); ?>genre/<?php echo $genre->slug ?></loc>
        <changefreq>Monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php endforeach; ?>

    <?php foreach($songs as $song) : ?>
    <url>
        <loc><?php echo base_url(); ?>song/<?php echo $song->slug ?></loc>
        <changefreq>Monthly</changefreq>
        <priority>1.0</priority>
    </url>
    <?php endforeach; ?>
    
</urlset>