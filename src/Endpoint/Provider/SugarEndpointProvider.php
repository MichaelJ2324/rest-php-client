<?php

/**
 * ©[2022] SugarCRM Inc.  Licensed by SugarCRM under the Apache 2.0 license.
 */

namespace Sugarcrm\REST\Endpoint\Provider;

use MRussell\REST\Endpoint\Provider\DefaultEndpointProvider;

/**
 * @package Sugarcrm\REST\Endpoint\Provider
 */
class SugarEndpointProvider extends DefaultEndpointProvider
{
    protected $registry = [
        'module' => [
            'class' => \Sugarcrm\REST\Endpoint\Module::class,
            'properties' => [],
        ],
        'list' => [
            'class' => \Sugarcrm\REST\Endpoint\ModuleFilter::class,
            'properties' => [],
        ],
        'audit' => [
            'class' => \Sugarcrm\REST\Endpoint\ModuleAudit::class,
            'properties' => [],
        ],
        'search' => [
            'class' => \Sugarcrm\REST\Endpoint\Search::class,
            'properties' => [],
        ],
        'metadata' => [
            'class' => \Sugarcrm\REST\Endpoint\Metadata::class,
            'properties' => [],
        ],
        'oauth2Token' => [
            'class' => \Sugarcrm\REST\Endpoint\OAuth2Token::class,
            'properties' => [],
        ],
        'oauth2Refresh' => [
            'class' => \Sugarcrm\REST\Endpoint\OAuth2Refresh::class,
            'properties' => [],
        ],
        'oauth2Logout' => [
            'class' => \Sugarcrm\REST\Endpoint\OAuth2Logout::class,
            'properties' => [],
        ],
        'oauth2Sudo' => [
            'class' => \Sugarcrm\REST\Endpoint\OAuth2Sudo::class,
            'properties' => [],
        ],
        'me' => [
            'class' => \Sugarcrm\REST\Endpoint\Me::class,
            'properties' => [],
        ],
        'bulk' => [
            'class' => \Sugarcrm\REST\Endpoint\Bulk::class,
            'properties' => [],
        ],
        'enum' => [
            'class' => \Sugarcrm\REST\Endpoint\Enum::class,
            'properties' => [],
        ],
        'ping' => [
            'class' => \Sugarcrm\REST\Endpoint\Ping::class,
            'properties' => [],
        ],
        'Note' => [
            'class' => \Sugarcrm\REST\Endpoint\Note::class,
            'properties' => [],
        ],
    ];
}
