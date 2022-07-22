$('.dlt_user').on("click", function(e){
    e.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
    title: 'ลบข้อมูล',
    text: "คุณต้องการลบข้อมูลใช่หรือไม่",
    icon: 'error',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ใช่',
    cancelButtonText: 'ไม่ใช่'
    }).then((result) => {
    if (result.isConfirmed) {
        Swal.fire(
            'ลบข้อมูลเรียบร้อยแล้ว',
            '',
            'success'
        ).then((result)=> {
            if(result.isConfirmed){
                window.location.href = url;
            }
        });
    }
    })
});
