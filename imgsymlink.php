<?php

$sym = symlink('/home2/iabcafri/iabc/public','public_html');

if($sym) {
    echo "Symlink successfully created";
} else {
    echo "Symlink creation failed!";
}

?>