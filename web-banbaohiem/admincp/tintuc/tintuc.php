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
}else{
    echo '<div class="rss-container">';
    echo $xml->asXML();
    echo '</div>';
}
?>
