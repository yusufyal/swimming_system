// npm package: datatables.net-bs5
// github link: https://github.com/DataTables/Dist-DataTables-Bootstrap5

$(function () {
  'use strict';

  $(function () {
    $('#dataTableExample').DataTable({
      "aLengthMenu": [
        [10, 30, 50, -1],
        [10, 30, 50, "All"]
      ],
      "iDisplayLength": 10,
      "language": {
        search: ""
      }
    });
    $('#dataTableExample').each(function () {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
  });



  // Initialize DataTable for #dataTableExample1
  var datatable = $('#datatablestudent').DataTable({
    "aLengthMenu": [
      [10, 30, 50, -1],
      [10, 30, 50, "All"]
    ],
    "iDisplayLength": 10,
    "language": {
      search: "" // This will still hide the search functionality
    }
  });

  // Apply customizations for length control for #dataTableExample1
  $('#datatablestudent').each(function () {
    var datatable = $(this);
    // HIDE the search input by targeting the filter container and setting display to none
    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter]');
    search_input.hide();  // This will remove the search bar but keep pagination intact

    // LENGTH - Inline form control
    var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
    length_sel.removeClass('form-control-sm');
  });



  // Initialize DataTable for #dataTableExample1
  var datatable = $('#datatableinstructor').DataTable({
    "aLengthMenu": [
      [10, 30, 50, -1],
      [10, 30, 50, "All"]
    ],
    "iDisplayLength": 10,
    "language": {
      search: "" // This will still hide the search functionality
    }
  });

  // Apply customizations for length control for #dataTableExample1
  $('#datatableinstructor').each(function () {
    var datatable = $(this);
    // HIDE the search input by targeting the filter container and setting display to none
    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter]');
    search_input.hide();  // This will remove the search bar but keep pagination intact

    // LENGTH - Inline form control
    var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
    length_sel.removeClass('form-control-sm');
  });



  // Initialize DataTable for #dataTableExample1
  var datatable = $('#datatablelevel').DataTable({
    "aLengthMenu": [
      [10, 30, 50, -1],
      [10, 30, 50, "All"]
    ],
    "iDisplayLength": 10,
    "language": {
      search: "" // This will still hide the search functionality
    }
  });

  // Apply customizations for length control for #dataTableExample1
  $('#datatablelevel').each(function () {
    var datatable = $(this);
    // HIDE the search input by targeting the filter container and setting display to none
    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter]');
    search_input.hide();  // This will remove the search bar but keep pagination intact

    // LENGTH - Inline form control
    var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
    length_sel.removeClass('form-control-sm');
  });



  // Initialize DataTable for #dataTableExample1
  var datatable = $('#datatableclass').DataTable({
    "aLengthMenu": [
      [10, 30, 50, -1],
      [10, 30, 50, "All"]
    ],
    "iDisplayLength": 10,
    "language": {
      search: "" // This will still hide the search functionality
    }
  });

  // Apply customizations for length control for #dataTableExample1
  $('#datatableclass').each(function () {
    var datatable = $(this);
    // HIDE the search input by targeting the filter container and setting display to none
    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter]');
    search_input.hide();  // This will remove the search bar but keep pagination intact

    // LENGTH - Inline form control
    var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
    length_sel.removeClass('form-control-sm');
  });

  // Initialize DataTable for #dataTableExample1
  var datatable = $('#datatableattendance').DataTable({
    "aLengthMenu": [
      [10, 30, 50, -1],
      [10, 30, 50, "All"]
    ],
    "iDisplayLength": 10,
    "language": {
      search: "" // This will still hide the search functionality
    }
  });

  // Apply customizations for length control for #dataTableExample1
  $('#datatableattendance').each(function () {
    var datatable = $(this);
    // HIDE the search input by targeting the filter container and setting display to none
    var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter]');
    search_input.hide();  // This will remove the search bar but keep pagination intact

    // LENGTH - Inline form control
    var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
    length_sel.removeClass('form-control-sm');
  });


});