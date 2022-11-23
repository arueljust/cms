// yajra datatbles
$(document).ready(function () {
    $("#siswa-table").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#table-url").val(),
        },
        columns: [
            {
                data: "cek",
                name: "cek",
                orderable: false,
                searchable: false,
            },
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                width: "10px",
                orderable: false,
                searchable: false,
            },
            // { data: "foto", name: "foto" },
            { data: "nama", name: "nama" },
            { data: "ttl", name: "ttl" },
            { data: "no_telp", name: "no_telp" },
            { data: "nama_ortu", name: "nama_ortu" },
            { data: "kelas.kelas", name: "kelas.kelas" },
            { data: "jenis_kelamin", name: "jenis_kelamin" },
            {
                data: "options",
                name: "options",
                orderable: false,
                searchable: false,
            },
        ],
    }).on('draw',function(){
        $('input[name="checkbox"]').each(function(){this.checked=false;});
        $('input[name="main_checkbox"]').prop('checked',false);
        $('#delete').addClass('d-none');
    })
});

$("#tambah").on("click", function () {
    $("#staticBackdropLabel").html(
        '<h5 class="modal-title" id="staticBackdropLabel"><strong class="text-dark">Tambah Data</strong> <strong class="text-warning">Siswa</strong></h5>');
    $("#nama").val(null);
    $("#alamat").val(null);
    $("#ttl").val(null);
    $("#no_telp").val(null);
    $("#nama_ortu").val(null);
    $("#kelas_id").val(null);
    $("#jenis_kelamin").val(null);
    $("#foto").val(null);
    $("#save").text("Simpan");
});

$("#save").on("click", function () {
    if ($(this).text() === "Update") {
        edit();
    } else {
        add();
    }
});

// panggil function edit berdasarkan id untuk menedit data
$(document).on("click", ".edit", function () {
    let id = $(this).attr("id");
    // buka modal nya untuk edit data
    $("#tambah").click();
    // ubah button simpan jadi "update"
    $("#save").text("Update");
    // ubah text-header jadi edit
    $("#staticBackdropLabel").html(
        '<h5 class="modal-title" id="staticBackdropLabel"><strong class="text-dark">Edit Data</strong> <strong class="text-warning">Siswa</strong></h5>'
    );
    // data
    $.ajax({
        url: "/admin/siswa/edit",
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            id: id,
        },
        success: function (res) {
            $("#id").val(res.data.id);
            $("#nama").val(res.data.nama);
            $("#alamat").val(res.data.alamat);
            $("#ttl").val(res.data.ttl);
            $("#no_telp").val(res.data.no_telp);
            $("#nama_ortu").val(res.data.nama_ortu);
            $("#kelas_id").val(res.data.kelas_id);
            $("#jenis_kelamin").val(res.data.jenis_kelamin);
            $("#foto").val(res.data.foto);
        },
    });
    // ketika data tidak jadi di edit dan menekan tombol batal maka akan menjalankan function ini
    $("#close").on("click", function () {
        $("#save").text("Simpan");
        $("#nama").val(null);
        $("#alamat").val(null);
        $("#ttl").val(null);
        $("#no_telp").val(null);
        $("#nama_ortu").val(null);
        $("#kelas_id").val(null);
        $("#jenis_kelamin").val(null);
        $("#foto").val(null);
    });
});
// function tambah data
function add() {
    $.ajax({
        url: "/admin/siswa/store",
        type: "post",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            nama: $("#nama").val(),
            alamat: $("#alamat").val(),
            ttl: $("#ttl").val(),
            no_telp: $("#no_telp").val(),
            nama_ortu: $("#nama_ortu").val(),
            kelas_id: $("#kelas_id").val(),
            jenis_kelamin: $("#jenis_kelamin").val(),
            foto: $("#foto").val(),
        },
        success: function (data) {
            Swal.fire({
                type: "success",
                icon: "success",
                title: "Data ditambah",
                showConfirmButton: false,
                timer: 3000,
            });

            $("#close").click();
            $("#siswa-table").DataTable().ajax.reload();
            $("#nama").val(null);
            $("#alamat").val(null);
            $("#ttl").val(null);
            $("#no_telp").val(null);
            $("#nama_ortu").val(null);
            $("#kelas_id").val(null);
            $("#jenis_kelamin").val(null);
            $("#foto").val(null);
        },
        error: function (data) {
            alert(data.responseJSON.message);
        },
    });
    $("#close").on("click", function () {
        $("#save").text("Simpan");
        $("#nama").val(null);
        $("#alamat").val(null);
        $("#ttl").val(null);
        $("#no_telp").val(null);
        $("#nama_ortu").val(null);
        $("#kelas_id").val(null);
        $("#jenis_kelamin").val(null);
        $("#foto").val(null);
    });
}

// function update data
function edit() {
    $.ajax({
        url: "/admin/siswa/update",
        type: "post",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            id: $("#id").val(),
            nama: $("#nama").val(),
            alamat: $("#alamat").val(),
            ttl: $("#ttl").val(),
            no_telp: $("#no_telp").val(),
            nama_ortu: $("#nama_ortu").val(),
            kelas_id: $("#kelas_id").val(),
            jenis_kelamin: $("#jenis_kelamin").val(),
            foto: $("#foto").val(),
        },
        success: function () {
            Swal.fire({
                type: "success",
                icon: "success",
                title: "Data diupdate",
                showConfirmButton: false,
                timer: 3000,
            });
            // jika sukses kosongkan modal form
            $("#close").click();
            $("#siswa-table").DataTable().ajax.reload();
            $("#nama").val(null);
            $("#alamat").val(null);
            $("#ttl").val(null);
            $("#no_telp").val(null);
            $("#nama_ortu").val(null);
            $("#kelas_id").val(null);
            $("#jenis_kelamin").val(null);
            $("#foto").val(null);
            $("#save").text("Simpan");
        },
        error: function (xhr) {
            alert(xhr.responseJSON.text);
            // jika gagal kosongkan modal form
            $("#close").click();
            $("#siswa-table").DataTable().ajax.reload();
            $("#nama").val(null);
            $("#alamat").val(null);
            $("#ttl").val(null);
            $("#no_telp").val(null);
            $("#nama_ortu").val(null);
            $("#kelas_id").val(null);
            $("#jenis_kelamin").val(null);
            $("#foto").val(null);
        },
    });
}

// panggil function delete berdasarkan id untuk hapus data
$(document).on("click", ".delete", function () {
    let id = $(this).attr("id");

    Swal.fire({
        title: "Apakah Kamu Yakin?",
        text: "Ingin menghapus data ini!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Tidak",
        confirmButtonText: "Hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/admin/siswa/delete",
                type: "post",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    id: id,
                    multi: null,
                },
                success: function (params) {
                    Swal.fire({
                        type: "success",
                        icon: "success",
                        title: "Data dihapus !",
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    $("#siswa-table").DataTable().ajax.reload();
                },
            });
        }
    });
});

// function select checkbox
$(document).on("click", 'input[name="main_checkbox"]', function () {
    if (this.checked) {
        $('input[name="checkbox"]').each(function () {
            this.checked = true;
        });
    } else {
        $('input[name="checkbox"]').each(function () {
            this.checked = false;
        });
    }
    multipleDelete();
});

// function ketika semua check box terselect maka otomatis check pada header (checkall) menyala
$(document).on("change", 'input[name="checkbox"]', function () {

    if ($('input[name="checkbox"]').length == $('input[name="checkbox"]:checked').length) {
        $('input[name="main_checkbox"]').prop("checked", true);
    } else {
        $('input[name="main_checkbox"]').prop("checked", false);
    }
    multipleDelete();
});

// tampilka multiple delete button apabila checkbox terselect
function multipleDelete() {
    if ($('input[name="checkbox"]:checked').length > 0) {
        $("#delete").text("Hapus ("+$('input[name="checkbox"]:checked').length +") Data")
            .removeClass("d-none");
    } else {
        $("#delete").addClass("d-none");
    }
}


// function multi delete
$(document).on('click','#delete',function(){
    let checkedAll=[];
      $('input[name="checkbox"]:checked').each(function(){
        checkedAll.push($(this).attr('id'));
    });
         Swal.fire({
                title: "Apakah Kamu Yakin?",
                text: "Ingin menghapus data ini!",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Tidak",
                confirmButtonText: "Hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/siswa/delete",
                        type: "post",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        data: {
                            data: checkedAll,
                            multi: 1,
                        },
                        success: function (params) {
                            Swal.fire({
                                type: "success",
                                icon: "success",
                                title: "Data dihapus !",
                                showConfirmButton: false,
                                timer: 3000,
                            });
                            $("#siswa-table").DataTable().ajax.reload();
                        },
                    });
                }
            });

});
