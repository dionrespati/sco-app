
</div>
</div> 
</div> <!--END container-fluid -->   
<footer>
    <hr>
    <p class="pull-right">A K-System Application by EDP K-Link</p>
    <p>&copy; 2013</p>
</footer>




<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>
    $(function () {
        $(".ss").click(function () {
            var isi = $(this).attr('id');
            $("#content").html('<center><img src=http://www.k-linkmember.co.id/ksystemx/images/ajax-loader2.gif ></center>');
            //$.preload('<center><img src=http://www.k-linkmember.co.id/ksystem/images/ajax-loader2.gif ></center>');
            $("#content").load(isi, function (response, status, xhr) {
                if (status == "error") {
                    alert("The page you are requesting is not found, Error status :" + xhr.status);
                }
            });

        });

        $(All.get_active_tab() + ' .uppercase').bind('change', function () {
            $(this).val($(this).val().toUpperCase().replace(/'/g, "`"));
        });




        $(All.get_active_tab() + ' .numeric-input').keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) || (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });

    function textAreaUppercase(idx) {
        var str = idx.value;
        idx.value = str.toUpperCase().replace(/'/g, "`");
    }

</script>
<input type="hidden" id="tab_qty" value="0"/>
</body>
</html>