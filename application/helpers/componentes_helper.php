<?php
function asgInput($nombre, $label, $opts=[]){
    $placeholder='';
    $type='text';
    $required='';
    $value='';
    $class='form-control';
    $disabled='';
    $id=$nombre;

    foreach($opts as $k=>$v){
        $$k = $v;
    }

    return "<div class='form=group'>
    <label> {$label}: </label>
    <input placeholder='{$placeholder}' class='{$class}' {$disabled} {$required} type='{$type}' name='{$nombre}' value='{$value}' id='{$id}'/>
    </div>";
}

function asgTextArea($nombre, $label, $opts=[]){
    $placeholder='';
    $type='text';
    $required='';
    $class='form-control';

    foreach($opts as $k=>$v){
        $$k = $v;
    }

    return "<div class='form=group'>
    <label> {$label}: </label><br>
    <textarea placeholder='{$placeholder}' class='{$class}' {$required} type='{$type}' name='{$nombre}'></textarea>
    </div>";
}