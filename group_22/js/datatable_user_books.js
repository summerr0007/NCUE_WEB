var tbl;
$(function () {
      //查詢
      tbl = $('#user_books').DataTable({
            "scrollX": false,
            "scrollY": false,
            "scrollCollapse": false, //當筆數小於scrillY高度時,自動縮小
            "displayLength": 10,
            "paginate": true, //是否分頁
            "lengthChange": true,
            "ajax": {
                  url: "datatable_user_books_ajax.php",
                  data: function (d) {
                        return $('#form_user_books').serialize() + "&oper=query";
                  },
                  type: 'POST',
                  dataType: 'json'
            },
            "dom": 'frtip'
      });

      //修改
      $('tbody').on('click', '#btn_update', function () {
            var data = tbl.row($(this).closest('tr')).data();
            $('#account').val(data[0]);
            $('#pid').val(data[1]);
            $('#apply_for_return').val(data[2]);
            $("#order_count").val(data[3]);
            $("#quantity").val(data[5]);
            $("#account_del").val(data[0]);
            $("#g_id_del").val(data[1]);
            $("#oper").val("update");
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
                  title: '確定要同意退貨?',
                  icon: 'warning',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: '同意啦!',
                  cancelButtonText: '否'
            }).then((result) => {
                  if (result.isConfirmed) {
                        $("#account_del").val(data[0]);
                        $("#g_id_del").val(data[1]);
                        $("#tmdorder_count").val(data[3]);
                        $("#quantity").val(data[5]);
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
      $("#form_user_books").validate({
            submitHandler: function (form) {
                  CRUD();
            },
            rules: {
                  account: {
                        required: true,
                        minlength: 5,
                        maxlength: 12
                  },
                  pid: {
                        required: true
                  },
                  apply_for_return: {
                        required: true
                  }
            }
      });
      function CRUD() {
            $.ajax({
                  url: "datatable_user_books_ajax.php",
                  data: $("#form_user_books").serialize(),
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