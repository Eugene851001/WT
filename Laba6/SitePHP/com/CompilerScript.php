<?php
  
function execute($code) {
    ob_start();
    eval($code);
    return ob_get_contents();
}
