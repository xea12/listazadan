<?php
session_start();
include '../../web/nazwa_strony.php';
require '../log.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <META HTTP-EQUIV="Content-Type" content="text/html; charset=utf-8, IE=edge, chrome=1">
    <link rel="stylesheet" href="jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="jqwidgets/styles/jqx.light.css" type="text/css" />
    <script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxcore.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxdata.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxbuttons.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxscrollbar.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxmenu.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxcheckbox.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxlistbox.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxgrid.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxgrid.sort.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxgrid.pager.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxgrid.selection.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxgrid.edit.js"></script>
    <script type="text/javascript" src="scripts/demos.js"></script>
    <script type="text/javascript" src="jqwidgets/a/jqxgrid.filter.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxnumberinput.js"></script>
    <script type="text/javascript" src="jqwidgets/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="jqwidgets/jqx-all.js "></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript">
        $(document).ready(function () {
            var source =
                {
                    datatype: "json",
                    cache: false,
                    datafields: [
                        { name: 'id' },
                        { name: 'n' },
                        { name: 'sort_menu' },
                        { name: 'menu_lewo' },
                        { name: 'nazwa_krotka_kat' }
                    ],
                    id: 'id',
                    url: 'data.php',
                    updaterow: function (rowid, rowdata, commit) {
                        // synchronize with the server - send update command
                        var data = "update=true&" + $.param(rowdata);
                        $.ajax({
                            dataType: 'json',
                            url: 'data.php',
                            cache: false,
                            data: data,
                            success: function (data, status, xhr) {
                                // update command is executed.
                                commit(true);
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                commit(false);
                            }
                        });
                    }

                };
            var dataAdapter = new $.jqx.dataAdapter(source);
            // initialize jqxGrid
            $("#jqxgrid").jqxGrid(
                {
                    ready: function () {
                        var symbol = $('selektor').jqxNumberInput('symbol');
                        $("#jqxgrid").jqxGrid('beginrowedit', 0);
                    },
                    width: 900,
                    height: 1200,
                    altrows: true,
                    enabletooltips: true,
                    editable: true,
                    source: dataAdapter,
                    theme: theme,
                    sortable: true,
                    sorttogglestates: 1,
                    filterable: true,
                    selectionmode: 'singlecell',
                    columns: [
                        { int: 'id', datafield: 'id', width: 40 },
                        { text: 'nazwa bez polskich',columntype: 'textbox', datafield: 'n', width: 200,
                            validation: function (cell, value) {
                                if (value.length > 50) {
                                    return { result: false, message: "Maksymalna ilość znaków to: 50" }
                                };
                                return true;
                            }

                        },
                        { text: 'Kolejność wyświetlania', datafield: 'sort_menu', width: 200,
                            cellsrenderer: function( row, datafield , value) {

                                if ( value.length > 15 ) {
                                    let cellValueContainer = "<p class='cellClass'> " + value + "</p>";
                                    return cellValueContainer;
                                }

                            }
                        },
                        { text: 'Zawartość menu lewo', datafield: 'menu_lewo', width: 200, columntype: 'dropdownlist', editable: true,
                            cellsrenderer: function( row, datafield , value) {

                                if ( value.length > 15 ) {
                                    let cellValueContainer = "<p class='cellClass'> " + value + "</p>";
                                    return cellValueContainer;
                                }

                            }
                        },
                        { text: 'Wyświetlana nazwa',columntype: 'textbox', datafield: 'nazwa_krotka_kat', width: 200,
                            validation: function (cell, value) {
                                if (value.length > 50) {
                                    return { result: false, message: "Maksymalna ilość znaków to: 50" }
                                };
                                return true;
                            }
                        },




                    ]
                });

        });
    </script>
</head>
<body class='default'>
<?php require_once "../navbar.php" ?>
<div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
    <div style="float: left;" id="jqxgrid"></div>
</div>
</body>
</html>