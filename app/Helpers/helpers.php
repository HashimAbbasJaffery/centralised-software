<?php 

function denormalise($value) {
    return (int) str_replace(',', '', $value);
}