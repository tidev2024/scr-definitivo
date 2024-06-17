$(document).ready(function() {
  $('nav div.navigation-itens a[data-menu]').mouseenter(function() {
      $('.itens').css('display', 'none')
      prop = $(this).attr('data-menu')
      $(`div#${prop}`).css('display', 'flex')
      $('.navigation-itens-drop').slideDown()

  })

  $('nav').mouseleave(function() {
    $('.navigation-itens-drop').slideUp(350)
    $('.itens').css('display', 'none')
  })

  $('.navigation-user').mouseenter(function() {
    $('.navigation-user-drop').slideDown().css('display', 'flex')
  })

  $('.navigation-user').mouseleave(function() {
    $('.navigation-user-drop').slideUp(350)
  })

  var alertWrapper = document.querySelector('.alert-wrapper.alertMessage');
  var overlay = document.querySelector('.overlay');
  var closeButton = document.querySelector('.btn-close');

  if (alertWrapper) {
      overlay.style.display = 'block';
  }

  closeButton.addEventListener('click', function() {
      alertWrapper.style.display = 'none';
      overlay.style.display = 'none';
  });

  var confirmDeleteButton = document.getElementById('confirmDelete');
  var formToSubmit;

  document.querySelectorAll('.delete-btn').forEach(function (button) {
      button.addEventListener('click', function (event) {
          var form = event.target.closest('form');
          formToSubmit = form;
      });
  });

  confirmDeleteButton.addEventListener('click', function () {
      if (formToSubmit) {
          formToSubmit.submit();
      }
  });
});
