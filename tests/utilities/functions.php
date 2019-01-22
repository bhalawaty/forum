<?php

function create($class, $attributes = [], $numbers = null)
{

    return factory($class, $numbers)->create($attributes);
}

function make($class, $attributes = [], $numbers = null)
{

    return factory($class, $numbers)->make($attributes);
}

