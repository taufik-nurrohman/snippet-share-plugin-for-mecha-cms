<?php

$brush = Request::get('brush', $x === 'php' ? 'php' : 'generic');
$brush = Text::parse($brush, '->text');
if(is_numeric($brush) && $brush <= 0) $brush = false;
$_ = File::D(__DIR__) . DS . 'assets' . DS;

echo '<!DOCTYPE html>' . NL;
echo '<html dir="ltr">' . NL;
echo TAB . '<head>' . NL;
echo str_repeat(TAB, 2) . '<meta charset="' . $config->charset . '">' . NL;
echo str_repeat(TAB, 2) . '<title>' . File::B($snippet) . '</title>' . NL;
echo str_repeat(TAB, 2) . '<link href="' . Filter::colon('favicon:url', $config->url . '/favicon.ico') . '" rel="shortcut icon" type="image/x-icon">' . NL;
echo str_repeat(TAB, 2) . Asset::stylesheet(array(
    $_ . 'shell' . DS . 'page.min.css',
    $_ . 'shell' . DS . 'brush.min.css'
));
echo TAB . '</head>' . NL;
echo TAB . '<body>' . NL;
echo str_repeat(TAB, 2) . '<pre><code' . ($brush !== false ? ' data-language="' . $brush . '"' : "") . '>';
echo Filter::colon('snippet:content_raw', Text::parse($content, '->encoded_html'), $snippet);
echo '</code></pre>' . NL;
echo str_repeat(TAB, 2) . '<div>' . NL;
echo str_repeat(TAB, 3) . '<strong><a href="' . $config->url . '" title="' . $speak->home . '">' . $config->title . '</a></strong>' . NL;
echo str_repeat(TAB, 3) . '<a href="?raw=1" target="_blank">' . $speak->plugin_snippet_share_title_raw . '</a>' . NL;
echo str_repeat(TAB, 3) . '<a href="?file=1">' . $speak->download . '</a>' . NL;
echo str_repeat(TAB, 2) . '</div>' . NL;
echo str_repeat(TAB, 2) . Asset::javascript(array(
    $_ . 'sword' . DS . 'brush.min.js',
    $_ . 'sword' . DS . 'brush.line.min.js'
));
if($brush !== false) {
    echo str_repeat(TAB, 2) . Asset::javascript($_ . 'sword' . DS . 'brush' . DS . 'generic.min.js');
    if($brush !== 'generic' && $f = File::exist($_ . 'sword' . DS . 'brush' . DS . $brush . '.min.js')) {
        echo str_repeat(TAB, 2) . Asset::javascript($f);
    }
}
echo TAB . '</body>' . NL;
echo '</html>';