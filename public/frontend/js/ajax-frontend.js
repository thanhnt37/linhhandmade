
$(document).on('click','#d-tra-cuu',function(e){
    e.preventDefault();
     $.magnificPopup.open({
        items: {
            src: '#modal-popup-tracuu' 
        },
        type: 'inline',
        blackbg: true,
        zoom: {
                enabled: true,
                duration: 1000 
              },
        mainClass: 'my-mfp-zoom-in',
        callbacks: {
          beforeOpen: function() {
            // $('.d-view-order').html(data.view);
          }
        }
    });   
});


