<?php

use Packages\Licensing\Classes\License;

function checker(){
    return License::use();
}
