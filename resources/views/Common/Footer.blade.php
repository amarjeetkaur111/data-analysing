<!-- Footer -->
  <!-- Footer -->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
  <!-- Sweet Alert scripts -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- DataTables  -->
  <script type="text/javascript" src="{{ asset('assets/js/addons/datatables.min.js') }}"></script>
  <!-- DataTables Select  -->
  <script type="text/javascript" src="{{ asset('assets/js/addons/datatables-select.min.js') }}"></script>  
  <!-- Initializations -->
  <script>
    // SideNav Initialization
    $(".button-collapse").sideNav();

    var container = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(container, {
      wheelSpeed: 2,
      wheelPropagation: true,
      minScrollbarLength: 20
    });

    // Tooltips Initialization
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

  </script>

</body>

</html>
