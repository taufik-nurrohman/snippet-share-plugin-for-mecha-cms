<?php

header('Content-Disposition: attachment; filename=' . File::B($snippet));
echo $content;
ignore_user_abort(true);
exit;