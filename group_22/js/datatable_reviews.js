var tbl;
$(function () {
      //查詢
      tbl = $('#reviews').DataTable({
            "scrollX": false,
            "scrollY": false,
            "scrollCollapse": false, //當筆數小於scrillY高度時,自動縮小
            "displayLength": 12,
            "paginate": true, //是否分頁
            "lengthChange": true,
            "ajax": {
                  url: "datatable_reviews_ajax.php",
                  data: function (d) {
                        return $('#form_reviews').serialize() + "&oper=query";
                  },
                  type: 'POST',
                  dataType: 'json'
            },
            "dom": 'frtip'
      });

      //取消
      $('tbody').on('click', '#btn_cancel', function () {
            $("#oper").val("insert");
      });

      //刪除
      $('tbody').on('click', '#btn_delete', function () {
            var data = tbl.row($(this).closest('tr')).data();
            // if (!confirm('是否確定要刪除?'))
            //       return false;
            Swal.fire({
                  title: '確定要刪除?',
                  icon: 'warning',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: '是',
                  cancelButtonText: '否'
            }).then((result) => {
                  if (result.isConfirmed) {
                        $("#num").val(data[4]);
                        $("#oper").val("delete"); //刪除
                        CRUD();                      
                  }
                  else
                  {
                        return false;
                  }
            })            

      });

      //送出表單 (儲存)
      $("#form_reviews").validate({
            submitHandler: function (form) {
                  CRUD();
            },
            rules: {
                  pid: {
                        required: true
                  },
                  account: {
                        required: true,
                        minlength: 5,
                        maxlength: 12
                  },
                  review: {
                        required: true
                  }
            }
      });
      function CRUD() {
            $.ajax({
                  url: "datatable_reviews_ajax.php",
                  data: $("#form_reviews").serialize(),
                  type: 'POST',
                  dataType: "json",
                  success: function (JData) {
                        if (JData.code)
                              toastr["error"](JData.message);
                        else {
                              $("#oper").val("insert");
                              toastr["success"](JData.message);
                              tbl.ajax.reload();
                        }
                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr.responseText);
                        alert(xhr.responseText);
                  }
            });
      }

});