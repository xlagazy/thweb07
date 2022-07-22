$('.recieve').on('click', function(e){
    e.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
        title: 'รับงาน',
        text: "คุณรับงานใช่หรือไม่่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่ใช่'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
              'รับงานเรียบร้อย',
              '',
             'success'
          ).then((result)=> {
              if(result.isConfirmed){
                window.location.href = url;
              }
          });
        }
    });
});

$('.no_recieve').on('click', function(e){
    e.preventDefault();
    const url = $(this).attr('href');
    Swal.fire({
        title: 'ไม่รับงาน',
        text: "คุณปฏิเสธไม่รับงานใช่หรือไม่่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่ใช่'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
              'ปฏิเสธการรับงานเรียบร้อย',
              '',
             'success'
          ).then((result)=> {
              if(result.isConfirmed){
                window.location.href = url;
              }
          });
        }
    });
});
