// $(document).ready(function() {
//     $('.editbtn').on('click', function() {
//     $('#editmodal').modal('show');
//     })
// })



$(function () {
    $(document).scroll(function () {
      var $nav = $("..cntainer");
      $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    });
  });