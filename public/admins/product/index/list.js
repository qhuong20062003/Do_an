function actionDelete(event) {
    event.preventDefault(); // Ngăn chặn chuyển hướng khi nhấn vào thẻ <a>
    let urlRequest = $(this).data('url');
    let that = $(this);
    
    Swal.fire({
  title: "Are you sure?1",
  text: "You won't be able to revert this!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
  if (result.isConfirmed) {
        $.ajax({
            type: 'GET',
            url: urlRequest,
            success: function(data){
                if(data.code == 200){
                    that.parent().parent().remove();
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
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
