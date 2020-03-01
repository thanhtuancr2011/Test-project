<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

        <style>
            td.details-control {
                background: url('/details_open.png') no-repeat center center;
                cursor: pointer;
            }
            tr.shown td.details-control {
                background: url('/details_close.png') no-repeat center center;
            }
        </style>

    </head>
    <body>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>PackageId</th>
                    <th>Tracking Number</th>
                    <th>Date Received</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>PackageId</th>
                    <th>Tracking Number</th>
                    <th>Date Received</th>
                </tr>
            </tfoot>
        </table>
    </body>

    <script type="text/javascript">
        /* Formatting function for row details - modify as you need */
        function format ( d ) {

            let packageDetails = d.package_details;

            let html =
                '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<thead>' +
                    '<tr>' +
                        '<th></th>' +
                        '<th>Name</th>' +
                        '<th>Price</th>' +
                        '<th>Quantity</th>' +
                        '<th>Weight</th>' +
                    '</tr>' +
                '</thead>' +
                '<tbody>';
            packageDetails.map(dt => {
                html +=
                    `<tr>` +
                        `<td>${dt.id}</td>` +
                        `<td>${dt.name}</td>`+
                        `<td>${dt.price}</td>`+
                        `<td>${dt.qty}</td>`+
                        `<td>${dt.weight}</td>`+
                    `</tr>`
            });

            html += '<tbody></table>';

            // `d` is the original data object for the row
            return html;
        }

        $(document).ready(function() {
            var table = $('#example').DataTable( {
                "ajax": "/api/package",
                "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "name" },
                    { "data": "package_id" },
                    { "data": "tracking_number" },
                    { "data": "date_received" }
                ],
                "order": [[1, 'asc']]
            } );

            // Add event listener for opening and closing details
            $('#example tbody').on('click', 'td.details-control', function () {

                var tr = $(this).closest('tr');
                var row = table.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data(), table) ).show();
                    tr.addClass('shown');
                }
            });
        });
    </script>
</html>
