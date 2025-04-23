( function( api ) {

	// Extends our custom "ai-automation" section.
	api.sectionConstructor['ai-automation'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );