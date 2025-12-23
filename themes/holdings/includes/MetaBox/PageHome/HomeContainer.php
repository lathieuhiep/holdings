<?php

namespace ResidenceTheme\MetaBox\PageHome;

use Carbon_Fields\Container;
use ResidenceTheme\MetaBox\PageHome\Tabs\AboutTab;
use ResidenceTheme\MetaBox\PageHome\Tabs\BusinessActivitiesTab;
use ResidenceTheme\MetaBox\PageHome\Tabs\CompanyScaleTab;
use ResidenceTheme\MetaBox\PageHome\Tabs\CoreValuesTab;
use ResidenceTheme\MetaBox\PageHome\Tabs\HeroTab;
use ResidenceTheme\MetaBox\PageHome\Tabs\HistoryTab;

defined('ABSPATH') || exit;

final class HomeContainer
{
    /**
     * Boot Home Page metabox
     */
    public static function boot(): void
    {
        // include tabs (dependency của Home)
        require_once __DIR__ . '/Tabs/HeroTab.php';
        require_once __DIR__ . '/Tabs/AboutTab.php';
        require_once __DIR__ . '/Tabs/CompanyScaleTab.php';
        require_once __DIR__ . '/Tabs/BusinessActivitiesTab.php';
        require_once __DIR__ . '/Tabs/HistoryTab.php';
        require_once __DIR__ . '/Tabs/CoreValuesTab.php';

        self::register();
    }

    /**
     * Register Carbon Fields container
     */
    protected static function register(): void
    {
        Container::make(
            'post_meta',
            esc_html__('Home Page Options', 'holdings')
        )
            ->where('post_type', '=', 'page')
            ->where('post_template', '=', 'templates/page-home.php')
            ->add_tab(
                esc_html__('Hero', 'holdings'),
                HeroTab::fields()
            )
            ->add_tab(
                esc_html__('Giới thiệu', 'holdings'),
                AboutTab::fields()
            )->add_tab(
                esc_html__('Quy mô', 'holdings'),
                CompanyScaleTab::fields()
            )->add_tab(
                esc_html__('Lĩnh vực hoạt động', 'holdings'),
                BusinessActivitiesTab::fields()
            )->add_tab(
                esc_html__('Lịch sử phát triển', 'holdings'),
                HistoryTab::fields()
            )->add_tab(
                esc_html__('Giá trị cột lõi', 'holdings'),
                CoreValuesTab::fields()
            );
    }
}
