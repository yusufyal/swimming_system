$(function () {
  // Function to display the SweetAlert confirmation
  window.confirmDelete = function (id) {
    'use strict';

    // Trigger the SweetAlert2 confirmation
    Swal.fire({
      title: '<p style="color:#FFC107">Are you sure you want to delete ?</p>',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#FFC107',
      confirmButtonColor: 'red',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        // If confirmed, submit the form
        $('#delete-form-' + id).submit();
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        // If cancelled, show cancellation message
        Swal.fire({
          title:'Cancelled',
          text:'The record was not deleted.',
           icon:'error',
           confirmButtonColor: "#DD6B55",
         
      });
      }
    });
  };




});
