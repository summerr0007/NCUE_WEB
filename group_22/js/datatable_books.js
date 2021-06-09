var tbl;
$(function () {
   //查詢
   tbl = $('#books').DataTable({
      "scrollX": false,
      "scrollY": false,
      "scrollCollapse": false, //當筆數小於scrillY高度時,自動縮小
      "displayLength": 10,
      "paginate": true, //是否分頁
      "lengthChange": true,
      "ajax": {
         url: "datatable_books_ajax.php",
         data: function (d) {
            return $('#form_books').serialize() + "&oper=query";
         },
         type: 'POST',
         dataType: 'json'
      },
      "dom": 'frtip'
   });

   //修改
   $('tbody').on('click', '#btn_update', function () {
      var data = tbl.row($(this).closest('tr')).data();
      $('#name').val(data[1]);
      $('#author').val(data[2]);
      $('#publisher').val(data[3]);
      $('#date').val(data[4]);
      $('#price').val(data[5]);
      $('#summary').val(data[6]);
      $('#star').val(data[7]);
      $('#cate').val(data[8]);
      $('#stock').val(data[9]);
      $('#picn').val(data[11]);
      $("#g_id_old").val(data[0]);
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
      //    return false;
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
            $("#g_id_old").val(data[0]);
            $("#oper").val("delete"); //刪除
            CRUD();
         }
         else {
            return false;
         }
      })


   });

   //送出表單 (儲存)
   $("#form_books").validate({
      submitHandler: function (form) {
         CRUD();
      },
      rules: {
         name: {
            required: true
         },
         author: {
            required: true
         },
         publisher: {
            required: true
         },
         date: {
            required: true
         },
         price: {
            required: true
         },
         summary: {
            required: true
         },
         star: {
            required: true
         },
         cate: {
            required: true
         },
         stock: {
            required: true
         }
      }
   });
   function CRUD() {
      $.ajax({
         url: "datatable_books_ajax.php",
         data: $("#form_books").serialize(),
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