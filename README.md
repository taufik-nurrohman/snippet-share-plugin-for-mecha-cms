Code Snippet Share Plugin for Mecha CMS
=======================================

> Share your snippet data as a stand–alone page/file.

#### Permanent Link

 - `/s/print:file-1234` → map to `/assets/__snippet/txt/file-1234.txt`
 - `/s/print:path/to/file-1234` → map to `/assets/__snippet/txt/path/to/file-1234.txt`
 - `/s/include:file-1234` → map to `/assets/__snippet/php/file-1234.php`
 - `/s/include:path/to/file-1234` → map to `/assets/__snippet/php/path/to/file-1234.php`

#### Options

 - `/s/print:file-1234?brush=css` → apply CSS syntax highlighter to the source code
 - `/s/print:file-1234?brush=false` → disable syntax highlighter
 - `/s/print:file-1234?raw=1` → output the source code as a plain text file
 - `/s/print:file-1234?file=1` → force to download the page as a snippet file