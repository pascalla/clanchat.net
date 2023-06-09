<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application ID
    |--------------------------------------------------------------------------
    |
    | This is the ID of your Discord application.
    |
    */

    'client_id' => env('LARASCORD_CLIENT_ID', null),

    /*
    |--------------------------------------------------------------------------
    | Application Secret
    |--------------------------------------------------------------------------
    |
    | This is the secret of your Discord application.
    |
    */

    'client_secret' => env('LARASCORD_CLIENT_SECRET', null),

    /*
    |--------------------------------------------------------------------------
    | Application Access Token
    |--------------------------------------------------------------------------
    |
    | This is the access token of your Discord application.
    |
    */

    'access_token' => env('LARASCORD_ACCESS_TOKEN', null),

    /*
    |--------------------------------------------------------------------------
    | Grant Type
    |--------------------------------------------------------------------------
    |
    | This is the grant type of your Discord application. It must be set to
    | "authorization_code".
    |
    */

    'grant_type' => env('LARASCORD_GRANT_TYPE', 'authorization_code'),

    /*
    |--------------------------------------------------------------------------
    | Redirect URI
    |--------------------------------------------------------------------------
    |
    | This is the URI that Discord will redirect to after the user authorizes
    | your application.
    |
    */

    'redirect_uri' => env('APP_URL', 'http://localhost:8000') . '/' . env('LARASCORD_PREFIX', 'larascord') . '/callback',

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    |
    | These are the OAuth2 scopes of your Discord application.
    |
    */

    'scopes' => env('LARASCORD_SCOPE', 'identify&email'),

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | This is the prefix that Larascord will use for its routes. For example,
    | the prefix "larascord" will result in the route
    | "https://domain.com/larascord/login".
    |
    */

    'prefix' => env('LARASCORD_PREFIX', 'larascord'),

    /*
    |--------------------------------------------------------------------------
    | OAuth2 Prompt - "none" or "consent"
    |--------------------------------------------------------------------------
    |
    | The prompt controls how the authorization flow handles existing authorizations.
    | If a user has previously authorized your application with the requested scopes
    | and prompt is set to consent,it will request them to re-approve their
    | authorization. If set to none, it will skip the authorization screen
    | and redirect them back to your redirect URI without requesting
    | their authorization.
    |
    */

    'prompt' => 'none',

    /*
    |--------------------------------------------------------------------------
    | Guild-Only Login
    |--------------------------------------------------------------------------
    |
    | This setting allows users to use the application only if they are a member
    | of specific guilds.
    |
    */

    'guild_only' => false,
    'guilds' => [],

    /*
    |--------------------------------------------------------------------------
    | Guild-Only Roles
    |--------------------------------------------------------------------------
    |
    | This setting allows users to use the application only if they have
    | specific roles in specific guilds.
    |
    */

    // WARNING: This feature makes one request to the Discord API for each guild you specify. (Because you need to fetch the roles for each guild)
    // At the moment the database is not checked for roles when the user logs in. It will always fetch the roles from the Discord API.
    // Currently, the roles are only updated in the database when the user logs in. The roles from the database can be used in a middleware.
    // I'm working on a better way to do this, but for now, this should work.

    'guild_roles_enabled' => false,
    'guild_roles' => [
        // 'guild_id' => [
        //     'role_id',
        //     'role_id',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Error Messages
    |--------------------------------------------------------------------------
    |
    | These are the error messages that will be displayed to the user if there
    | is an error.
    |
    */

    'error_messages' => [
        'missing_code' => [
            'message' => 'The authorization code is missing.',
            'redirect' => '/'
        ],
        'invalid_code' => [
            'message' => 'The authorization code is invalid.',
            'redirect' => '/'
        ],
        'authorization_failed' => [
            'message' => 'The authorization failed.',
            'redirect' => '/'
        ],
        'missing_email' => [
            'message' => 'Couldn\'t get your e-mail address.',
            'redirect' => '/'
        ],
        'invalid_user' => [
            'message' => 'The user ID doesn\'t match the logged-in user.',
            'redirect' => '/'
        ],
        'database_error' => [
            'message' => 'There was an error with the database. Please try again later.',
            'redirect' => '/'
        ],
        'missing_guilds_scope' => [
            'message' => 'The "guilds" scope is required.',
            'redirect' => '/'
        ],
        'authorization_failed_guilds' => [
            'message' => 'Couldn\'t get the servers you\'re in.',
            'redirect' => '/'
        ],
        'not_member_guild_only' => [
            'message' => 'You are not a member of the required guilds.',
            'redirect' => '/'
        ],
        'missing_access_token' => [
            'message' => 'The access token is missing.',
            'redirect' => '/'
        ],
        'authorization_failed_roles' => [
            'message' => 'Couldn\'t get the roles you have.',
            'redirect' => '/'
        ],
        'missing_role' => [
            'message' => 'You don\'t have the required roles.',
            'redirect' => '/'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Success Messages
    |--------------------------------------------------------------------------
    |
    | These are the success messages that will be displayed to the user if there
    | is no error.
    |
    */

    'success_messages' => [
        'user_deleted' => 'Your account has been deleted.',
    ],

];
