<?php
/**
 * General Options
 *
 * @package ExtendSite
 */

namespace ExtendSite\Options;

use Carbon_Fields\Field;

defined('ABSPATH') || exit;

class GeneralOptions extends OptionBase
{

    private const KEY = 'es_general_option_';

    // key options
    private const LOGO = 'es_opt_logo';
    private const ENABLE_LOADING = 'es_opt_enable_loading';
    private const LOADING_IMAGE = 'es_opt_loading_image';
    private const BACK_TO_TOP = 'es_opt_back_to_top';

    private const START_YEAR = self::KEY . 'start_year';
    private const END_YEAR   = self::KEY . 'end_year';

    // option fields
    public static function fields(): array
    {
        return [
            // Logo & Branding
            Field::make('image', self::LOGO, esc_html__('Logo', 'extend-site'))
                ->set_value_type('id')
                ->set_help_text('Select your logo'),

            // Loading Screen
            Field::make(
                'html',
                'copyright_year_section'
            )->set_html(
                '<h2>' . esc_html__('Timeline Loading', 'extend-site') . '</h2>'
            ),

            Field::make(
                'text',
                self::START_YEAR,
                esc_html__('Ngày bắt đầu', 'extend-site')
            )
                ->set_attribute('type', 'number')
                ->set_attribute('min', '1900')
                ->set_attribute('max', date('Y'))
                ->set_default_value(1999),

            Field::make(
                'text',
                self::END_YEAR,
                esc_html__('Ngày kết thúc', 'extend-site')
            )
                ->set_attribute('type', 'number')
                ->set_attribute('min', '1900')
                ->set_attribute('max', date('Y') + 10)
                ->set_default_value(2026),
        ];
    }

    // get logo
    public function get_logo_id($default = null)
    {
        $id = self::get(self::LOGO);

        return $id ?: $default;
    }

    // get loading screen options
    public function get_timeline(): array
    {
        return [
            'start_year' => self::get(self::START_YEAR),
            'end_year' => self::get(self::END_YEAR),
        ];
    }
}
