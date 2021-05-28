var tbl;
$(function () {
      //查詢
      tbl = $('#members').DataTable({
            "scrollX": false,
            "scrollY": false,
            "scrollCollapse": false, //當筆數小於scrillY高度時,自動縮小
            "displayLength": 10,
            "paginate": true, //是否分頁
            "lengthChange": true,
            "ajax": {
                  url: "datatable_members_ajax.php",
                  data: function (d) {
                        return $('#form_members').serialize() + "&oper=query";
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
            $('#password').val(data[1]);
            $('#email').val(data[2]);
            if (data[3] == "一般使用者(會員)")
                  $('input[name="level"][value="2"]').prop('checked', true);
            else
                  $('input[name="level"][value="3"]').prop('checked', true);
            $("#account_old").val(data[0]);
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
                  title: '確定要刪除?',
                  icon: 'warning',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: '是',
                  cancelButtonText: '否'
            }).then((result) => {
                  if (result.isConfirmed) {
                        $("#account_old").val(data[0]);
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
      $("#form_members").validate({
            submitHandler: function (form) {
                  CRUD();
            },
            rules: {
                  account: {
                        required: true,
                        minlength: 5,
                        maxlength: 12
                  },
                  password: {
                        required: true,
                        minlength: 8,
                        maxlength: 12
                  },
                  email: {
                        required: true,
                        email: true
                  },
                  level: {
                        required: true
                  }
            }
      });
      function CRUD() {
            $.ajax({
                  url: "datatable_members_ajax.php",
                  data: $("#form_members").serialize(),
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