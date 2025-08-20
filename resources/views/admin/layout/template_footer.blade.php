	    
      <footer class="main-footer">
	        <div class="pull-right hidden-xs">
	          <b>Powered by</b> <a href="http://wanitbd.com/">WAN IT</a>
	        </div>
	        <strong>Copyright &copy; <?= date('Y'); ?> <a href="http://khyaerinternational.com/">Khayer International</a>.</strong> All rights reserved.
	    </footer>

	      <!-- Add the sidebar's background. This div must be placed
	           immediately after the control sidebar -->
	    <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('admin/backend/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Bootstrap 5 -->
     <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> -->
    <!-- SlimScroll -->
    <script src="{{ asset('admin/backend/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/backend/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/backend/dist/js/app.min.js') }}"></script>
    <!-- AdminLTE for datepicker purposes -->
    <script src="{{ asset('admin/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('admin/backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- notification -->
    <script src="{{ asset('admin/js/jquery.toaster.js') }}"></script>
    <!-- cusotm function -->
    <script src="{{ asset('admin/js/function.js') }}"></script>

    <script type="text/javascript">
      $('.datepicker').datepicker({
          autoclose: true,
          weekStart: 6,
          todayHighlight: true,
          todayBtn: "linked",
          format : 'yyyy-mm-dd'
      });

      $(function () {
        if($("#members_list_table").length>0){
            $("#members_list_table").DataTable();
        }
      });
    </script>
  </body>
</html>
