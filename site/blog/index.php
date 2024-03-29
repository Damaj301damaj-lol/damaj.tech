<!DOCTYPE html>
<html lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<title>damaj.tech</title>
		<link rel="stylesheet" href="/css/blog.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
                <meta content="damaj.tech" property="og:title" />
                <meta content="Blog!" property="og:description" />
                <meta content="https://damaj.tech/site/blog" property="og:url" />
                <meta content="#FD7717" data-react-helmet="true" name="theme-color" />
	</head>
	<body>
    <?php include '/var/www/html/templates/header.php'?>
    <div class="circle"></div>
    <p> NOTE: for people who want to use an RSS reader, here is the <a href='rss.xml'>rss.xml</a></p>
    <?php
// Define the RSS feed URL
$feed = '/var/www/html/site/blog/rss.xml';

// Parse the XML
$xml = simplexml_load_file($feed);

// Loop through the items and display them
foreach ($xml->channel->item as $item) {
    // Add a box around the article
    echo '<div class="article-box">';
    
    // Highlight the title
    echo '<h2>' . $item->title . '</h2>';
    
    // Split the content into sentences
    $sentences = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $item->description);
    
    // Extract the first 5 sentences of the content
    $preview = implode(' ', array_slice($sentences, 0, 5));
    
    // Add three dots at the end of the preview, if necessary
    if (count($sentences) > 5) {
        $last_char = substr($preview, -1);
        if ($last_char != '.') {
            $preview .= '...';
        } else {
            $preview .= '..';
        }
    }
    
    echo $preview;
    
    // If there are more than 5 sentences, add a "Read More" link
    if (count($sentences) > 5) {
        echo '<br><a href="' . $item->link . '">Read more</a>';
    }
    
    // Close the box around the post
    echo '</div>';
}

// Written on September 22, 2021
?>
<?php include '/var/www/html/templates/footer.php'?>
	</body>
</html>
