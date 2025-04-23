( function( jQuery ){
 jQuery( document ).on( 'click', '.notice-get-started-class .notice-dismiss', function () {
        var type = jQuery( this ).closest( '.notice-get-started-class' ).data( 'notice' );
        jQuery.ajax( ajaxurl,
          {
            type: 'POST',
            data: {
              action: 'ai_automation_dismissed_notice_handler',
              type: type,
              wpnonce: ai_automation.wpnonce
            }
          } );
      } );
}( jQuery ) )