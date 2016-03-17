<?php

/**
 * @class FLIconModule
 */
class FLIconModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Icon', 'fl-builder'),
			'description'   	=> __('Display an icon and optional title.', 'fl-builder'),
			'category'      	=> __('Advanced Modules', 'fl-builder'),
			'editor_export' 	=> false,
			'partial_refresh'	=> true
		));
	}

	/**
	 * @method render_image
	 */
	public function render_image()
	{
		if($this->settings->image_type == 'photo') {

			if(empty($this->settings->photo)) {
				return;
			}

			$photo_data = FLBuilderPhoto::get_attachment_data($this->settings->photo);

			if(!$photo_data) {
				$photo_data = $this->settings->photo_data;
			}

			$photo_settings = array(
				'align'         => 'center',
				'crop'          => $this->settings->photo_crop,
				'link_target'   => $this->settings->link_target,
				'link_type'     => 'url',
				'link_url'      => $this->settings->link,
				'photo'         => $photo_data,
				'photo_src'     => $this->settings->photo_src,
				'photo_source'  => 'library'
			);

			FLBuilder::render_module_html('photo', $photo_settings);
		}
		else if($this->settings->image_type == 'icon') {

			echo '<i class="'. $this->settings->icon .'"></i>';
		}
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLIconModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'fl-builder'), // Tab title
		'sections'      => array( // Tab Sections
			'general'       => array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'image_type'    => array(
						'type'          => 'select',
						'label'         => __('Image Type', 'fl-builder'),
						'default'       => 'icon',
						'options'       => array(
							'photo'         => __('Photo', 'fl-builder'),
							'icon'          => __('Icon', 'fl-builder')
						),
						'toggle'        => array(
							'photo'         => array(
								'sections'      => array('photo')
							),
							'icon'          => array(
								'sections'      => array('icon', 'icon_colors', 'icon_structure')
							)
						)
					)
				)
			),
			'photo'         => array(
				'title'         => __('Photo', 'fl-builder'),
				'fields'        => array(
					'photo'         => array(
						'type'          => 'photo',
						'label'         => __('Photo', 'fl-builder')
					),
					'photo_crop'    => array(
						'type'          => 'select',
						'label'         => __('Crop', 'fl-builder'),
						'default'       => '',
						'options'       => array(
							''              => _x( 'None', 'Photo Crop.', 'fl-builder' ),
							'landscape'     => __('Landscape', 'fl-builder'),
							'panorama'      => __('Panorama', 'fl-builder'),
							'portrait'      => __('Portrait', 'fl-builder'),
							'square'        => __('Square', 'fl-builder'),
							'circle'        => __('Circle', 'fl-builder')
						)
					)
				)
			),
			'icon'          => array(
				'title'         => __('Icon', 'fl-builder'),
				'fields'        => array(
					'icon'          => array(
						'type'          => 'icon',
						'label'         => __('Icon', 'fl-builder')
					)
				)
			),
			'link'          => array(
				'title'         => 'Link',
				'fields'        => array(
					'link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'fl-builder'),
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'link_target'   => array(
						'type'          => 'select',
						'label'         => __('Link Target', 'fl-builder'),
						'default'       => '_self',
						'options'       => array(
							'_self'         => __('Same Window', 'fl-builder'),
							'_blank'        => __('New Window', 'fl-builder')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					)
				)
			),
			'text'          => array(
				'title'         => 'Text',
				'fields'        => array(
					'text'          => array(
						'type'          => 'editor',
						'label'         => '',
						'media_buttons' => false
					)
				)
			)
		)
	),
	'style'         => array( // Tab
		'title'         => __('Style', 'fl-builder'), // Tab title
		'sections'      => array( // Tab Sections
			'colors'        => array( // Section
				'title'         => __('Colors', 'fl-builder'), // Section Title
				'fields'        => array( // Section Fields
					'color'         => array(
						'type'          => 'color',
						'label'         => __('Color', 'fl-builder'),
						'show_reset'    => true
					),
					'hover_color' => array(
						'type'          => 'color',
						'label'         => __('Hover Color', 'fl-builder'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'bg_color'      => array(
						'type'          => 'color',
						'label'         => __('Background Color', 'fl-builder'),
						'show_reset'    => true
					),
					'bg_hover_color' => array(
						'type'          => 'color',
						'label'         => __('Background Hover Color', 'fl-builder'),
						'show_reset'    => true,
						'preview'       => array(
							'type'          => 'none'
						)
					),
					'three_d'       => array(
						'type'          => 'select',
						'label'         => __('Gradient', 'fl-builder'),
						'default'       => '0',
						'options'       => array(
							'0'             => __('No', 'fl-builder'),
							'1'             => __('Yes', 'fl-builder')
						)
					)
				)
			),
			'structure'     => array( // Section
				'title'         => __('Structure', 'fl-builder'), // Section Title
				'fields'        => array( // Section Fields
					'size'          => array(
						'type'          => 'text',
						'label'         => __('Size', 'fl-builder'),
						'default'       => '30',
						'maxlength'     => '3',
						'size'          => '4',
						'description'   => 'px'
					),
					'align'         => array(
						'type'          => 'select',
						'label'         => __('Alignment', 'fl-builder'),
						'default'       => 'left',
						'options'       => array(
							'center'        => __('Center', 'fl-builder'),
							'left'          => __('Left', 'fl-builder'),
							'right'         => __('Right', 'fl-builder')
						)
					)
				)
			)
		)
	)
));