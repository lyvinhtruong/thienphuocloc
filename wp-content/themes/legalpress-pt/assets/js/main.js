// config
require.config( {
	paths: {
		jquery:              'assets/js/fix.jquery',
		underscore:          'assets/js/fix.underscore',
		bootstrapAffix:      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/affix',
		bootstrapAlert:      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/alert',
		bootstrapButton:     'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/button',
		bootstrapCarousel:   'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/carousel',
		bootstrapCollapse:   'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/collapse',
		bootstrapDropdown:   'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/dropdown',
		bootstrapModal:      'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/modal',
		bootstrapPopover:    'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/popover',
		bootstrapScrollspy:  'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/scrollspy',
		bootstrapTab:        'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/tab',
		bootstrapTooltip:    'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/tooltip',
		bootstrapTransition: 'bower_components/bootstrap-sass-official/assets/javascripts/bootstrap/transition',
	},
	shim: {
		bootstrapAffix: {
			deps: [
				'jquery'
			]
		},
		bootstrapAlert: {
			deps: [
				'jquery'
			]
		},
		bootstrapButton: {
			deps: [
				'jquery'
			]
		},
		bootstrapCarousel: {
			deps: [
				'jquery'
			]
		},
		bootstrapCollapse: {
			deps: [
				'jquery',
				'bootstrapTransition'
			]
		},
		bootstrapDropdown: {
			deps: [
				'jquery'
			]
		},
		bootstrapPopover: {
			deps: [
				'jquery'
			]
		},
		bootstrapScrollspy: {
			deps: [
				'jquery'
			]
		},
		bootstrapTab: {
			deps: [
				'jquery'
			]
		},
		bootstrapTooltip: {
			deps: [
				'jquery'
			]
		},
		bootstrapTransition: {
			deps: [
				'jquery'
			]
		},
		jqueryVimeoEmbed: {
			deps: [
				'jquery'
			]
		}
	}
} );

require.config( {
	baseUrl: LegalPressVars.pathToTheme
} );

require( [
		'jquery',
		'underscore',
		'assets/js/SimpleMap',
		'assets/js/WidgetLine',
		'bootstrapCarousel',
		'bootstrapCollapse',
		'bootstrapTooltip',
], function ( $, _, SimpleMap, WidgetLine ) {
	'use strict';

	/**
	 * Maps
	 */
	$( '.js-where-we-are' ).each( function () {
		new SimpleMap( $( this ), {
			latLng:  $( this ).data( 'latlng' ),
			markers: $( this ).data( 'markers' ),
			zoom:    $( this ).data( 'zoom' ),
			type:    $( this ).data( 'type' ),
			styles:  $( this ).data( 'style' ),
		}).renderMap();
	} );


	/**
	 * Footer widgets fix
	 */
	$( '.col-md-__col-num__' ).removeClass( 'col-md-__col-num__' ).addClass( 'col-md-3' );


	/**
	 * Widget lines, the length is relative to the amount of text
	 */
	$( '.widget-title--big .widget-title' ).each( function () {
		new WidgetLine( $( this ) );
	} );


	/**
	 * Tooltips from BS
	 */
	$( '[data-toggle="tooltip"]' ).tooltip();
} );