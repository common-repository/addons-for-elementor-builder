<?php

namespace AFEB;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * "Vertex Addons for Elementor" General Form Class
 * 
 * @class Form
 * @version 1.0.7
 */
class Form extends Base
{
    /**
     * Displays the input form field
     * 
     * @since 1.0.7
     * 
     * @param array $atts
     * @param string $text
     */
    public static function input($atts = [], $text = '')
    {
        $atts_render = $data = '';
        $default_atts = ['type' => 'text'];
        $atts = wp_parse_args($atts, $default_atts);
        $input = "<#tag# #attributes# #data# >";
        $tag = 'input';

        foreach ($atts as $attr_key => $attr_value) {
            if (is_array($attr_value) && count($attr_value)) {
                $attr_key = strtoupper($attr_key);

                if ($attr_key == 'DATA')
                    foreach ($attr_value as $data_key => $data_value)
                        $data .= sprintf(' data-%s="%s"', strtolower(str_replace('_', '-', $data_key)), esc_attr($data_value));

                continue;
            }

            $atts_render .= sprintf(' %s="%s"', strtolower(str_replace('_', '-', $attr_key)), esc_attr($attr_value));
        }

        if ($atts['type'] == 'textarea') {
            $tag = 'textarea';
            $input .= isset($text) ? $text : '';
            $input .= '</#tag#>';
        }

        $input = str_replace('#tag#', $tag, $input);
        $input = str_replace('#attributes#', $atts_render, $input);
        $input = str_replace('#data#', $data, $input);

        return $input;
    }

    /**
     * Displays the select form field
     * 
     * @since 1.0.7
     * 
     * @param array $atts
     * @param array $options
     */
    public static function select($atts = [], $options = [])
    {
        $atts_render = $options_render = $data = '';
        $select = '<select #attributes# #data#>#options#</select>';

        foreach ($atts as $attr_key => $attr_value) {
            if (is_array($attr_value) && count($attr_value)) {
                $attr_key = strtoupper($attr_key);

                if ($attr_key == 'DATA') {
                    foreach ($attr_value as $data_key => $data_value) {
                        $data .= sprintf(' data-%s="%s"', strtolower(str_replace('_', '-', $data_key)), esc_attr($data_value));
                    }
                }
                continue;
            }

            $atts_render .= sprintf(' %s="%s"', strtolower(str_replace('_', '-', $attr_key)), esc_attr($attr_value));
        }

        if (is_array($options) && count($options)) {
            $option_atts_render = '';
            $default_options = [
                'values' => '',
                'selected' => 'none',
            ];
            $options = wp_parse_args($options, $default_options);

            foreach ($options['values'] as $option_key => $option_value) {
                $option_key = trim($option_key);
                if (isset($options[$option_key]) && is_array($options[$option_key])) {
                    foreach ($options[$option_key] as $option_attr_key => $option_attr_value) {
                        $option_atts_render .= sprintf(' %s="%s"', strtolower(str_replace('_', '-', $option_attr_key)), esc_attr($option_attr_value));
                    }
                }

                $options_render .= sprintf('<option %s value="%s" %s>%s</option>', $option_atts_render, esc_attr($option_key), selected(trim($options['selected']), $option_key, false), $option_value);
                $option_atts_render = '';
            }
        }

        $select = str_replace('#attributes#', $atts_render, $select);
        $select = str_replace('#data#', $data, $select);
        $select = str_replace('#options#', $options_render, $select);

        return $select;
    }

    /**
     * Displays the icon picker form field
     * 
     * @since 1.0.7
     * 
     * @param array $args
     * 
     * @return string
     */
    public static function iconpicker($args = [])
    {
        if (!count($args)) return false;
        $cin = 'afeb-iconpicker';
        return self::select(
            ['id' => !empty($args['id']) ? $args['id'] : $cin, 'class' => !empty($args['class']) ? $args['class'] : $cin, 'name' => !empty($args['name']) ? $args['name'] : $cin,],
            ['values' => STRS::get_font_icons(), 'selected' => !empty($args['value']) ? $args['value'] : '']
        );
    }

    /**
     * Displays the color picker form field
     * 
     * @since 1.0.7
     * 
     * @param array $args
     * 
     * @return string
     */
    public static function colorpicker($args)
    {
        if (!count($args)) return false;
        $cin = 'afeb-colorpicker';
        return self::input([
            'id' => !empty($args['id']) ? $args['id'] : $cin,
            'class' => !empty($args['class']) ? $args['class'] : $cin,
            'name' => !empty($args['name']) ? $args['name'] : $cin,
            'value' => !empty($args['value']) ? $args['value'] : '',
            'data' => ['default-color' => !empty($args['default']) ? $args['default'] : '']
        ]);
    }
}
