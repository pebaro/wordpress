( function( $ ) {
	var WidgetSimpleModalHandler = function( $scope, $ ) {
		console.log( $scope );
	};

	// Make sure you run this code under Elementor..
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/simple-modal.default', WidgetSimpleModalHandler );
	} );

	// Open Modal
	$('[data-modal-open]').on('click', function( e )  {
		var open_modal = $(this).attr('data-modal-open');
		$('[data-modal="' + open_modal + '"]').fadeIn(350);

		e.preventDefault();
	});
	// Close Modal
	$('[data-modal-close]').on('click', function( e )  {
		var close_modal = $(this).attr('data-modal-close');
		$('[data-modal="' + close_modal + '"]').fadeOut(350);

		e.preventDefault();
	});
} )( jQuery );
