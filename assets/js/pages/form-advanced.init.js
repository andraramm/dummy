var site_url = window.location.protocol + '//' + window.location.hostname;

// singleNoSearch
var select_or = new Choices('#olahraga');
var select_st = new Choices('#state');
var tanggal = new Choices(
  '#tanggal',
  {
  removeItemButton: true,
  }
);

$('#gender').change(function(){
  var gender = $(this).val();

  $.ajax({
      url: site_url + '/dashboard/selectGender',
      type: 'post',
      data:{
        gender: gender,
      },
      success: function(hasil){
          var obj = $.parseJSON(hasil);
          if(obj.error){
              alert('tidak dapat menampilkan data, coba lagi beberapa saat');
          } else {
            $('#beli').attr("style", "display: none !important");
            $('#detail').attr("style", "display: none !important");
            select_or.clearStore();
            select_st.clearStore();
            tanggal.clearStore();

            var arr_or = [{value: 'all', label: 'Semua'}];

            Object.values(obj.olahraga).forEach(function(data) {
              var tmp = {
                value: data,
                label: data.replace(/(^\w|\s\w)/g, m => m.toUpperCase()),
              };
              arr_or.push(tmp);
            });

            select_or.setChoices(arr_or,
              'value',
              'label',
              true
            );

          }
      }
  })
})

$('#olahraga').change(function(){
  var gender = $('#gender').val();
  var olahraga = $('#olahraga').val();

  $.ajax({
      url: site_url + '/dashboard/selectOlahraga',
      type: 'post',
      data:{
        gender: gender,
        olahraga: olahraga,
      },
      success: function(hasil){
          var obj = $.parseJSON(hasil);
          if(obj.error){
              alert('tidak dapat menampilkan data, coba lagi beberapa saat');
          } else {
            $('#beli').attr("style", "display: none !important");
            $('#detail').attr("style", "display: none !important");
            var arr_st = [{value: 'all', label: 'Semua'}];
            select_st.clearStore();
            tanggal.clearStore();
            Object.values(obj.state).forEach(function(data) {
              var tmp = {
                value: data,
                label: data.replace(/(^\w|\s\w)/g, m => m.toUpperCase()),
              };
              arr_st.push(tmp);
            });

            select_st.setChoices(arr_st,
              'value',
              'label',
              true
            );
          }
      }
  })
})

$('#state').change(function(){
  var gender = $('#gender').val();
  var olahraga = $('#olahraga').val();
  var state = $('#state').val();

  $.ajax({
      url: site_url + '/dashboard/selectState',
      type: 'post',
      data:{
        gender: gender,
        olahraga: olahraga,
        state: state,
      },
      success: function(hasil){
          var obj = $.parseJSON(hasil);
          if(obj.error){
              alert('tidak dapat menampilkan data, coba lagi beberapa saat');
          } else {
            tanggal.clearStore();
            $('#beli').attr("style", "display: none !important");
            $('#detail').attr("style", "display: none !important");
            var arr_tg = [];
            Object.values(obj.tanggal).forEach(function(data) {
              var getDate = data.split(' ')[0];
              var d = new Date(getDate);
              var month = parseInt(d.getMonth()) + 1;
              var date = d.getDate() + '-' + month + '-' + d.getFullYear();

              var tmp = {
                value: data,
                label: date,
              };
              arr_tg.push(tmp);
            });

            tanggal.setChoices(arr_tg,
              'value',
              'label',
              true
            );
          }
      }
  })
})

$('#tanggal').change(function(){
  var gender = $('#gender').val();
  var olahraga = $('#olahraga').val();
  var state = $('#state').val();
  var tanggal_arr = $('#tanggal').val();

  if(tanggal_arr.length == 0){
    $('#beli').attr("style", "display: none !important");
    $('#detail').attr("style", "display: none !important");
  }

  $.ajax({
      url: site_url + '/dashboard/selectTanggal',
      type: 'post',
      data:{
        gender: gender,
        olahraga: olahraga,
        state: state,
        tanggal_value: tanggal_arr,
      },
      success: function(hasil){
          var obj = $.parseJSON(hasil);
          if(obj.error){
              alert('tidak dapat menampilkan data, coba lagi beberapa saat');
          } else {
            $('#game').html(obj.game + ' Game');
            $('#harga').html('Rp. ' + obj.harga + ',-');
            $('#file').html(obj.total_file + ' File');
            if(tanggal_arr.length != 0){
              $('#beli').show();
              $('#detail').show();
            }
          }
      }
  })
})

$('#bulkBuy').on('click', function(){
    var harga = parseInt($('#harga').html().replace(/\D/g,''));
    var saldo = parseInt($('#saldo').html().replace(/\D/g,''));
    if(saldo == 'Isi Saldo' || harga > saldo){
        Swal.fire('Error', 'Saldo tidak cukup, silahkan deposit terlebih dahulu', "error");
        alert(harga + '\n' + saldo);
        return false;
    }

    Swal.fire({
      title: 'Lanjutkan beli item ini?',
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#2ab57d",
      cancelButtonColor: "#fd625e",
      confirmButtonText: "Lanjut",
      }).then(function (result) {
      if (result.value) {
        var gender = $('#gender').val();
        var olahraga = $('#olahraga').val();
        var state = $('#state').val();
        var tanggal_arr = $('#tanggal').val();
        $.ajax({
          url: site_url + '/dashboard/bulkBuy',
          type: 'post',
          data: {
            gender: gender,
            olahraga: olahraga,
            state: state,
            tanggal_value: tanggal_arr,
          },
          success: function(hasil){
            var obj = $.parseJSON(hasil);
            if(obj.error){
              Swal.fire(obj.teks, '', "error");
            } else {
              $('#saldo').html('Rp. ' + obj.saldo + ',-');
              // $('#order_bulk').DataTable().ajax.reload();
              Swal.fire("Berhasil!", `Jika file tidak terunduh secara otomatis,<br><a href='${obj.url}'><b>klik disini.</b></a><br><br>File ini akan <b class='text-danger'>dihapus</b> oleh sistem <br>pada hari <b>Senin 06:00 WIB.</b>`, "success");
              window.location.href = obj.url;
            }
          }
        })
      } else {
          return false;
      }
    });
});


// Chocies Select plugin
document.addEventListener('DOMContentLoaded', function () {
	var genericExamples = document.querySelectorAll('[data-trigger]');
	for (i = 0; i < genericExamples.length; ++i) {
	  var element = genericExamples[i];
	  new Choices(element, {
		placeholderValue: 'This is a placeholder set in the config',
		searchPlaceholderValue: 'This is a search placeholder',
    searchEnabled: false,
	  });
	}
  

  
	// // singleNoSorting
	// var singleNoSorting = new Choices('#choices-single-no-sorting', {
	//   shouldSort: false,
	// });
  
  
	// //choices-multiple-groups
	// var multipleDefault = new Choices(
	//   document.getElementById('choices-multiple-groups')
	// );
  
	// // text inputs example
	// var textRemove = new Choices(
	//   document.getElementById('choices-text-remove-button'),
	//   {
	// 	delimiter: ',',
	// 	editItems: true,
	// 	maxItemCount: 5,
	// 	removeItemButton: true,
	//   }
	// );
  
	// // choices-text-unique-values
	// var textUniqueVals = new Choices('#choices-text-unique-values', {
	//   paste: false,
	//   duplicateItemsAllowed: false,
	//   editItems: true,
	// });
  
	// //choices-text-disabled
	// var textDisabled = new Choices('#choices-text-disabled', {
	//   addItems: false,
	//   removeItems: false,
	// }).disable();
});


// // colorpicker

// // classic color picker
// var classicPickr = Pickr.create({
//     el: '.classic-colorpicker',
//     theme: 'classic', // or 'monolith', or 'nano'
//     default: '#4a4fea',
//     swatches: [
//       'rgba(244, 67, 54, 1)',
//       'rgba(233, 30, 99, 0.95)',
//       'rgba(156, 39, 176, 0.9)',
//       'rgba(103, 58, 183, 0.85)',
//       'rgba(63, 81, 181, 0.8)',
//       'rgba(33, 150, 243, 0.75)',
//       'rgba(3, 169, 244, 0.7)',
//       'rgba(0, 188, 212, 0.7)',
//       'rgba(0, 150, 136, 0.75)',
//       'rgba(76, 175, 80, 0.8)',
//       'rgba(139, 195, 74, 0.85)',
//       'rgba(205, 220, 57, 0.9)',
//       'rgba(255, 235, 59, 0.95)',
//       'rgba(255, 193, 7, 1)'
//     ],

//     components: {

//       // Main components
//       preview: true,
//       opacity: true,
//       hue: true,

//       // Input / output Options
//       interaction: {
//         hex: true,
//         rgba: true,
//         hsva: true,
//         input: true,
//         clear: true,
//         save: true
//       }
//     }
// });


// // monolith color picker
// var monolithPickr = Pickr.create({
//   el: '.monolith-colorpicker',
//   theme: 'monolith',
//   default: '#27bbe8',
//   swatches: [
//     'rgba(244, 67, 54, 1)',
//     'rgba(233, 30, 99, 0.95)',
//     'rgba(156, 39, 176, 0.9)',
//     'rgba(103, 58, 183, 0.85)',
//     'rgba(63, 81, 181, 0.8)',
//     'rgba(33, 150, 243, 0.75)',
//     'rgba(3, 169, 244, 0.7)'
//   ],
//   defaultRepresentation: 'HEXA',
//   components: {

//     // Main components
//     preview: true,
//     opacity: true,
//     hue: true,

//     // Input / output Options
//     interaction: {
//       hex: false,
//       rgba: false,
//       hsva: false,
//       input: true,
//       clear: true,
//       save: true
//     }
//   }
// });

// // nano color picker
// var nanoPickr = Pickr.create({
//   el: '.nano-colorpicker',
//   theme: 'nano',
//   default: '#f7cc53',
//   swatches: [
//     'rgba(244, 67, 54, 1)',
//     'rgba(233, 30, 99, 0.95)',
//     'rgba(156, 39, 176, 0.9)',
//     'rgba(103, 58, 183, 0.85)',
//     'rgba(63, 81, 181, 0.8)',
//     'rgba(33, 150, 243, 0.75)',
//     'rgba(3, 169, 244, 0.7)'
//   ],
//   defaultRepresentation: 'HEXA',
//   components: {

//     // Main components
//     preview: true,
//     opacity: true,
//     hue: true,

//     // Input / output Options
//     interaction: {
//       hex: false,
//       rgba: false,
//       hsva: false,
//       input: true,
//       clear: true,
//       save: true
//     }
//   }
// });

// // flatpickr

// flatpickr('#datepicker-basic');

// flatpickr('#datepicker-datetime', {
//   enableTime: true,
//   dateFormat: "m-d-Y H:i"
// });

// flatpickr('#datepicker-humanfd', {
//   altInput: true,
//   altFormat: "F j, Y",
//   dateFormat: "Y-m-d",
// });

// flatpickr('#datepicker-minmax', {
//   minDate: "today",
//   maxDate: new Date().fp_incr(14) // 14 days from now
// });

// flatpickr('#datepicker-disable', {
//   onReady: function () {
//     this.jumpToDate("2025-01")
//   },
//   disable: ["2025-01-30", "2025-02-21", "2025-03-08", new Date(2025, 4, 9)],
//   dateFormat: "Y-m-d",
// });

// flatpickr('#datepicker-multiple', {
//   mode: "multiple",
//   dateFormat: "Y-m-d"
// });

// flatpickr('#datepicker-range', {
//   mode: "range"
// });

// flatpickr('#datepicker-timepicker', {
//     enableTime: true,
//     noCalendar: true,
//     dateFormat: "H:i",
// });

// flatpickr('#datepicker-inline', {
//   inline: true
// });