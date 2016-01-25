<?php

if($segment === 'asset' && strpos(Request::get('path', ""), '__snippet/') === 0) {
    Weapon::add('SHIPMENT_REGION_BOTTOM', function() {
        echo '<script>!function(e,t,a){function n(e){var n=t.createElement("a"),l=e.getElementsByTagName("a")[0],r=l?l.href:!1;r&&!r.match(/[?&]path=/)&&r.match(/\/__snippet\/(txt|php)\//)&&(r=r.replace(RegExp("^"+a.url.url+"\\/lot\\/assets\\/__snippet\\/((?:txt|php)\\/.*?)\\.[a-z]+$"),a.url.url+"/s/:$1"),r=r.replace(/:txt\//,"print:"),r=r.replace(/:php\//,"include:"),n.innerHTML=\'<i class="fa fa-share-alt"></i>\',n.href=r,n.target="_blank",e.appendChild(t.createTextNode(" ")),e.appendChild(n))}if("asset"===a.segment){var l=t.getElementsByClassName("form-asset");if(l){var r=l[0].getElementsByTagName("table");if(r){var s=r[0].getElementsByTagName("tr");if(s)for(var p=0,i=s.length;i>p;++p)n(s[p].children[2])}}}}(window,document,DASHBOARD);</script>';
    });
}