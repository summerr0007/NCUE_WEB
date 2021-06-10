<script>
var clean = function(ShopcarID) {
        $.ajax({
            type: 'POST',
            url: `<?php echo THISURL; ?>shopcar/clean/`,
            datatype: "json",
            async: true,
            success: function(data) {              
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    };
clean();
alert('購買成功');
location.href = '<?php echo THISURL."sold/soldlist";?>';
</script>