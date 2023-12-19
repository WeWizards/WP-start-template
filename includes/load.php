<?php

foreach(glob(THEME_DIR . '/includes/*/*.php') as $file){
    require_once $file;
}
