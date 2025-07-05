function actionDelete(event) {
    event.preventDefault(); // Ngăn chặn chuyển hướng khi nhấn vào thẻ <a>
    let urlRequest = $(this).data('url');
    let that = $(this);
    
    Swal.fire({
  title: "Bạn có chắc chắn muốn xóa?",
  text: "Hành động này sẽ không thể hoàn tác!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Vâng, xóa ngay!",
  cancelButtonText: "Hủy"
}).then((result) => {
  if (result.isConfirmed) {
        $.ajax({
            type: 'GET',
            url: urlRequest,
            success: function(data){
                if(data.code == 200){
                    that.parent().parent().remove();
                    Swal.fire({
                    title: "Đã xóa!",
                    text: "Dữ liệu đã được xóa thành công.",
                    icon: "success"
    });
                }
            },
            error: function(){

            }
        });
    
  }
});
}

$(function() {
    $(document).on('click', '.action_delete', actionDelete);
});
