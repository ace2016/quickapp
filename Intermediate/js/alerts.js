function alertModal(title, html, icon, confirmButtonText){

    Swal.fire({
        title: `${title}`, // as HTML
        //titleText: '', // as normal text
        heightAuto: false,
        html: `${html}`,
        icon: `${icon}`, // warning; error; success; info; question
        //iconColor: '',
        // confirmButtonColor: "#0061F2",
        confirmButtonText: `${confirmButtonText}`,
        allowOutsideClick: false,
        allowEscapeKey: false,
        padding: '2em',
        //position: '' // top; top-start; top-end; center; center-start; center-end; bottom; bottom-start; bottom-end
    })/*.then(function(){
        // anything else
    });*/

}

function alertToast(title, text, icon, timer) {

    Swal.fire({
        title: `${title}`,
        text: `${text}`,
        icon: `${icon}`, // warning; error; success; info; question
        timer: timer,
        timerProgressBar: true,
        showConfirmButton: false,
        toast: true,
        position: 'top-end',
    });

}