<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Example Breadcrumbs
 */

// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});

/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Dashboard
 */

Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});


/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Profile
 */
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Profil Saya', route('profile.edit'));
});

/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Settings
 */

Breadcrumbs::for('settings', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Pengaturan', "javascript:void(0)");
});

Breadcrumbs::for('navigations', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Menu', route('settings.navs.index'));
});

Breadcrumbs::for('navigation-edit', function (BreadcrumbTrail $trail, $nav, $title = null) {
    $trail->parent('navigation');
    $trail->push("Edit Menu $title", route('settings.navs.edit', $nav));
});

Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Pengguna', route('settings.users.index'));
});

Breadcrumbs::for('impersonate', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Impersonate', route('settings.impersonate.index'));
});

Breadcrumbs::for('users-create', function (BreadcrumbTrail $trail) {
    $trail->parent('users');
    $trail->push('Tambah Pengguna', route('settings.users.create'));
});

Breadcrumbs::for('users-edit', function (BreadcrumbTrail $trail, $user, $name = null) {
    $trail->parent('users');
    $trail->push("Edit Pengguna $name", route('settings.users.edit', $user));
});

Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Peran', route('settings.roles.index'));
});

Breadcrumbs::for('roles-permissions', function (BreadcrumbTrail $trail, $roleId, $name) {
    $trail->parent('roles');
    $trail->push("Hak Akses Peran $name", route('settings.roles.show', $roleId));
});

Breadcrumbs::for('preferences', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Preferensi', route('settings.preferences.index'));
});

Breadcrumbs::for('cache', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Cache Management', route('settings.cache.index'));
});

Breadcrumbs::for('apps-log', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('App Logs', route('settings.apps-log.index'));
});

Breadcrumbs::for('apps-log.show', function (BreadcrumbTrail $trail, $filename) {
    $trail->parent('apps-log');
    $trail->push($filename, route('settings.apps-log.show', $filename));
});

Breadcrumbs::for('migrations', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Migrations Management', route('settings.migrations.index'));
});

Breadcrumbs::for('seeders', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Seeders Management', route('settings.seeders.index'));
});

Breadcrumbs::for('queues', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Queue Management', route('settings.queues.index'));
});

Breadcrumbs::for('schedulers', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push('Scheduler Management', route('settings.schedulers.index'));
});
