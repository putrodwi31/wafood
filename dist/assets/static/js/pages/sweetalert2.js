const Swal2 = Swal.mixin({
  customClass: {
    input: 'form-control'
  }
})
$('#multiple-select-field').select2({
  theme: "bootstrap-5",
  width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
  placeholder: $(this).data('placeholder'),
  closeOnSelect: false,
});
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
$(document).ready(function () {
  $("#jumlah").inputSpinner();
  $(document).on('click', '#select', function () {
    // mengambil data dari tombol select 
    var id_menu = $(this).data('id_menu');
    var nama_menu = $(this).data('nama');
    var harga = $(this).data('harga');
    var stok = $(this).data('stok');
    // input ke tiap-tiap elemet
    $('#id_menu').val(id_menu);
    $('#nama_menu').val(nama_menu);
    $('#harga').val(harga);
    $('#stok').val(stok);
    $('#jumlah').attr('max', stok);
    $('#inlineForm .close').click();
  });
  $(document).on('click', '#printtrans', function () {
    // mengambil data dari tombol select 
    var no = $(this).data('no');
    window.open('cetak_struk/' + no, '_blank')
  });
  $(document).on('click', '#menunggu_pembayaran', function () {
    var token = $(this).data('token');
    var no_transaksi = $(this).data('no_transaksi');
    window.snap.pay(token, {
      onSuccess: function (result) {
        $.ajax({
          url: "transaksi_proses",
          type: 'POST',
          dataType: 'json',
          data: {
            'status_sukses': true,
            'no_transaksi': no_transaksi,
          },
          statusCode: {
            200: function (response) {
              console.log(response)
              if (response.success == true) {
                // alert('Berhasil menambahkan cart ke db');
                Toastify({
                  text: "Pembayaran Berhasil",
                  duration: 3000,
                  close: true,
                  gravity: "top",
                  position: "right",
                  backgroundColor: "#4fbe87",
                }).showToast()
                updatestok(no_transaksi);
                window.open('cetak_struk/' + no_transaksi, '_blank')
                setTimeout(function () {
                  location.reload();
                }, 5000);
              } else {
                alert('Gagal menambahkan token ke db!');
              }
            }
          },
        });
      },
      onPending: function (result) {

        Toastify({
          text: "Menunggu Pembayaran",
          duration: 3000,
          close: true,
          gravity: "top",
          position: "right",
          backgroundColor: "#4fbe87",
        }).showToast()

      },
      onError: function (result) {
        $.ajax({
          url: "transaksi_proses",
          type: 'POST',
          dataType: 'json',
          data: {
            'status_error': true,
            'no_transaksi': no_transaksi,
          },
          statusCode: {
            200: function (response) {
              console.log(response)
              if (response.success == true) {
                // alert('Berhasil menambahkan cart ke db');
                Toastify({
                  text: "Pembayaran Gagal",
                  duration: 3000,
                  close: true,
                  gravity: "top",
                  position: "right",
                  backgroundColor: "#be4f4f",
                }).showToast()
              } else {
                alert('Gagal menambahkan ke db!');
              }
            }
          },
        });
      },
      onClose: function () {
        $.ajax({
          url: "transaksi_proses",
          type: 'POST',
          dataType: 'json',
          data: {
            'status_error': true,
            'no_transaksi': no_transaksi,
          },
          statusCode: {
            200: function (response) {
              console.log(response)
              if (response.success == true) {
                // alert('Berhasil menambahkan cart ke db');
                Toastify({
                  text: "Pembayaran Kadaluarsa",
                  duration: 3000,
                  close: true,
                  gravity: "top",
                  position: "right",
                  backgroundColor: "#be4f4f",
                }).showToast()
              } else {
                alert('Gagal menambahkan ke db!');
              }
            }
          },
        });

      }
    })
  });
  $(document).on('click', '#add_cart', function () {
    var id_menu = $("#id_menu").val();
    var jumlah = $("#jumlah").val();
    var no_transaksi = $("#notrx").text();
    var nama_mn = $("#nama_menu").val()
    console.log(id_menu)
    // jika produk belum dipilih
    if (id_menu == '') {
      Toastify({
        text: "menu belum dipilih!",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#be4f4f",
      }).showToast()
      $("#nama_menu").focus()
    } else {
      // kirim data menggunakan ajax
      $.ajax({
        url: "transaksi_proses",
        type: 'POST',
        dataType: 'json',
        data: {
          'add_cart': true,
          'id_menu': id_menu,
          'no_transaksi': no_transaksi,
          'jumlah': jumlah
        },
        statusCode: {
          200: function (response) {
            console.log(response)
            if (response.success == true) {
              // alert('Berhasil menambahkan cart ke db');
              Toastify({
                text: nama_mn + " ditambahkan",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#4fbe87",
              }).showToast()
              $("#tabel_keranjang").load('transaksi_data', function () {
                kalkulasi();
              });
              // hapus value di beberapa element
              $("#nama_menu").val('');
              $("#jumlah").val(1);
            } else {
              alert('Gagal menambahkan item ke keranjang!');
            }
          }
        },
      });
    }
  });
  $(document).on('click', '#hapus_transaksi_data', function () {

    Swal.fire({
      title: 'Apakah anda yakin?',
      showCancelButton: true,
      cancelButtonText: 'Batal',
      confirmButtonText: 'Ya'
    }).then((result) => {
      if (result.isConfirmed) {
        var idtransaksi_data = $(this).data('idtransaksi_data');

        $.ajax({
          url: 'hapus_transaksi_data',
          type: 'POST',
          dataType: 'json',
          data: { 'idtransaksi_data': idtransaksi_data },
          success: function (result) {
            if (result.success == true) {
              Toastify({
                text: result.nama_menu + " dihapus",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#be4f4f",
              }).showToast()
              $("#tabel_keranjang").load('transaksi_data', function () {
                kalkulasi();
              });
            } else {
              alert('Gagal menghapus item keranjang');
            }
          }
        });
      }
    })
  });
  $(document).on('click', '#edit_transaksi_data', function () {
    // mengambil data dari tombol select 
    var kd_menu = $(this).data('kd');
    var id_menu = $(this).data('idmenu');
    var id = $(this).data('iddetail');
    var nama_menu = $(this).data('nama_menu');
    var harga = $(this).data('harga');
    var jumlah = $(this).data('jumlah');
    var total = $(this).data('total');

    // input ke tiap-tiap elemet
    $('#pilkd_menu').val(kd_menu);
    $('#pilid_menu').val(id_menu);
    $('#pilid_detailtransaksi').val(id);
    $('#pilnama_menu').val(nama_menu);
    $('#pilharga').val(harga);
    $('#piljumlah').val(jumlah);
    $('#piltotal').val(total);
  });
  $(document).on('change', '#metode', function () {
    var metode = $("#metode").val();
    if (metode == '1') {
      Toastify({
        text: "Pembayaran Tunai dipilih",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#4fbe87",
      }).showToast()
      $("#proses_pembayaran").removeAttr("disabled");
      $("#tunai").show()
    } else if (metode == '2') {
      Toastify({
        text: "Pembayaran Nontunai dipilih",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#4fbe87",
      }).showToast()
      $("#proses_pembayaran").removeAttr("disabled");
      $("#tunai").hide()
    } else {
      $("#tunai").hide()
      $("#proses_pembayaran").attr("disabled", true);
    }
  })

  $(document).on('keyup mouseup', '#tunaibay', function () {
    kalkulasi();
  });
  $(document).on('click', '#proses_pembayaran', function () {
    var metode = $("#metode").val()
    var no_transaksi = $("#notrx").text();
    var subtotal = $("#sub_total").val()
    var tunai = $("#tunaibay").val()
    var kembalian = $("#kembalian").val()
    var tanggal = $("#tanggal").val()
    var nama_pel = $("#nama_pel").val()
    var total_harga = $('#grand_total2').text()
    let tokken = null;
    if (metode == '1') {
      if (subtotal < 1) {
        Toastify({
          text: "Belum ada produk item yang dipilih!",
          duration: 3000,
          close: true,
          gravity: "top",
          position: "right",
          backgroundColor: "#be4f4f",
        }).showToast()
        $("#nama_menu").focus()
      } else if (tunai < 1) {
        Toastify({
          text: "Jumlah uang tunai belum diinput!",
          duration: 3000,
          close: true,
          gravity: "top",
          position: "right",
          backgroundColor: "#be4f4f",
        }).showToast()
        $("#tunai").focus()
      } else if (tunai < total_harga) {
        Toastify({
          text: "Jumlah uang tunai tidak cukup!",
          duration: 3000,
          close: true,
          gravity: "top",
          position: "right",
          backgroundColor: "#be4f4f",
        }).showToast()
        $("#tunai").focus()
      } else {
        Swal.fire({
          title: 'Yakin proses transaksi sudah benar?',
          showCancelButton: true,
          cancelButtonText: 'Batal',
          confirmButtonText: 'Ya'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'transaksi_proses',
              type: 'POST',
              dataType: 'json',
              data: {
                'proses_pembayaran': true,
                'subtotal': subtotal,
                'tunai': tunai,
                'kembalian': kembalian,
                'tanggal': tanggal,
                'metode': metode,
                'no_transaksi': no_transaksi,
                'nama_pel': nama_pel,
                'total_harga': total_harga,
              },
              success: function (result) {
                if (result.success == true) {
                  // alert('Transaksi berhasil!');
                  $("#tabel_keranjang").load('transaksi_data', function () {
                    kalkulasi();
                    window.open('cetak_struk/' + result.no, '_blank')
                  });
                  updatestok(no_transaksi);
                  setTimeout(function () {
                    location.reload();
                  }, 5000);
                } else {
                  // jika gagal
                  alert('Transaksi gagal!');
                  location.href = 'penjualan';
                }
              }
            });
          }
        })
      }
    } else if (metode == '2') {
      if (subtotal < 1) {
        Toastify({
          text: "Belum ada produk item yang dipilih!",
          duration: 3000,
          close: true,
          gravity: "top",
          position: "right",
          backgroundColor: "#be4f4f",
        }).showToast()
        $("#nama_menu").focus()
      } else {
        Swal.fire({
          title: 'Yakin proses transaksi sudah benar?',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'reqPayment',
              type: 'POST',
              dataType: 'json',
              data: {
                'tanggal': tanggal,
                'metode': metode,
                'no_transaksi': no_transaksi,
                'nama_pem': nama_pel,
                'total_harga': total_harga,
              },
              success: function (result) {
                if (result.success == true) {
                  tokken = result.token
                  window.snap.pay(tokken, {
                    onSuccess: function (result) {
                      $.ajax({
                        url: "transaksi_proses",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                          'status_sukses': true,
                          'no_transaksi': no_transaksi,
                        },
                        statusCode: {
                          200: function (response) {
                            console.log(response)
                            if (response.success == true) {
                              // alert('Berhasil menambahkan cart ke db');
                              Toastify({
                                text: "Pembayaran Berhasil",
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#4fbe87",
                              }).showToast()
                              $("#tabel_keranjang").load('transaksi_data', function () {
                                kalkulasi();
                                window.open('cetak_struk/' + no_transaksi, '_blank')
                              });
                              updatestok(no_transaksi);
                              setTimeout(function () {
                                location.reload();
                              }, 5000);
                            } else {
                              alert('Gagal menambahkan token ke db!');
                            }
                          }
                        },
                      });
                    },
                    onPending: function (result) {
                      $.ajax({
                        url: "transaksi_proses",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                          'save_token': true,
                          'token': tokken,
                          'no_transaksi': no_transaksi,
                        },
                        statusCode: {
                          200: function (response) {
                            console.log(response)
                            if (response.success == true) {
                              // alert('Berhasil menambahkan cart ke db');
                              Toastify({
                                text: "Token pembayaran tersimpan",
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#4fbe87",
                              }).showToast()
                              $("#tabel_keranjang").load('transaksi_data', function () {
                                kalkulasi();
                              });
                              setTimeout(function () {
                                location.reload();
                              }, 5000);
                            } else {
                              alert('Gagal menambahkan token ke db!');
                            }
                          }
                        },
                      });
                    },
                    onError: function (result) {
                      $.ajax({
                        url: "transaksi_proses",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                          'status_error': true,
                          'no_transaksi': no_transaksi,
                        },
                        statusCode: {
                          200: function (response) {
                            console.log(response)
                            if (response.success == true) {
                              // alert('Berhasil menambahkan cart ke db');
                              Toastify({
                                text: "Pembayaran Gagal",
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#be4f4f",
                              }).showToast()
                              $("#tabel_keranjang").load('transaksi_data', function () {
                                kalkulasi();
                              });
                              setTimeout(function () {
                                location.reload();
                              }, 5000);
                            } else {
                              alert('Gagal menambahkan ke db!');
                            }
                          }
                        },
                      });
                      alert("payment failed!");
                      console.log(result);
                    },
                    onClose: function () {
                      $.ajax({
                        url: "transaksi_proses",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                          'status_close': true,
                          'no_transaksi': no_transaksi,
                        },
                        statusCode: {
                          200: function (response) {
                            console.log(response)
                            if (response.success == true) {
                              // alert('Berhasil menambahkan cart ke db');
                              Toastify({
                                text: "Proses pembayaran Dibatalkan",
                                duration: 3000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#be4f4f",
                              }).showToast()
                              $("#tabel_keranjang").load('transaksi_data', function () {
                                kalkulasi();
                              });
                              setTimeout(function () {
                                location.reload();
                              }, 5000);
                            } else {
                              alert('Gagal menambahkan ke db!');
                            }
                          }
                        },
                      });
                    }
                  })
                } else {
                  Toastify({
                    text: "Transaksi Gagal",
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#be4f4f",
                  }).showToast()
                }
              }
            });
          }
        })

      }


    }
  });
  $(document).on('click', '#batal_pembayaran', function () {
    var total_harga = $("#sub_total").val();
    if (total_harga != '0') {
      var no_transaksi = $("#notrx").text();
      Swal.fire({
        title: 'Apakah anda yakin?',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'hapus_transaksi_data',
            type: 'POST',
            dataType: 'json',
            data: { 'batal_pembayaran': true, 'idTrans': no_transaksi },
            success: function (result) {
              if (result.success == true) {
                // alert('Berhasil menambahkan cart ke db');
                $("#tabel_keranjang").load('transaksi_data', function () {
                  kalkulasi();
                });
                $("#nama_menu").val('')
                $("#nama_menu").focus()
              }
            }
          })
        }
      })
    } else {
      Toastify({
        text: "Pilih menu dahulu!",
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "#be4f4f",
      }).showToast()
    }

  });
  $(document).on('click', '#updatepilmenu', function () {
    var id_menu = $("#pilid_menu").val();
    var jumlah = $("#piljumlah").val();
    var id = $("#pilid_detailtransaksi").val();

    if (jumlah == '' || jumlah < 1) {
      // kuantiti tidak boleh kosong minimal 1
      alert('jumlah tidak boleh kosong!')
      $("#piljumlah").val(1)
      $("#piljumlah").focus()
    } else {
      $.ajax({
        url: "transaksi_proses",
        type: 'POST',
        dataType: 'json',
        data: {
          'edit_cart': true,
          'jumlah': jumlah,
          'id': id,
          'id_menu': id_menu
        },
        success: function (result) {
          if (result.success == true) {
            // alert('Berhasil menambahkan cart ke db');
            $("#tabel_keranjang").load('transaksi_data', function () {
              kalkulasi();
            });
            $('#modal-item-edit .close').click()
          } else {
            // jika gagal
            alert('Data item keranjang tidak terupdate!');
          }
        }
      });
    }
  });

  // update live di modal
  function count_edit_modal() {
    var harga = $("#pilharga").val()
    var jumlah = $("#piljumlah").val()

    total = harga * jumlah
    $("#piltotal").val(total)
  }

  // jika kolom harga, qyt, dan diskon di edit otomatis terupdate
  $(document).on('keyup mouseup', '#piljumlah', function () {
    count_edit_modal();
    kalkulasi();
  });
  function updatestok(stok) {
    console.log(stok)
    $.ajax({
      url: "updateStok",
      type: 'POST',
      dataType: 'json',
      data: {
        'no': stok
      },
      success: function (result) {
        if (result.success == true) {
          console.log("success");

        } else {
          // jika gagal
          console.log('Data item keranjang tidak terupdate!');
        }
      },
      timeout: 100000
    });
  }
  function kalkulasi() {
    var subtotal = 0;
    $("#tabel_keranjang tr").each(function () {
      subtotal += parseInt($(this).find('#total').text())
    })

    isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)
    var grand_total = subtotal
    if (isNaN(grand_total)) {
      $('#grand_total2').text(0)
    } else {
      $('#grand_total2').text(grand_total)
    }

    var tunai = $('#tunaibay').val()
    tunai != 0 ? $('#kembalian').val(tunai - grand_total) : $('#kembalian').val(0)
    kembalian = $("#kembalian").val()
    if (isNaN(kembalian)) {
      $("#kembalian").val(0)
      $("#tunai").val(0)
    }
  }
  kalkulasi();
})
function getDel(id) {
  const getDel = document.getElementById("delwafood" + id)
  Swal2.fire({
    title: 'Apakah anda ingin menghapus ' + getDel.dataset.nama + ' ?',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.replace(getDel.dataset.link)
    }
  })
}