'use strict';

$(function () {
  $('#sidebar__menuWrapper').slimScroll({
    height: 'calc(100vh - 86.75px)'
  });
});

$(function () {
  $('.dropdown-menu__body').slimScroll({
    height: '270px'
  });
});

// modal-dialog-scrollable
$(function () {
  $('.modal-dialog-scrollable .modal-body').slimScroll({
    height: '100%'
  });
});

// activity-list 
$(function () {
  $('.activity-list').slimScroll({
    height: '385px'
  });
});

// recent ticket list 
$(function () {
  $('.recent-ticket-list__body').slimScroll({
    height: '295px'
  });
});





$('#navbar-search__field').on('input', function () {
  var search = $(this).val().toLowerCase();


  var search_result_pane = $('.navbar_search_result');
  $(search_result_pane).html('');
  if (search.length == 0) {
    return;
  }

  // search
  var match = $('.sidebar__menu-wrapper .nav-link').filter(function (idx, elem) {
    return $(elem).text().trim().toLowerCase().indexOf(search) >= 0 ? elem : null;
  }).sort();




  // show search result
  // search not found
  if (match.length == 0) {
    $(search_result_pane).append('<li class="text-muted pl-5">No search result found.</li>');
    return;
  }
  // search found
  match.each(function (idx, elem) {
    var item_url = $(elem).attr('href') || $(elem).data('default-url');
    var item_text = $(elem).text().replace(/(\d+)/g, '').trim();
    $(search_result_pane).append(`<li><a href="${item_url}">${item_text}</a></li>`);
  });


});

// $(".sidebar-dropdown > a").click(function() {
//   $(".sidebar-submenu").slideUp(200);
//   if (
//     $(this)
//       .parent()
//       .hasClass("open")
//   ) {
//     $(".sidebar-dropdown").removeClass("open");
//     $(this)
//       .parent()
//       .removeClass("open");
//   } else {
//     $(".sidebar-dropdown").removeClass("open");
//     $(this)
//       .next(".sidebar-submenu")
//       .slideDown(200);
//     $(this)
//       .parent()
//       .addClass("open");
//   }
// });

let img = $('.bg_img');
img.css('background-image', function () {
  let bg = ('url(' + $(this).data('background') + ')');
  return bg;
});

const navTgg = $('.navbar__expand');
navTgg.on('click', function () {
  $(this).toggleClass('active');
  $('.sidebar').toggleClass('active');
  $('.navbar-wrapper').toggleClass('active');
  $('.body-wrapper').toggleClass('active');
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('.nice-select').niceSelect();

// navbar-search 
$('.navbar-search__btn-open').on('click', function () {
  $('.navbar-search').addClass('active');
});

$('.navbar-search__close').on('click', function () {
  $('.navbar-search').removeClass('active');
});

// responsive sidebar expand js 
$('.res-sidebar-open-btn').on('click', function () {
  $('.sidebar').addClass('open');
  $('#overlay').removeClass('d-none');
});
$('#overlay').on('click', function () {
  $('.sidebar').removeClass('open');
  $('#overlay').addClass('d-none');
});
$('.res-sidebar-close-btn').on('click', function () {
  $('.sidebar').removeClass('open');
});

/* Get the documentElement (<html>) to display the page in fullscreen */
let elem = document.documentElement;

/* View in fullscreen */
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }
}

$('.fullscreen-btn').on('click', function () {
  $(this).toggleClass('active');
});

$('.sidebar-dropdown > a').on('click', function () {
  if ($(this).parent().find('.sidebar-submenu').length) {
    if ($(this).parent().find('.sidebar-submenu').first().is(':visible')) {
      $(this).find('.side-menu__sub-icon').removeClass('transform rotate-180');
      $(this).removeClass('side-menu--open');
      $(this).parent().find('.sidebar-submenu').first().slideUp({
        done: function done() {
          $(this).removeClass('sidebar-submenu__open');
        }
      });
    } else {
      $(this).find('.side-menu__sub-icon').addClass('transform rotate-180');
      $(this).addClass('side-menu--open');
      $(this).parent().find('.sidebar-submenu').first().slideDown({
        done: function done() {
          $(this).addClass('sidebar-submenu__open');
        }
      });
    }
  }
});

// select-2 init
$('.select2-basic').select2();
$('.select2-multi-select').select2();
$(".select2-auto-tokenize").select2({
  tags: true,
  tokenSeparators: [',']
});

// data table init
// $(document).ready(function() {

//   // $('#default-data-table').DataTable();
//   $('table.default-data-table').DataTable();

//   $('#scroll-vertical-datatable').DataTable( {
//     "scrollY": "300px",
//     "scrollCollapse": true,
//     "paging":         false
//   });


//   $('#buttons-datatable').DataTable( {
//     dom: 'Bfrtip',
//     buttons: [
//       'copy', 'csv', 'excel', 'pdf', 'print'
//     ]
//   });

// });


function proPicURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      var preview = $(input).parents('.thumb').find('.profilePicPreview');
      $(preview).css('background-image', 'url(' + e.target.result + ')');
      $(preview).addClass('has-image');
      $(preview).hide();
      $(preview).fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$(".profilePicUpload").on('change', function () {
  proPicURL(this);
});

$(".remove-image").on('click', function () {
  $(this).parents(".profilePicPreview").css('background-image', 'none');
  $(this).parents(".profilePicPreview").removeClass('has-image');
  $(this).parents(".thumb").find('input[type=file]').val('');
});

$("form").on("change", ".file-upload-field", function () {
  $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, ''));
});




//Custom Data Table 
getPagination('#table-id');
//getPagination('.table-class');
//getPagination('table');

/*					PAGINATION 
- on change max rows select options fade out all rows gt option value mx = 5
- append pagination list as per numbers of rows / max rows option (20row/5= 4pages )
- each pagination li on click -> fade out all tr gt max rows * li num and (5*pagenum 2 = 10 rows)
- fade out all tr lt max rows * li num - max rows ((5*pagenum 2 = 10) - 5)
- fade in all tr between (maxRows*PageNum) and (maxRows*pageNum)- MaxRows 
*/


function getPagination(table) {
  var lastPage = 1;

  $('#maxRows')
    .on('change', function (evt) {
      //$('.paginationprev').html('');						// reset pagination

      lastPage = 1;
      $('.pagination')
        .find('li')
        .slice(1, -1)
        .remove();
      var trnum = 0; // reset tr counter
      var maxRows = parseInt($(this).val()); // get Max Rows from select option

      if (maxRows == 5000) {
        $('.pagination').hide();
      } else {
        $('.pagination').show();
      }

      var totalRows = $(table + ' tbody tr').length; // numbers of rows
      $(table + ' tr:gt(0)').each(function () {
        // each TR in  table and not the header
        trnum++; // Start Counter
        if (trnum > maxRows) {
          // if tr number gt maxRows

          $(this).hide(); // fade it out
        }
        if (trnum <= maxRows) {
          $(this).show();
        } // else fade in Important in case if it ..
      }); //  was fade out to fade it in
      if (totalRows > maxRows) {
        // if tr total rows gt max rows option
        var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
        //	numbers of pages
        for (var i = 1; i <= pagenum;) {
          // for each page append pagination li
          $('.pagination #prev')
            .before(
              '<li data-page="' +
              i +
              '">\
        <span>' +
              i++ +
              '<span class="sr-only">(current)</span></span>\
      </li>'
            )
            .show();
        } // end for i
      } // end if row count > max rows
      $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
      $('.pagination li').on('click', function (evt) {
        // on click each page
        evt.stopImmediatePropagation();
        evt.preventDefault();
        var pageNum = $(this).attr('data-page'); // get it's number

        var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

        if (pageNum == 'prev') {
          if (lastPage == 1) {
            return;
          }
          pageNum = --lastPage;
        }
        if (pageNum == 'next') {
          if (lastPage == $('.pagination li').length - 2) {
            return;
          }
          pageNum = ++lastPage;
        }

        lastPage = pageNum;
        var trIndex = 0; // reset tr counter
        $('.pagination li').removeClass('active'); // remove active class from all li
        $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
        // $(this).addClass('active');					// add active class to the clicked
        limitPagging();
        $(table + ' tr:gt(0)').each(function () {
          // each tr in table not the header
          trIndex++; // tr index counter
          // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
          if (
            trIndex > maxRows * pageNum ||
            trIndex <= maxRows * pageNum - maxRows
          ) {
            $(this).hide();
          } else {
            $(this).show();
          } //else fade in
        }); // end of for each tr in table
      }); // end of on click pagination list
      limitPagging();
    })
    .val(5)
    .change();

  // end of on select change

  // END OF PAGINATION
}

function limitPagging() {
  // alert($('.pagination li').length)

  if ($('.pagination li').length > 7) {
    if ($('.pagination li.active').attr('data-page') <= 3) {
      $('.pagination li:gt(5)').hide();
      $('.pagination li:lt(5)').show();
      $('.pagination [data-page="next"]').show();
    } if ($('.pagination li.active').attr('data-page') > 3) {
      $('.pagination li:gt(0)').hide();
      $('.pagination [data-page="next"]').show();
      for (let i = (parseInt($('.pagination li.active').attr('data-page')) - 2); i <= (parseInt($('.pagination li.active').attr('data-page')) + 2); i++) {
        $('.pagination [data-page="' + i + '"]').show();

      }

    }
  }
}

//  Developed By Yasser Mas
// yasser.mas2@gmail.com

// Search Data Tabel
var tr_elements = $('.custom-data-table tbody tr');
$(document).on('input', 'input[name=search_table]', function () {
  var search = $(this).val().toUpperCase();
  var match = tr_elements.filter(function (idx, elem) {
    return $(elem).text().trim().toUpperCase().indexOf(search) >= 0 ? elem : null;
  }).sort();
  var table_content = $('.custom-data-table tbody');
  if (match.length == 0) {
    table_content.html('<tr><td colspan="100%" class="text-center">Data Not Found</td></tr>');
  } else {
    table_content.html(match);
    match.show();
  }
 
});
// order details handel
$('.order-tabel tbody tr').on('click', function () {
  $('.order-overlay').addClass('open');
  $('.order-details').addClass('open');
  $('.order-details #Category').val($(this).data('name'));
  $('.order-details #Link').val($(this).data('link'));
})
$('.order-overlay').on('click', function () {
  $('.order-overlay').removeClass('open');
  $('.order-details').removeClass('open');
})
$('.order-details .btn-close').on('click', function () {
  $('.order-overlay').removeClass('open');
  $('.order-details').removeClass('open');
})
