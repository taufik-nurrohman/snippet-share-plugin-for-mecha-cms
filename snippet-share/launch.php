<?php

Route::accept('s/(print|include)(:|/)(:all)', function($x = "", $o = ':', $path = "") use($config, $speak) {
    $path = ltrim(File::path($path), DS);
    $get = Request::get();
    $x = Mecha::alter($x, array(
        'print' => 'txt',
        'include' => 'php'
    ));
    // Disallow path traversal
    if(strpos(DS . $path . DS, DS . '..' . DS) !== false) {
        Shield::abort();
    }
    // File not found
    if( ! $snippet = File::exist(ASSET . DS . '__snippet' . DS . $x . DS . $path . '.' . $x)) {
        Shield::abort();
    }
    $content = File::open($snippet)->read();
    // Allow to run `printf` in snippet content for `txt` file
    if($x === 'txt') {
        $lot = isset($get['lot']) ? explode(',', $get['lot']) : false;
        if($lot !== false && strpos($content, '%') !== false) {
            // `http://stackoverflow.com/a/2053931`
            if(preg_match_all('#%(?:(\d+)[$])?[-+]?(?:[ 0]|[\'].)?(?:[-]?\d+)?(?:[.]\d+)?[%bcdeEfFgGosuxX]#', $content, $matches)) {
                $lot = Mecha::walk($lot, function($v) {
                    return str_replace('&#44;', ',', $v);
                });
                if(count($lot) >= count(array_unique($matches[1]))) {
                    $content = vsprintf($content, $lot);
                }
            }
        }
    }
    // Apply `do_snippet` filter if available
    if(function_exists('do_snippet')) {
        // Allow nested snippet(s) two time(s)
        $content = do_snippet(do_snippet($content));
    }
    // Apply all post content filter to the snippet output
    $filters = array();
    foreach(glob(POST . DS . '*', GLOB_NOSORT | GLOB_ONLYDIR) as $post) {
        $filters[] = File::B($post) . ':shortcode';
    }
    $filters[] = 'shortcode';
    $content = Filter::apply($filters, $content);
    // Force to download the file
    if(isset($get['file']) && ($get['file'] === true || $get['file'] > 0)) {
        include __DIR__ . DS . 'workers' . DS . 'page-file.php';
    }
    if(isset($get['raw']) && ($get['raw'] === true || $get['raw'] > 0)) {
        include __DIR__ . DS . 'workers' . DS . 'page-raw.php';
    } else {
        include __DIR__ . DS . 'workers' . DS . 'page.php';
    }
    exit;
});