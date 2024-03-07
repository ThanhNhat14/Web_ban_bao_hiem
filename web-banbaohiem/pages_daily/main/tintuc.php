<!DOCTYPE html>
<html>
<head>
    <title>Đọc tin tức RSS</title>
    <style>
        .rss-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
        }

        .rss-container h1 {
            color: #333333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .rss-container .item {
            margin-bottom: 30px;
        }

        .rss-container .item-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .rss-container .item-description {
            font-size: 14px;
            color: #555555;
        }

        .rss-container .item-link {
            font-size: 14px;
            color: #0066cc;
            text-decoration: none;
        }

        .rss-container .item-image {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }
        .rss-container .item .item-description img{
            width:  50%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php
    $url='https://vnexpress.net/rss/doi-song.rss';
    $lines_array=file($url);

    $lines_string=implode('',$lines_array);
    $xml = simplexml_load_string($lines_string);
    if ($xml === false) {
        echo "Failed loading XML: ";
        foreach(libxml_get_errors() as $error) {
            echo "<br>", $error->message;
        }
    } else {
        echo '<div class="rss-container">';
        echo '<h1>' . $xml->channel->title . '</h1>';

        foreach ($xml->channel->item as $item) {
            echo '<div class="item">';
            echo '<h2 class="item-title">' . $item->title . '</h2>';
            echo '<div class="item-description">' . $item->description . '</div>';
            echo '<a class="item-link" href="' . $item->link . '">Read more</a>';
            echo '</div>';
        }

        echo '</div>';
    }
    ?>
</body>
</html>