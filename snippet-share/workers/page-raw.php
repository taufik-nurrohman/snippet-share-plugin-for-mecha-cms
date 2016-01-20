<?php

// Force browser to render the output as plain text
HTTP::mime('text/plain');
echo $content;