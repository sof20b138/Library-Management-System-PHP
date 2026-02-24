
/*=============================================================
    Authour URI: www.binarytheme.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% Free To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US
   
    ========================================================  */

(function ($) {
    "use strict";
    var mainApp = {
        slide_fun: function () {

            $('#carousel-example').carousel({
                interval:3000 // THIS TIME IS IN MILLI SECONDS
            })

        },
        dataTable_fun: function () {

            $('#dataTables-example').dataTable();

        },
       
        custom_fun:function()
        {
            /*====================================
             WRITE YOUR   SCRIPTS  BELOW
            ======================================*/




        },

    }
   
   
    $(document).ready(function () {
        mainApp.slide_fun();
        mainApp.dataTable_fun();
        mainApp.custom_fun();
    });



    $(document).ready(function() {
        // Click event for the 'Send Late Reminder' button
        $('.send-late-reminders').on('click', function() {
            var tableData = [];

            // Iterate through each row in the table body
            $('.table-issued-books tbody tr').each(function() {
                var $row = $(this);
                
                // Only process rows where the checkbox is checked
                var isChecked = $row.find('input[type="checkbox"]').is(':checked');
                
                if (isChecked) {
                    var rowObject = {
                        id:          $row.find('td:eq(1)').text().trim(),
                        studentName: $row.find('td:eq(2)').text().trim(),
                        mobileNumber: $row.find('td:eq(3)').text().trim(),
                        bookName:    $row.find('td:eq(4)').text().trim(),
                        isbn:        $row.find('td:eq(5)').text().trim(),
                        issuedDate:  $row.find('td:eq(6)').text().trim(),
                        status:      $row.find('td:eq(7)').text().trim(),
                        details:     $row.find('td:eq(8)').text().trim()
                    };

                    tableData.push(rowObject);
                }
            });
            
            // Check if any data was selected
            if (tableData.length > 0) {

                $('.send-sms-progress-bar-container').removeClass("hidden");
                $('.send-sms-progress-bar-container').addClass("show");
                $('.send-status').text("Sending....   ");

                let count = 1;
                let precentage = (100 / tableData.length);

                $.each(tableData, function(key, value) {

                    console.log(value.studentName);
                    $('.send-status').text('Sending....   (' + count + '/' + tableData.length +')');
                    $('.send-sms-progress-bar > .progress-bar').attr('aria-valuenow',Math.min(Math.max(precentage, 0), 100));
                    $('.send-sms-progress-bar > .progress-bar').attr('style', `width: ${Math.min(Math.max(precentage, 0), 100)}%;`);
                    $('.send-sms-progress-bar > .progress-bar').text( Math.min(Math.max(precentage, 0), 100) + '%');

                    precentage = precentage + precentage;
                    count++;
                })
                
                // You can now send 'tableData' to your server via $.ajax
                alert(tableData.length + " record(s) extracted. Check console for details.");
            } else {
                alert("Please select at least one row using the checkbox.");
            }
        });
    });



}(jQuery));


