<?php include ('./inc/header2.php'); ?>
            <div class="container">
                <div class="row">
                    <p class="message">MESSAGE</p>
                </div> <!-- end .row -->
                
            </div>
            <!-- end .container -->
        </main>
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
        <script type="text/javascript">
            $('#checkall').click(function(event) {
                if($(this).is(':checked')) {
                    $('.p-item').find('input[type="checkbox"]').prop('checked', true);
                } else {
                    $('.p-item').find('input[type="checkbox"]').prop('checked', false);
                }
                
            });
        </script>
    </body>
</html>