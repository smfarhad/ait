//Date range picker

$('#reservation').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear',
           format: 'DD-MM-YYYY'
      }
  });

$('#reservation').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
  });

$('#reservation').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
});


//**data table   **///
(function(){
  //write code here
      $('#list_data_table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "lengthMenu": [ [ 10, 50, 100, -1], [ 10, 50, 100, "All"] ]
    });
      //write code here
      $('#report_data_table').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        dom: 'Bfrtip',
        buttons: [
            'print',
            'excelHtml5',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
        ]
        //,"lengthMenu": [ [ 10, 50, 100, -1], [ 10, 50, 100, "All"] ]
    });
})();  

//** data mask **///
(function(){
    $("[data-mask]").inputmask();
    $('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
})();  

//******** Datepicker ********//
(function () {
   $('.hearingDate').datepicker({
      autoclose: true
    });

})();
    



//******** icheck ********//
//$(function () {
//    $('input').iCheck({
//        checkboxClass: 'icheckbox_square-blue',
//        radioClass: 'iradio_square-blue',
//        increaseArea: '20%' // optional
//    });
//});
$(function () {

    $('.select2').select2({
        dropdownParent: $('.branch-modal')
    });
    $('.select2m').select2();
});

//******** icheck ********//
//$(function () {
//    $('input').iCheck({
//        checkboxClass: 'icheckbox_square-blue',
//        radioClass: 'iradio_square-blue',
//        increaseArea: '20%' // optional
//    });
//});
//
//$(function () {
//    $('input.check-input').iCheck({
//        checkboxClass: 'icheckbox_square-blue',
//        radioClass: 'iradio_square-blue',
//        increaseArea: '20%' // optional
//    });
//});
  //iCheck for checkbox and radio inputs
//    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
//      checkboxClass: 'icheckbox_minimal-blue',
//      radioClass   : 'iradio_minimal-blue'
//    })





//head ajax
$(function () {
   $('form#headmodal-form').on('submit', function (e) {
        var $this = $(this);
        e.preventDefault();
        $.ajax({
            // Your server script to process the upload
            url: $(this).attr('action'),
            type: 'POST',
            // Form data
            data: new FormData($(this)[0]),

            // Tell jQuery not to process data or worry about content-type
            // You *must* include these options!
            cache: false,
            contentType: false,
            processData: false,

            // Custom XMLHttpRequest
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    // For handling the progress of the upload
                    myXhr.upload.addEventListener('progress', function (e) {
                        $('div#site-message').show().delay(5000).queue(function (next) {
                            $(this).hide();
                            next();
                        });
                        $('.submit-message').text('Head Added Successfully')
                        $('form#headmodal-form button[type=submit]').hide();
                                                              
                        $('.tax-head-modal').on('hidden.bs.modal', function () {
                          window.location.href = '/admin/ait/create';
                        });
                       
                    }, false);
                }
                return myXhr;
            },
        });
    });
});

//bank ajax
$(function () {
   $('form#bank-form').on('submit', function (e) {
       // e.preventDefault();
        $.ajax({
            // Your server script to process the upload
            url: $(this).attr('action'),
            type: 'POST',
            // Form data
            data: new FormData($(this)[0]),

            // Tell jQuery not to process data or worry about content-type
            // You *must* include these options!
            cache: false,
            contentType: false,
            processData: false,

            // Custom XMLHttpRequest
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    // For handling the progress of the upload
                    myXhr.upload.addEventListener('progress', function (e) {
                        $('div#site-message').show().delay(5000).queue(function (next) {
                            $(this).hide();
                            next();
                        });
                          $('.submit-message').text('Bank Added Successfully')
                          $('form#bank-form button[type=submit]').hide();
                        $('.bank-modal').on('hidden.bs.modal', function () {
                          window.location.href = '/admin/ait/create';
                        });
                       
                    }, false);
                }
                return myXhr;
            },
        });
    });
});

//branch ajax
$(function () {
   $('form#branch-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            // Your server script to process the upload
            url: $(this).attr('action'),
            type: 'POST',
            // Form data
            data: new FormData($(this)[0]),

            // Tell jQuery not to process data or worry about content-type
            // You *must* include these options!
            cache: false,
            contentType: false,
            processData: false,

            // Custom XMLHttpRequest
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) {
                    // For handling the progress of the upload
                    myXhr.upload.addEventListener('progress', function (e) {
                        $('div#site-message').show().delay(5000).queue(function (next) {
                            $(this).hide();
                            next();
                        });
                        $('.submit-message').text('Branch Added Successfully')
                        $('form#branch-form button[type=submit]').hide();
                        $('.branch-modal').on('hidden.bs.modal', function () {
                          window.location.href = '/admin/ait/create';
                        });
                       
                    }, false);
                }
                return myXhr;
            },
        });
    });
});

//hjide branch
$(function () {
    $('select#bank').on('select2:select', function(){
        var bank = $(this).val();
        var branch_list = $('select#branch option'); 
        branch_list.each(function() {
            console.log($(this).data('bank'));
            if($(this).data('bank') == bank){
                $(this).show();
            } else {
                $(this).hide();
            }       
        });
    });
});
