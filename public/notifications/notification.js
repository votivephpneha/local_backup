var toastMixinLeftError = Swal.mixin({
    toast: true,
    icon: 'error',
    title: 'General Title',
    animation: false,
    position: 'top-start',
    showConfirmButton: false,
    showCloseButton : true,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });


var toastMixinSuccess = Swal.mixin({
toast: true,
icon: 'success',
title: 'General Title',
// animation: false,
position: 'top-right',
showConfirmButton: false,
showCloseButton : true,
width : '40rem',
padding : '1.55rem',
timer: 5000,
timerProgressBar: true,
didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
}
});


function success_noti(msg) {
toastMixinSuccess.fire({
    // animation: true,
    title: msg
});
}


var toastDelete = Swal.mixin({
    toast: true,
    title: 'Are you sure delete this?',
    icon: 'warning',
    // animation: false,
    position: 'top-right',
    // showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
    // width : '37rem',
    // padding : '1.55rem',
    // showCloseButton : true,
    // type: "warning",
    showCancelButton: !0,
    // cancelButtonText: "No, cancel!",
    reverseButtons: !0
  });