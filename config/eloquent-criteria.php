<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Macro
    |--------------------------------------------------------------------------
    |
    | This option controls the ability to add a macro to the eloquent builder,
    | which allows, when enabled, to add criteria builder functionality to the eloquent
    | at the global level
    | methods criteriaQuery(), apply() will be added
    | to the Eloquent through the macro
    |
    */
    'macro_enabled' => env('ELOQUENT_CRITERIA_MACRO_ENABLED', false),
];
