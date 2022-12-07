<?php

/**
 * @var $router WPFluent\Http\Router
 */

$router->prefix('platforms')->withPolicy('PlatformPolicy')->group(function ($router) {
    $router->get('/', 'Platforms\PlatformController@index');
    $router->get('/enabled', 'Platforms\PlatformController@enabledPlatforms');
    $router->post('/update-dashboard-notices', 'Platforms\PlatformController@updateDashboardNotices');
    $router->prefix('reviews')->group(function ($router) {
        $router->get('/configs', 'Platforms\Reviews\ConfigsController@index');
        $router->post('/configs', 'Platforms\Reviews\ConfigsController@store');
        $router->delete('/configs', 'Platforms\Reviews\ConfigsController@delete');
        $router->post('/', 'Platforms\Reviews\ConfigsController@saveReviews');
        $router->post('/configs/manually-sync-reviews', 'Platforms\Reviews\ConfigsController@manuallySyncReviews');
    });
    $router->prefix('feeds')->group(function ($router) {
        $router->get('/configs', 'Platforms\Feeds\ConfigsController@index');
        $router->post('/configs', 'Platforms\Feeds\ConfigsController@store');
        $router->delete('/configs', 'Platforms\Feeds\ConfigsController@delete');
    });
});

$routes = function ($router) {
    $router->get('/', 'Platforms\Reviews\RecommendationsController@index');
    $router->post('/', 'Platforms\Reviews\RecommendationsController@create');
    $router->post('/{id}/duplicate', 'Platforms\Reviews\RecommendationsController@duplicate')->int('id');
    $router->put('/{id}', 'Platforms\Reviews\RecommendationsController@update')->int('id');
    $router->delete('/{id}', 'Platforms\Reviews\RecommendationsController@delete')->int('id');
};

// Manage custom reviews from RecommendationsController controller
$router->prefix('reviews')->withPolicy('ReviewPolicy')->group($routes);

// Manage custom testimonial from RecommendationsController controller
$router->prefix('testimonials')->withPolicy('ReviewPolicy')->group($routes);

$router->prefix('settings')->withPolicy('SettingsPolicy')->group(function ($router) {
    $router->get('/', 'SettingsController@index');
    $router->put('/', 'SettingsController@update');

    $router->get('/fluent_forms', 'SettingsController@getFluentFormsSettings');
    $router->put('/fluent_forms', 'SettingsController@saveFluentFormsSettings');

    $router->delete('/', 'SettingsController@delete');
    $router->delete('/twitter-card', 'SettingsController@deleteTwitterCard');

    $router->get('/license', 'SettingsController@getLicense');
    $router->delete('/license', 'SettingsController@removeLicense');
    $router->post('/license', 'SettingsController@addLicense');

    $router->get('/translations', 'SettingsController@getTranslations');
    $router->post('/translations', 'SettingsController@saveTranslations');
});

$router->prefix('chat-widgets')->withPolicy('TemplatePolicy')->group(function ($router) {
    $router->get('/', 'WidgetsController@index');
    $router->post('/', 'WidgetsController@create');
    $router->put('/{id}', 'WidgetsController@update')->int('id');
    $router->post('/{id}/duplicate', 'WidgetsController@duplicate')->int('id');
    $router->delete('/{id}', 'WidgetsController@delete')->int('id');
    $router->prefix('meta')->group(function ($router) {
        $router->prefix('chats')->group(function ($router) {
            $router->get('/{id}', 'Platforms\Chats\MetaController@index')->int('id');
            $router->put('/{id}', 'Platforms\Chats\MetaController@update')->int('id');
            $router->delete('/{id}/edit', 'Platforms\Chats\MetaController@delete')->int('id');
        });
    });
});

$router->prefix('notifications')->withPolicy('TemplatePolicy')->group(function ($router) {
    $router->get('/', 'NotificationsController@index');
    $router->post('/', 'NotificationsController@create');
    $router->put('/{id}', 'NotificationsController@update')->int('id');
    $router->post('/{id}/duplicate', 'NotificationsController@duplicate')->int('id');
    $router->delete('/{id}', 'NotificationsController@delete')->int('id');
});

$router->prefix('templates')->withPolicy('TemplatePolicy')->group(function ($router) {
    $router->get('/', 'TemplatesController@index');
    $router->post('/', 'TemplatesController@create');
    $router->post('/{id}/duplicate', 'TemplatesController@duplicate')->int('id');
    $router->delete('/{id}', 'TemplatesController@delete')->int('id');

    $router->put('/title/{id}', 'TemplatesController@updateTitle')->int('id');

    $router->prefix('meta')->group(function ($router) {
        $router->prefix('reviews')->group(function ($router) {
            $router->get('/{id}', 'Platforms\Reviews\MetaController@index')->int('id');
            $router->put('/{id}', 'Platforms\Reviews\MetaController@update')->int('id');
            $router->post('/{id}/edit', 'Platforms\Reviews\MetaController@edit')->int('id');
        });
        $router->prefix('feeds')->group(function ($router) {
            $router->get('/{id}', 'Platforms\Feeds\MetaController@index')->int('id');
            $router->put('/{id}', 'Platforms\Feeds\MetaController@update')->int('id');
            $router->post('/{id}/edit', 'Platforms\Feeds\MetaController@edit')->int('id');
        });
    });
});