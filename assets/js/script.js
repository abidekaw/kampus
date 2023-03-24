console.log('OK');

// live  search without jquery
// let search = document.querySelector('#search');
// let submit = document.querySelector('#submit');
// let content = document.querySelector('#content');

// search.addEventListener('keyup', () => {
//    let xhr = new XMLHttpRequest();

//    xhr.onreadystatechange = () => {
//       if (xhr.readyState == 4 && xhr.status == 200) {
//          content.innerHTML = xhr.responseText;
//       }
//    };

//    xhr.open('GET', 'ajax/mahasiswa.php?keyword=' + search.value, true);
//    xhr.send();
// });

// live search jquery (AJAX)
$(document).ready(() => {
   // hilangkan tombol cari
   $('#submit').hide();

   // event ketika search ditulis
   $('#search').on('keyup', () => {
      // ajax tanpa loading icon
      // $('#content').load('ajax/mahasiswa.php?keyword=' + $('#search').val());
      // });

      // show icon loading
      $('.loader').show();

      // ajax dengan loading icon
      $.get('ajax/mahasiswa.php?keyword=' + $('#search').val(), (data) => {
         $('#content').html(data);
         $('.loader').hide();
      });
   });
});
