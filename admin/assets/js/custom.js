
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
                interval: 3000 // THIS TIME IS IN MILLI SECONDS
            })

        },
        dataTable_fun: function () {

            $('#dataTables-example').dataTable();

        },

        custom_fun: function () {
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


    // 'Send Late Reminder' button function
    $(document).ready(function () {
        // Click event for the 'Send Late Reminder' button
        $('.send-late-reminders').on('click', function () {
            var tableData = [];

            // Iterate through each row in the table body
            $('.table-issued-books tbody tr').each(function () {
                var $row = $(this);

                // Only process rows where the checkbox is checked
                var isChecked = $row.find('input[type="checkbox"]').is(':checked');

                if (isChecked) {
                    var rowObject = {
                        id: $row.find('td:eq(1)').text().trim(),
                        studentName: $row.find('td:eq(2)').text().trim(),
                        mobileNumber: $row.find('td:eq(3)').text().trim(),
                        bookName: $row.find('td:eq(4)').text().trim(),
                        isbn: $row.find('td:eq(5)').text().trim(),
                        issuedDate: $row.find('td:eq(6)').text().trim(),
                        status: $row.find('td:eq(7)').text().trim(),
                        details: $row.find('td:eq(8)').text().trim()
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


                // 1. Helper function for the 5-second pause
                const sleep = (ms) => new Promise(resolve => setTimeout(resolve, ms));

                // 2. Wrap your logic in an ASYNC function
                async function sendBulkSms(tableData) {
                    let count = 1;
                    let percentageStep = 100 / tableData.length;

                    for (let i = 0; i < tableData.length; i++) {
                        let value = tableData[i];

                        // Prepare your message
                        let detailsArray = value.details.split('!');
                        let message = "Hi " + value.studentName + ",\n\nThe book " + value.bookName + " is now " + detailsArray[0] + "!\n" + detailsArray[1] + ". \n\nPlease return it to the MOHA Library soon!";

                        // 3. Use 'await' with $.ajax wrapped in a promise
                        await $.ajax({
                            url: 'api/send_sms.php',
                            type: 'POST',
                            data: {
                                destination: value.mobileNumber,
                                message: message
                            },
                            timeout: 9000,
                            headers: { 'X-Requested-With': 'XMLHttpRequest' },
                            success: function (response) {
                                console.log('Success for ' + value.studentName);

                                // Update Progress Bar
                                let currentProgress = Math.round(percentageStep * count);
                                $('.send-status').text('Sending.... (' + count + '/' + tableData.length + ')');
                                $('.send-sms-progress-bar > .progress-bar')
                                    .css('width', currentProgress + '%')
                                    .attr('aria-valuenow', currentProgress)
                                    .text(currentProgress + '%');

                                count++;
                            },
                            error: function (jqXHR, textStatus) {
                                console.error('Failed for ' + value.studentName + ': ' + textStatus);
                            },
                        });

                        // 4. THE 5 SECOND GAP (Wait after each SMS)
                        if (i < tableData.length - 1) {
                            console.log("Waiting 0.1 seconds before next SMS...");
                            await sleep(100);
                        }
                    }

                    // 5. Final completion logic (Only runs AFTER the loop is totally done)
                    console.log('All SMS sent. Cleaning up...');
                    $('.send-status').text('Success....!');
                    setTimeout(function () {
                        $('.send-sms-progress-bar-container').addClass("hidden");
                        location.reload();
                    }, 2500);
                }

                // 6. Call the function
                sendBulkSms(tableData);

            } else {
                alert("Please select at least one row using the checkbox.");
            }
        });
    });



}(jQuery));


