<?php
if ( function_exists( 'acf_add_local_field_group' ) ) {

    acf_add_local_field_group(
        array(
            'key'                   => 'group_layouts_configuration',
            'title'                 => __( 'Configuration - Layouts', 'pip-addon' ),
            'fields'                => array(
                array(
                    'key'               => 'field_background_tab',
                    'label'             => __( 'Fond', 'pip-addon' ),
                    'name'              => '',
                    'type'              => 'tab',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'acfe_permissions'  => '',
                    'placement'         => 'top',
                    'endpoint'          => 0,
                    'acfe_form'         => true,
                ),
                array(
                    'key'                => 'field_bg_color',
                    'label'              => __( 'Couleur de fond', 'pip-addon' ),
                    'name'               => 'bg_color',
                    'type'               => 'pip_font_color',
                    'instructions'       => '',
                    'required'           => 0,
                    'conditional_logic'  => 0,
                    'wrapper'            => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'acfe_save_meta'     => 0,
                    'acfe_permissions'   => '',
                    'field_type'         => 'select',
                    'multiple'           => 0,
                    'ui'                 => 0,
                    'class_output'       => 'background',
                    'show_add_to_editor' => 1,
                    'acfe_settings'      => '',
                    'acfe_validate'      => '',
                    'choices'            => array(),
                    'placeholder'        => '',
                    'return_format'      => 'value',
                    'allow_null'         => true,
                    'other_choice'       => 0,
                    'allow_custom'       => 0,
                    'ajax'               => false,
                    'acfe_form'          => true,
                ),
                array(
                    'key'               => 'field_spacing_tab',
                    'label'             => __( 'Espacement', 'pip-addon' ),
                    'name'              => '',
                    'type'              => 'tab',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'acfe_permissions'  => '',
                    'placement'         => 'top',
                    'endpoint'          => 0,
                    'acfe_form'         => true,
                ),
                array(
                    'key'               => 'field_vertical_spacing',
                    'label'             => __( 'Espacement vertical', 'pip-addon' ),
                    'name'              => 'vertical_space',
                    'type'              => 'select',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'acfe_permissions'  => '',
                    'choices'           => array(
                        'py-0'  => __( 'Aucun', 'pip-addon' ),
                        'py-4'  => __( 'Petit', 'pip-addon' ),
                        'py-8'  => __( 'Moyen', 'pip-addon' ),
                        'py-16' => __( 'Moyen grand', 'pip-addon' ),
                        'py-32' => __( 'Grand', 'pip-addon' ),
                    ),
                    'default_value'     => 'py-16',
                    'allow_null'        => 0,
                    'multiple'          => 0,
                    'ui'                => 0,
                    'return_format'     => 'value',
                    'acfe_settings'     => '',
                    'acfe_validate'     => '',
                    'ajax'              => 0,
                    'placeholder'       => '',
                    'acfe_form'         => true,
                ),
                array(
                    'key'               => 'field_anchor_tab',
                    'label'             => __( 'Ancre', 'pip-addon' ),
                    'name'              => '',
                    'type'              => 'tab',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'acfe_permissions'  => '',
                    'placement'         => 'top',
                    'endpoint'          => 0,
                    'acfe_form'         => true,
                ),
                array(
                    'key'               => 'field_section_id',
                    'label'             => __( 'ID', 'pip-addon' ),
                    'name'              => 'section_id',
                    'type'              => 'text',
                    'instructions'      => '',
                    'required'          => 0,
                    'conditional_logic' => 0,
                    'wrapper'           => array(
                        'width' => '',
                        'class' => '',
                        'id'    => '',
                    ),
                    'acfe_permissions'  => '',
                    'default_value'     => '',
                    'placeholder'       => '',
                    'prepend'           => '',
                    'append'            => '',
                    'maxlength'         => '',
                    'acfe_settings'     => '',
                    'acfe_validate'     => '',
                    'acfe_form'         => true,
                ),
            ),
            'location'              => array(
                array(
                    array(
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'all',
                    ),
                ),
            ),
            'menu_order'            => 0,
            'position'              => 'normal',
            'style'                 => 'default',
            'label_placement'       => 'left',
            'instruction_placement' => 'label',
            'hide_on_screen'        => '',
            'active'                => false,
            'description'           => '',
            'acfe_display_title'    => '',
            'acfe_autosync'         => array(
                0 => 'json',
            ),
            'acfe_permissions'      => '',
            'acfe_form'             => 1,
            'acfe_meta'             => '',
            'acfe_note'             => '',
            'acfe_categories'       => array(
                'pilopress' => "Pilo'Press",
            ),
        )
    );

}
