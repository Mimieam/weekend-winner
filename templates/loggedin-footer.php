    </div> <!-- /container -->
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/moment.js"></script>
    <script src="js/noisy.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-lightbox.js"></script>
    <script src="js/bootstrap-colorpicker.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <?php
    include dirname(__FILE__).'/persona-handler.inc.php';
    ?>
    <script>
        <?php
        if (isset($_SESSION['message'])) {
            echo 'alert('.json_encode($_SESSION['message']).');';
        }
        ?>
    </script>
  </body>
</html>
