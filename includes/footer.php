<!-- Inicio del footer-->
<footer class="text-muted py-5 mt-5">
    <div class="container">
        <p class="mb-1">Blog desarrollado para la materia de Programación 2</p>
        <p class="mb-0">Por Amizaday OR &copy;</p>
    </div>
</footer>
<!--Final del footer-->
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace("texto");
</script>
<!--Datatable de usuarios-->
<script>
    $(document).ready(function() {
        $('#tblUsuarios').DataTable();
    });
</script>
<!--Datatable de usuarios fin-->

<!--Datatable de usuarios-->
<script>
    $(document).ready(function() {
        $('#tblArticulos').DataTable();
    });
</script>
<!--Datatable de usuarios fin-->
<!--Datatable de comentarios-->
<script>
    $(document).ready(function() {
        $('#tblComentarios').DataTable();
    });
</script>
<!--Datatable de comentarios fin-->
</body>

</html>