var site_url = window.location.protocol + '//' + window.location.hostname;

// //Basic
// document.getElementById("sa-basic").addEventListener("click", function() {
//     Swal.fire(
//         {
//             title: 'Any fool can use a computer',
//             confirmButtonColor: '#5156be',
//         }
//     )
// });

// //A title with a text under


// //Success Message
// document.getElementById("sa-success").addEventListener("click", function() {
//     Swal.fire(
//         {
//             title: 'Good job!',
//             text: 'You clicked the button!',
//             icon: 'success',
//             showCancelButton: true,
//             confirmButtonColor: '#5156be',
//             cancelButtonColor: "#fd625e"
//         }
//     )
// });


function confirmDeleteDepo(id){
    Swal.fire({
        title: 'Lanjutkan hapus deposit?',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#2ab57d",
        cancelButtonColor: "#fd625e",
        confirmButtonText: "Lanjut",
        }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: site_url + '/deposit/delete/' + id,
                type: 'get',
                success: function(hasil){
                    var obj = $.parseJSON(hasil);
                    if(obj.error){
                        Swal.fire(obj.teks, '', "error");
                    } else {
                        Swal.fire(obj.teks, '', "success");
                        if(obj.role == 'admin'){
                            $('#riwayat_depo_admin').DataTable().ajax.reload();
                        } else {
                            $('#riwayat_depo').DataTable().ajax.reload();
                        }
                    }
                }
            });
        } else {
            return false;
        }
    });
}

function cekDepo(id){
    $.ajax({
        url: site_url + '/deposit/cekDepo',
        type: 'get',
        success: function(hasil){
            var obj = $.parseJSON(hasil);
            if(obj.error){
                Swal.fire("Gagal!", obj.teks, "error");
            } else {
                $('#'+id).submit();
            }
        }
    })
}

function globalConfirm(judul, teks=false){
    Swal.fire({
        title: judul,
        text: (teks) ? teks : '',
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#2ab57d",
        cancelButtonColor: "#fd625e",
        confirmButtonText: "Lanjut",
        }).then(function (result) {
        if (result.value) {
            $('#form_depo').submit();
        } else {
            return false;
        }
    });
}
// download riwayat order file
function downloadFile(id, tipe = null){
    if(tipe == null){
        $slug = 'downloadFile/';
    } else {
        $slug = 'downloadFileBulk/';
    }
    $.ajax({
        url: site_url + '/dashboard/' + $slug + id,
        type: 'get',
        success: function(hasil){
            var obj = $.parseJSON(hasil);
            if(obj.error){
                Swal.fire(
                    {
                        title: "Error",
                        text: obj.teks,
                        icon: 'error',
                        confirmButtonColor: '#5156be'
                    }
                )
            } else {
                var timerInterval;
                Swal.fire({
                title: 'Berhasil!',
                text: 'Proses Mengunduh File...',
                timer: 2000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen:function () {
                    Swal.showLoading()
                    timerInterval = setInterval(function() {
                    var content = Swal.getHtmlContainer()
                    if (content) {
                        var b = content.querySelector('b')
                        if (b) {
                        b.textContent = Swal.getTimerLeft()
                        }
                    }
                    }, 100)
                },
                onClose: function () {
                    clearInterval(timerInterval)
                }
                }).then(function (result) {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = obj.url;
                }
                })
            }
        }
    });
}


//Warning Message
function confirmBuy(id, harga) {
    // cek saldo, send error jika saldo tidak cukup
    var saldo = $('#saldo').html().replace(/\D/g,'');
    if(saldo == 'Isi Saldo' || harga > saldo){
        Swal.fire({
            title: 'Error',
            text: 'Saldo tidak cukup, silahkan deposit terlebih dahulu.',
            icon: 'error',
            confirmButtonColor: '#5156be',
        });
        return false;
    }

    $.ajax({
        url: site_url + '/dashboard/getDetailFile/' + id,
        type: 'get',
        success: function(hasil) {
            var obj = $.parseJSON(hasil);
            if(obj.error){
                Swal.fire({
                    title: 'Error',
                    text: 'Gagal mengambil detail file, silahkan coba lagi',
                    icon: 'error',
                    confirmButtonColor: '#5156be',
                });
            } else {
                Swal.fire({
                    title: "Detail File",
                    html: `<table style="margin: 0 auto 20px auto;"><tr><td class="text-left">State</td><td class="text-left">${obj.state}</td></tr><tr><td class="text-left">Olahraga</td><td class="text-left">${obj.olahraga}</td></tr><tr><td class="text-left">Gender</td><td class="text-left">${obj.kelamin}</td></tr><tr><td class="text-left">Situs</td><td class="text-left">${obj.situs}</td></tr><tr><td class="text-left">Jumlah Game</td><td class="text-left">${obj.total_game}</td></tr><tr><td class="text-left">Game Date</td><td class="text-left">${obj.tanggal_game}</td></tr><tr><td class="text-left">Scrape Date</td><td class="text-left">${obj.tanggal}</td></tr></tbody></table><b class="text-primary font-size-20">Rp. ${obj.harga},-</b>`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#2ab57d",
                    cancelButtonColor: "#fd625e",
                    confirmButtonText: "Beli",
                    allowOutsideClick: false
                  }).then(function (result) {
                    if (result.value) {

                        $.ajax({
                            url: site_url + '/dashboard/buyFile/' + obj.id,
                            type: 'post',
                            success:function(result){
                                var obj1 = $.parseJSON(result);
                                if(obj1.error){
                                    Swal.fire({
                                        title: 'Error',
                                        text: obj1.teks,
                                        icon: 'error',
                                        confirmButtonColor: '#5156be',
                                    });
                                } else {
                                    $('#saldo').html('Rp. ' + obj1.saldo + ',-');
                                    $('#order').DataTable().ajax.reload();
                                    Swal.fire("Berhasil!", `Jika file tidak terunduh secara otomatis,<br><a href='${obj1.url}'><b>klik disini.</b></a><br><br>File ini akan <b class='text-danger'>dihapus</b> oleh sistem <br>pada hari <b>Senin 06:00 WIB.</b>`, "success");
                                    window.location.href = obj1.url;
                                }
                            }
                        });
                    }
                });
            }
        }
    });
};

// //Parameter
// document.getElementById("sa-params").addEventListener("click", function() {
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be able to revert this!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonText: 'Yes, delete it!',
//         cancelButtonText: 'No, cancel!',
//         confirmButtonClass: 'btn btn-success mt-2',
//         cancelButtonClass: 'btn btn-danger ms-2 mt-2',
//         buttonsStyling: false
//     }).then(function (result) {
//         if (result.value) {
//             Swal.fire({
//               title: 'Deleted!',
//               text: 'Your file has been deleted.',
//               icon: 'success',
//               confirmButtonColor: '#5156be',
//             })
//           } else if (
//             // Read more about handling dismissals
//             result.dismiss === Swal.DismissReason.cancel
//           ) {
//             Swal.fire({
//               title: 'Cancelled',
//               text: 'Your imaginary file is safe :)',
//               icon: 'error',
//               confirmButtonColor: '#5156be',
//             })
//           }
//     });
// });


// //Custom Image
// document.getElementById("sa-image").addEventListener("click", function() {
//     Swal.fire({
//         title: 'Sweet!',
//         text: 'Modal with a custom image.',
//         imageUrl: 'assets/images/logo-sm.svg',
//         imageHeight: 48,
//         confirmButtonColor: "#5156be",
//         animation: false
//     })
// });

// //Auto Close Timer
// document.getElementById("sa-close").addEventListener("click", function() {
//     var timerInterval;
//     Swal.fire({
//     title: 'Auto close alert!',
//     html: 'I will close in <b></b> seconds.',
//     timer: 2000,
//     timerProgressBar: true,
//     didOpen:function () {
//         Swal.showLoading()
//         timerInterval = setInterval(function() {
//         var content = Swal.getHtmlContainer()
//         if (content) {
//             var b = content.querySelector('b')
//             if (b) {
//             b.textContent = Swal.getTimerLeft()
//             }
//         }
//         }, 100)
//     },
//     onClose: function () {
//         clearInterval(timerInterval)
//     }
//     }).then(function (result) {
//     /* Read more about handling dismissals below */
//     if (result.dismiss === Swal.DismissReason.timer) {
//         console.log('I was closed by the timer')
//     }
//     })
// });

// //custom html alert
// document.getElementById("custom-html-alert").addEventListener("click", function() {
//     Swal.fire({
//         title: '<i>HTML</i> <u>example</u>',
//         icon: 'info',
//         html: 'You can use <b>bold text</b>, ' +
//         '<a href="//Pichforest.in/">links</a> ' +
//         'and other HTML tags',
//         showCloseButton: true,
//         showCancelButton: true,
//         confirmButtonClass: 'btn btn-success',
//         cancelButtonClass: 'btn btn-danger ms-1',
//         confirmButtonColor: "#47bd9a",
//         cancelButtonColor: "#fd625e",
//         confirmButtonText: '<i class="fas fa-thumbs-up me-1"></i> Great!',
//         cancelButtonText: '<i class="fas fa-thumbs-down"></i>'
//     })
// });

// //position
// document.getElementById("sa-position").addEventListener("click", function() {
//     Swal.fire({
//         position: 'top-end',
//         icon: 'success',
//         title: 'Your work has been saved',
//         showConfirmButton: false,
//         timer: 1500
//     })
// });

// //Custom width padding
// document.getElementById("custom-padding-width-alert").addEventListener("click", function() {
//     Swal.fire({
//         title: 'Custom width, padding, background.',
//         width: 600,
//         padding: 100,
//         confirmButtonColor: "#5156be",
//         background: '#e0e1f3'
//     })
// });

// //Ajax
// document.getElementById("ajax-alert").addEventListener("click", function() {
//     Swal.fire({
//         title: 'Submit email to run ajax request',
//         input: 'email',
//         showCancelButton: true,
//         confirmButtonText: 'Submit',
//         showLoaderOnConfirm: true,
//         confirmButtonColor: "#5156be",
//         cancelButtonColor: "#fd625e",
//         preConfirm: function (email) {
//             return new Promise(function (resolve, reject) {
//                 setTimeout(function () {
//                     if (email === 'taken@example.com') {
//                         reject('This email is already taken.')
//                     } else {
//                         resolve()
//                     }
//                 }, 2000)
//             })
//         },
//         allowOutsideClick: false
//     }).then(function (email) {
//         Swal.fire({
//             icon: 'success',
//             title: 'Ajax request finished!',
//             confirmButtonColor: "#5156be",
//             html: 'Submitted email: ' + email
//         })
//     })
// });
