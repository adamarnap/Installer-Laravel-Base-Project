<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavigationSeeder extends Seeder
{
    /* 
    ! ========================================================================================================
    * EXAMPLE DATA FOR NAVIGATION MENUS
    ! ========================================================================================================
    */

    // // Parent Menu
    // [
    //     'id' => 501,
    //     'name' => 'Pengaturan',
    //     'page' => 'admin',
    //     'url' => '#',
    //     'slug' => 'settings',
    //     'icon' => 'tabler--settings',
    //     'order' => 501,
    //     'parent_id' => null,
    //     'active' => true,
    //     'display' => true,
    // ],
    // // Child Menus
    // [
    //     'id' => 502,
    //     'name' => 'Pengaturan Lanjutan',
    //     'page' => 'admin',
    //     'url' => '#',
    //     'slug' => 'settings-advanced',
    //     'icon' => 'tabler--settings-2',
    //     'order' => 1,
    //     'parent_id' => 501,
    //     'active' => true,
    //     'display' => true,
    // ],
    // // Sub Child Menus
    // [
    //     'id' => 503,
    //     'name' => 'Pengaturan Lanjutan - Profil Website',
    //     'page' => 'admin',
    //     'url' => 'settings.advanced.profile.index',
    //     'slug' => 'settings-advanced-profile',
    //     'icon' => 'tabler--layout',
    //     'order' => 1,
    //     'parent_id' => 502,
    //     'active' => true,
    //     'display' => true,
    // ],

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* 
         * ========================================================================================================
         * FOR ICONS HERE USE TABLER DESIGN ICONS: https://tabler.io/icons
         * ========================================================================================================
         */
        $navigationsAdmin = [
            /* ---------------------------------------------------------
            *                      ADMIN PAGE
            ---------------------------------------------------------*/
            [
                'id' => 1,
                'name' => 'Dashboard',
                'page' => 'admin',
                'url' => 'dashboard',
                'slug' => 'dashboard',
                'icon' => 'tabler--dashboard',
                'order' => 1,
                'parent_id' => null,
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],

            /* 
            * ========================================================================================================
            * Settings Menu and its sub-menus
            * ========================================================================================================
            */

            [
                'id' => 500,
                'name' => 'Profil Saya',
                'page' => 'admin',
                'url' => 'profile.edit',
                'slug' => 'profile',
                'icon' => 'tabler--user',
                'order' => 500,
                'parent_id' => null,
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 501,
                'name' => 'Pengaturan',
                'page' => 'admin',
                'url' => '#',
                'slug' => 'settings',
                'icon' => 'tabler--settings',
                'order' => 501,
                'parent_id' => null,
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 502,
                'name' => 'Pengguna',
                'page' => 'admin',
                'url' => 'settings.users.index',
                'slug' => 'settings-users',
                'icon' => 'tabler--users',
                'order' => 1,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 503,
                'name' => 'Impersonate',
                'page' => 'admin',
                'url' => 'settings.impersonate.index',
                'slug' => 'settings-impersonate',
                'icon' => 'tabler--user-check',
                'order' => 2,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 504,
                'name' => 'Peran',
                'page' => 'admin',
                'url' => 'settings.roles.index',
                'slug' => 'settings-roles',
                'icon' => 'tabler--shield',
                'order' => 3,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 505,
                'name' => 'Menu',
                'page' => 'admin',
                'url' => 'settings.navs.index',
                'slug' => 'settings-navs',
                'icon' => 'tabler--category',
                'order' => 4,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 506,
                'name' => 'Preferensi',
                'page' => 'admin',
                'url' => 'settings.preferences.index',
                'slug' => 'settings-preferences',
                'icon' => 'tabler--world',
                'order' => 5,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 507,
                'name' => 'Cache Management',
                'page' => 'admin',
                'url' => 'settings.cache.index',
                'slug' => 'settings-cache',
                'icon' => 'tabler--database',
                'order' => 6,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 508,
                'name' => 'App Logs',
                'page' => 'admin',
                'url' => 'settings.apps-log.index',
                'slug' => 'settings-apps-log',
                'icon' => 'tabler--report',
                'order' => 7,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 509,
                'name' => 'Migrations Management',
                'page' => 'admin',
                'url' => 'settings.migrations.index',
                'slug' => 'settings-migrations',
                'icon' => 'tabler--database',
                'order' => 8,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 510,
                'name' => 'Seeders Management',
                'page' => 'admin',
                'url' => 'settings.seeders.index',
                'slug' => 'settings-seeders',
                'icon' => 'tabler--table-column',
                'order' => 9,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 511,
                'name' => 'Queues Management',
                'page' => 'admin',
                'url' => 'settings.queues.index',
                'slug' => 'settings-queues',
                'icon' => 'tabler--list-check',
                'order' => 10,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
            [
                'id' => 512,
                'name' => 'Schedulers Management',
                'page' => 'admin',
                'url' => 'settings.schedulers.index',
                'slug' => 'settings-schedulers',
                'icon' => 'tabler--calendar-clock',
                'order' => 11,
                'parent_id' => 501, // Nested under Settings
                'active' => true,
                'display' => true,
                'is_public' => false,
            ],
        ];

        $navigationLanding = [
            /* ---------------------------------------------------------
            *                      LANDING PAGE
            ---------------------------------------------------------*/
            /* Dashboard */
            [
                'id' => 600,
                'name' => 'Beranda',
                'page' => 'landing',
                'url' => 'beranda.index',
                'slug' => 'beranda',
                'icon' => 'tabler--smart-home',
                'order' => 600,
                'parent_id' => null,
                'active' => true,
                'display' => true,
                'is_public' => true,
            ],
        ];

        // Insert data into the 'navigations' table
        DB::table('navigations')->insert($navigationsAdmin);
        DB::table('navigations')->insert($navigationLanding);
    }
}
