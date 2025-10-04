// utility functions
function alert(message, type, timer){
    // sweetalert
    Swal.fire({
        icon: type,
        title: message,
        showConfirmButton: false,
        timer: timer
    })
}