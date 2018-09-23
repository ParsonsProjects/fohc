<?php

	$options[] = array(
		'name' => __('Training Times', 'options_framework_theme'),
		'type' => 'heading');

		$options[] = array(
			'name' => __('Monday', 'options_framework_theme'),
			'desc' => __('Training times for Monday', 'options_framework_theme'),
			'id' => 'monday_training',
			'type' => 'editor',
			'settings' => $wp_editor_settings );

		$options[] = array(
			'name' => __('Tuesday', 'options_framework_theme'),
			'desc' => __('Training times for Tuesday', 'options_framework_theme'),
			'id' => 'tuesday_training',
			'type' => 'editor',
			'settings' => $wp_editor_settings );

		$options[] = array(
			'name' => __('Wednesday', 'options_framework_theme'),
			'desc' => __('Training times for Wednesday', 'options_framework_theme'),
			'id' => 'wednesday_training',
			'type' => 'editor',
			'settings' => $wp_editor_settings );

		$options[] = array(
			'name' => __('Thursday', 'options_framework_theme'),
			'desc' => __('Training times for Thursday', 'options_framework_theme'),
			'id' => 'thursday_training',
			'type' => 'editor',
			'settings' => $wp_editor_settings );

		$options[] = array(
			'name' => __('Friday', 'options_framework_theme'),
			'desc' => __('Training times for Friday', 'options_framework_theme'),
			'id' => 'friday_training',
			'type' => 'editor',
			'settings' => $wp_editor_settings );

		$options[] = array(
			'name' => __('Saturday', 'options_framework_theme'),
			'desc' => __('Training times for Saturday', 'options_framework_theme'),
			'id' => 'saturday_training',
			'type' => 'editor',
			'settings' => $wp_editor_settings );

		$options[] = array(
			'name' => __('Sunday', 'options_framework_theme'),
			'desc' => __('Training times for Sunday', 'options_framework_theme'),
			'id' => 'sunday_training',
			'type' => 'editor',
			'settings' => $wp_editor_settings );
?>