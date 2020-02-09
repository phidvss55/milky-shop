                </div>
                <!-- /.container-fluid -->
            </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="/milkyshop/public/admin/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/milkyshop/public/admin/js/bootstrap.min.js"></script>
</body>

</html>

<!-- this use to exchange value of dropbox  -->
<script type="text/javascript">
    function getState(val) {
        $.ajax({
        type: "POST",
        url: "providers-Changed.php",
        data:'category_id='+val,
        success: function(data){
            $("#providers-list").html(data);
            }
        });
    }

    var timeDisplay = document.getElementById("time");


    function refreshTime() {
    var dateString = new Date().toLocaleString();
    var formattedString = dateString.replace(", ", " - ");
    timeDisplay.innerHTML = formattedString;
    }

    setInterval(refreshTime, 1000);
</script>