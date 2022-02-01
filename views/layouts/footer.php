<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var elemenSideNavigation = document.querySelectorAll('.sidenav');
      var instancesNavigation = M.Sidenav.init(elemenSideNavigation, {
        draggable: true,
        inDuration: 500,
        outDuration: 500
      });
      var elemnSelect = document.querySelectorAll('select');
      var instancesSelect = M.FormSelect.init(elemnSelect, {});
    });
  </script>
</body>
</html>