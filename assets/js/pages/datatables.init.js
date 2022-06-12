var site_url = window.location.protocol + '//' + window.location.hostname;

$(document).ready(function() {
    $('#datatable').DataTable();

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'colvis']
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    $(".dataTables_length select").addClass('form-select form-select-sm');
});

// tabel jadwal
$(document).ready(function() {
    $('#jadwal').DataTable({
        'processing': true,
        'serverSide': true,
        'lengthChange': true,
        'autoWidth': true,
        'serverMethod': 'post',
        'ajax': {
            "url": `${site_url}/dashboard/tabel_jadwal`,
        },
        'columns': [{
                'data': 'state'
            }, {
                'data': 'olahraga'
            }, {
                'data': 'kelamin'
            }, {
                'data': 'situs'
            }, {
                'data': 'total_game',
                render: function(data){
                    return data + ' Game';
                }
            }, {
                'data': 'harga',
                render: function(data){
                    return 'Rp. ' + data + ',-';
                }
            }, {
                'data': 'tanggal_game',
                render: function(data){
                    var d = new Date(data);
                    var dd = parseInt(d.getMonth()) + 1;
                    return d.getDate() + '-' + dd + '-' + d.getFullYear();
                }
            }, {
                'data': 'tanggal',
                render: function(data){
                    var d = new Date(data);
                    var dd = parseInt(d.getMonth()) + 1;
                    return d.getHours() + ':' + d.getMinutes() + ' ' + d.getDate() + '-' + dd + '-' + d.getFullYear();
                }
            }, {
                'data': 'id',
                render: function(data, type, row) {
                    return '<button type="button" class="btn btn-primary btn-sm" onclick="confirmBuy(' + data + ',' + row.harga + ')">Beli</button>';
                }
            }
        ],
        'order': [
            [7, "desc"]
        ],
    });
});

// tabel riwayat order
$(document).ready(function() {
    $('#order').DataTable({
        'processing': true,
        'serverSide': true,
        'lengthChange': true,
        'autoWidth': true,
        'serverMethod': 'post',
        'ajax': {
            "url": `${site_url}/dashboard/riwayat_order`,
        },
        'columns': [{
                'data': 'id'
            }, {
                'data': 'state'
            }, {
                'data': 'olahraga'
            }, {
                'data': 'kelamin'
            }, {
                'data': 'situs'
            }, {
                'data': 'total_game',
                render: function(data){
                    return data + ' Game';
                }
            }, {
                'data': 'harga',
                render: function(data){
                    return 'Rp. ' + data + ',-';
                }
            }, {
                'data': 'tanggal_game'
            }, {
                'data': 'tanggal' // tanggal order
            }, {
                'data': 'id',
                render: function(data){
                    return `<button class="btn btn-primary btn-sm" onclick="downloadFile('${data}')">Download</button>`;
                }

            }
        ],
        'order': [
            [0, "desc"]
        ],
    });
});

function reloadTable(){
    $('#order_bulk').DataTable().ajax.reload();
    $('#order').DataTable().ajax.reload();
}

// table riwayat order bulk
$(document).ready(function() {
    $('#order_bulk').DataTable({
        'processing': true,
        'serverSide': true,
        'lengthChange': true,
        'autoWidth': true,
        'serverMethod': 'post',
        'ajax': {
            "url": `${site_url}/dashboard/riwayat_order_bulk`,
        },
        'columns': [{
                'data': 'id'
            }, {
                'data': 'nama'
            }, {
                'data': 'harga',
                render: function(data){
                    return 'Rp. ' + data + ',-';
                }
            }, {
                'data': 'tanggal'
            }, {
                'data': 'id',
                render: function(data){
                    return `<button class="btn btn-primary btn-sm" onclick="downloadFile('${data}', 'bulk')">Download</button>`;
                }

            }
        ],
        'order': [
            [0, "desc"]
        ],
    });
});

// tabel riwayat depo user
$(document).ready(function() {
    $('#riwayat_depo').DataTable({
        'processing': true,
        'serverSide': true,
        'lengthChange': true,
        'autoWidth': true,
        'serverMethod': 'post',
        'ajax': {
            "url": `${site_url}/deposit/tabel_depo`,
        },
        'columns': [{
                'data': 'id'
            }, {
                'data': 'noref'
            }, {
                'data': 'paket'
            }, {
                'data': 'nominal',
                render: function(data){
                    return 'Rp. ' + parseInt( data ).toLocaleString().replace(',', '.') + ',-';
                }
            }, {
                'data': 'metode'
            }, {
                'data': 'expired',
                render: function(data, type, row){
                    if(row.tipe == 'manual'){
                        return '<span class="badge bg-info">manual</span>';
                    } else {
                        return data;
                    }
                }
            }, {
                'data': 'status',
                render: function(data){
                    if (data == 'BELUM BAYAR') {
                        return `<span class="badge bg-warning">${data}</span>`;
                    } else if (data == 'LUNAS') {
                        return `<span class="badge bg-success">${data}</span>`;
                    } else {
                        return `<span class="badge bg-danger">${data}</span>`;
                    } 
                }
            }, {
                'data': 'id',
                render: function(data, type, row){
                    var htm = [
                        `<a href="/deposit/pembayaran/${data}" class="btn btn-primary waves-effect waves-light"><i class='bx bx-cart font-size-16 align-middle'></i></a>`,
                        `<button" type="button" class="btn btn-${(row.status == 'BELUM BAYAR') ? 'danger' : 'secondary'} waves-effect waves-light" ${(row.status == 'BELUM BAYAR') ? 'onclick="confirmDeleteDepo('+data+')"' : ''}><i class='bx bx-trash-alt font-size-16 align-middle'></i></button>`
                    ];

                    return htm.join(' ');
                }
            }
        ],
        'order': [
            [0, "desc"]
        ],
    });
});

// tabel riwayat admin
$(document).ready(function() {
    $('#riwayat_depo_admin').DataTable({
        'processing': true,
        'serverSide': true,
        'lengthChange': true,
        'autoWidth': true,
        'serverMethod': 'post',
        'ajax': {
            "url": `${site_url}/deposit/tabel_depo`,
        },
        'columns': [{
                'data': 'id'
            }, {
                'data': 'email'
            }, {
                'data': 'noref'
            }, {
                'data': 'paket'
            }, {
                'data': 'nominal',
                render: function(data){
                    return 'Rp. ' + parseInt( data ).toLocaleString().replace(',', '.') + ',-';
                }
            }, {
                'data': 'metode'
            }, {
                'data': 'expired',
                render: function(data, type, row){
                    if(row.tipe == 'manual'){
                        return '<span class="badge bg-info">manual</span>';
                    } else {
                        return data;
                    }
                }
            }, {
                'data': 'status',
                render: function(data){
                    if (data == 'BELUM BAYAR') {
                        return `<span class="badge bg-warning">${data}</span>`;
                    } else if (data == 'LUNAS') {
                        return `<span class="badge bg-success">${data}</span>`;
                    } else {
                        return `<span class="badge bg-danger">${data}</span>`;
                    } 
                }
            }, {
                'data': 'id',
                render: function(data, type, row){
                    var htm = [
                        `<a href="/deposit/pembayaran/${data}" class="btn btn-primary waves-effect waves-light"><i class='bx bx-cart font-size-16 align-middle'></i></a>`,
                        `<button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" class="btn btn-success waves-effect waves-light" onclick="editDepo('${data}')"><i class='bx bx-pencil font-size-16 align-middle'></i></button>`,
                        `<button type="button" class="btn btn-danger waves-effect waves-light" onclick="confirmDeleteDepo('${data}')"><i class='bx bx-trash-alt font-size-16 align-middle'></i></button>`,
                    ];

                    return htm.join(' ');
                }
            }
        ],
        'order': [
            [0, "desc"]
        ],
    });
});


function editDepo(id){
    $.ajax({
        url: site_url + '/deposit/editDepo/' + id,
        type: 'get',
        success: function(hasil){
            var obj = $.parseJSON(hasil);
            if(obj.error){
                Swal.fire(obj.teks, '', "error");
            } else {
                $('#id').val(obj.depo.id);
                $('#noref').val(obj.depo.noref);
                $('#metode').val(obj.depo.metode);
                $('#email').val(obj.email);
                $('#paket').val(obj.depo.paket);
                $('#nominal').val(obj.depo.nominal);
                $("#depostatus").val(obj.depo.status).change();
            }
        }
    })
}

function saveChangeDepo(){
    $.ajax({
        url: site_url + '/deposit/saveChangeDepo',
        type: 'post',
        data: {
            'id': $('#id').val(),
            'depostatus': $("#depostatus").val(),
        },
        success: function(hasil){
            var obj = $.parseJSON(hasil);
            if(obj.error){
                $('#exampleModalScrollable').modal('hide');
                Swal.fire(obj.teks, '', "error");
                $('#riwayat_depo_admin').DataTable().ajax.reload();
            } else {
                $('#exampleModalScrollable').modal('hide');
                Swal.fire(obj.teks, '', "success");
                $('#riwayat_depo_admin').DataTable().ajax.reload();
            }
        }
    })   
}