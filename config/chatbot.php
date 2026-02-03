<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Bot | AI Agent role
    |--------------------------------------------------------------------------
    |
    | The role you want the bot to impersonate.
    |
    */
    'role' => 'Tranding card game expert',

    /*
    |--------------------------------------------------------------------------
    | Prompts
    |--------------------------------------------------------------------------
    |
    | Prompts used.
    |
    */
    'prompts' => [
        'base' => 'You are a [:role] and you will use the file search provided (referenced as "our database") as primary source for context related to TCG (trading card game), answer the following: :question',
    ],

];