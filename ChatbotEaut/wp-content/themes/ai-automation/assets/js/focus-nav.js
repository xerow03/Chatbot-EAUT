( function( window, document ) {
  function ai_automation_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const ai_automation_nav = document.querySelector( '.sidenav' );
      if ( ! ai_automation_nav || ! ai_automation_nav.classList.contains( 'open' ) ) {
        return;
      }
      const elements = [...ai_automation_nav.querySelectorAll( 'input, a, button' )],
        ai_automation_lastEl = elements[ elements.length - 1 ],
        ai_automation_firstEl = elements[0],
        ai_automation_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;
      if ( ! shiftKey && tabKey && ai_automation_lastEl === ai_automation_activeEl ) {
        e.preventDefault();
        ai_automation_firstEl.focus();
      }
      if ( shiftKey && tabKey && ai_automation_firstEl === ai_automation_activeEl ) {
        e.preventDefault();
        ai_automation_lastEl.focus();
      }
    } );
  }
  ai_automation_keepFocusInMenu();
} )( window, document );