<?php

define('USERS','./db/users.json');

define('RECIPES','./db/recipe.json');

define('KEYS_USER',[
    'id',
    'token',
    'role',
    'name',
    'surname',
    'username',
    'password',
    'email',
    'user_image'
]);

define('KEYS_RECIPE',[
    'id',
    'title',
    'description',
    'image',
    'steps',
    'created_by',
    'date',
]);