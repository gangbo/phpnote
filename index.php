<?php
require 'markdownviewer/Michelf/MarkdownExtra.inc.php';
use \Michelf\MarkdownExtra;
function scanmdfiles($dir)
{
    foreach (scandir($dir) as $file) {
        if ($file == '.') continue;
        if (!is_dir($file) && !preg_match("/\.md$/", $file)) continue;
        echo "<li><a href='index.php?f=$file'>$file</a></li>";
    }
}
$file = isset($_GET['f']) ? $_GET['f'] : '.';
if(is_file($file)) {
    $parser = new MarkdownExtra;
    $md_txt = file_get_contents($_GET['f']);
    $html = $parser->transform($md_txt);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8'>
<link rel="stylesheet" href="http://yandex.st/highlightjs/8.0/styles/default.min.css" />
</head>
<body>
<div class="file_list">
    <ul>
<?php
if(is_dir($file)) scanmdfiles($file);
?>
    </ul>
</div>
<?php
echo isset($html) ? $html : '';
?>

<script src="http://cdn.staticfile.org/jquery/2.1.1-rc2/jquery.js"></script>
<script src="http://yandex.st/highlightjs/8.0/highlight.min.js"></script>
<script type="text/javascript">
  //hljs.configure({classPrefix: ''});
  hljs.initHighlightingOnLoad();
</script>

</body>
</html>
