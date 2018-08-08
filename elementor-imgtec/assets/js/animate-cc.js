( function( $ ) {
	var WidgetAnimateCCHandler = function( $scope, $ ) {
		console.log( $scope );
	};

	// Make sure you run this code under Elementor..
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/animate-cc.default', WidgetAnimateCCHandler );
	} );
} )( jQuery );
