<script>
    var resizefunc = [];
</script>
<script>
    var base_url = "<?php echo base_url(); ?>";
</script>

<!-- jQuery  -->
<script src="<?= base_url('assets') ?>/assets/js/jquery.min.js"></script>
<script src="<?= base_url('assets') ?>/assets/js/bootstrap.min.js"></script>
<script src="<?= base_url('assets') ?>/assets/js/detect.js"></script>
<script src="<?= base_url('assets') ?>/assets/js/fastclick.js"></script>
<script src="<?= base_url('assets') ?>/assets/js/jquery.blockUI.js"></script>
<script src="<?= base_url('assets') ?>/assets/js/waves.js"></script>
<script src="<?= base_url('assets') ?>/assets/js/jquery.slimscroll.js"></script>
<script src="<?= base_url('assets') ?>/assets/js/jquery.scrollTo.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/switchery/switchery.min.js"></script>

<!-- Counter js  -->
<script src="<?= base_url('assets') ?>/plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/counterup/jquery.counterup.min.js"></script>

<!-- Flot chart js -->
<script src="<?= base_url('assets') ?>/plugins/flot-chart/jquery.flot.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/flot-chart/jquery.flot.time.js"></script>
<script src="<?= base_url('assets') ?>/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/flot-chart/jquery.flot.resize.js"></script>
<script src="<?= base_url('assets') ?>/plugins/flot-chart/jquery.flot.pie.js"></script>
<script src="<?= base_url('assets') ?>/plugins/flot-chart/jquery.flot.selection.js"></script>
<script src="<?= base_url('assets') ?>/plugins/flot-chart/jquery.flot.crosshair.js"></script>

<script src="<?= base_url('assets') ?>/plugins/moment/moment.js"></script>
<script src="<?= base_url('assets') ?>/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- page specific js -->
<script src="<?= base_url('assets') ?>/assets/pages/jquery.fileuploads.init.js"></script>

<!-- Jquery filer js -->
<script src="<?= base_url('assets') ?>/plugins/jquery.filer/js/jquery.filer.min.js"></script>


<script src=<?= empty($js) ? '' : base_url($js) ?>></script>


<!-- bootstrap select -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>

<script src="<?= base_url('assets') ?>/plugins/multiselect/js/jquery.multi-select.js"></script>


<!-- Dashboard init -->
<script src="<?= base_url('assets') ?>/assets/pages/jquery.dashboard_2.js"></script>

<!-- App js -->
<script src="<?= base_url('assets') ?>/assets/js/jquery.core.js"></script>
<script src="<?= base_url('assets') ?>/assets/js/jquery.app.js"></script>
<!-- Toastr js -->
<script src="<?= base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>

<!-- datatables js -->
<script src="<?= base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.bootstrap.js"></script>

<script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/jszip.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/pdfmake.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/vfs_fonts.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/buttons.print.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.colVis.js"></script>
<script src="<?= base_url('assets') ?>/plugins/datatables/dataTables.fixedColumns.min.js"></script>

<!-- init -->
<script src="<?= base_url('assets') ?>/assets/pages/jquery.datatables.init.js"></script>

<!-- Sweet-Alert  -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets') ?>/plugins/sweetalert2/dist/sweetalert2.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script> -->

<script src="<?= base_url() ?>/assets/assets/js/js/swal.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
            keys: true
        });
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });
        $('#datatable-scroller').DataTable({
            ajax: "../plugins/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });
        var table = $('#datatable-fixed-col').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
    });
    TableManageButtons.init();
</script>

<script>
    $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    $('#reportrange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2016',
        dateLimit: {
            days: 60
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-success',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
</script>

</body>

</html>