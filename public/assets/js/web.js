document.addEventListener('DOMContentLoaded', () => {
  const header = document.getElementById('header');
  const backToTopButton = document.getElementById('backtotopBtn');

  // Fungsi untuk menggulir ke atas halaman
  backToTopButton.addEventListener('click', () => {
    window.scrollTo({top: 0,behavior: 'smooth'});
  });


  // Fungsi untuk memeriksa posisi scroll dan menambah/menghapus kelas 'scrolled'
  const checkScroll = () => {
    if ((document.documentElement.scrollTop || document.body.scrollTop) > 20) {
      header.classList.add('scrolled');
      backToTopButton.classList.add('show');
    } else {
      header.classList.remove('scrolled');
      backToTopButton.classList.remove('show');
    }
  };

  // Memeriksa posisi scroll saat DOM selesai dimuat
  checkScroll();

  // Memeriksa posisi scroll saat pengguna menggulir halaman
  window.addEventListener('scroll', checkScroll);
});