<?php

function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

function set_open( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'menu-open' : '';
    }
    return Request::path() == $route ? 'menu-open' : '';
}
?>
