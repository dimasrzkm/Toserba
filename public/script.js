// mendapatkan nilai url
let url = (window.location.hostname === "localhost") ? "localhost:8080" : "toserba.store";
// mendaptkan element trigger tombol floating tambah
let triggerTambah = document.querySelector('.trigger-tambah');
// membuat private method untuk counter nilai
let counter = (function counterAdd() {
  let number = 2;
  return function () {
    return number++;
  }
})();
// Event click tombol floating tambah
triggerTambah.addEventListener('click', () => {
  // mencari berapa banyak element yang memiliki class select-barang
  let jumlahSelect = document.querySelectorAll('.select-barang');
  // melakukan counter
  let counterNomor = counter();
  // mendpatkan element sesuai dengan nilai counter sekarang
  let wrapperTambahan = document.querySelector(`.wrapper-tambahan-${counterNomor}`);
  // memeriskan apakah nilai couner lebih kecil dari jumlah kseluruhan nilai Jumlah Select
  if (counterNomor <= jumlahSelect.length) {
    // mengganti class hidden dengan show untuk menampilkan element
    wrapperTambahan.classList.replace('hidden', 'show');
  }
});
let selectTambahan = document.querySelectorAll('#barangs');
selectTambahan.forEach(select => {
  select.addEventListener('change', event => {
    let namaKelas  = event.target.className;
    let nomorTerakhirKelas = namaKelas.charAt(namaKelas.length - 1);
    let hargaBarang = document.querySelector(`.harga${nomorTerakhirKelas}`);
    let labelHarga = document.querySelector(`.label-harga-${nomorTerakhirKelas}`);
    fetch(`http://${url}/api`)
    .then(response => {
      return response.json();
    }).then(data => {
      data.map(e => {
        if (select.options[select.selectedIndex].value === e.id_barang) {
          hargaBarang.setAttribute('value', `${e.harga_barang} / ${e.satuan}`);
          labelHarga.classList.add('active');
        } 
      });
    }).catch(error => {
      throw(error.message);
    });
  });
});