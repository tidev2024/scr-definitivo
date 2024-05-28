$(document).ready(function() {
  $('#darkMode').click(function() {
    const startCurrentColor = $('#mainBody').css('background-color');
    const currentColor = $('#mainBody').css('background-color');
    if (currentColor === 'rgb(23, 25, 26)') {
      $('#mainBody').css('background-color', 'rgb(223, 222, 222)'); 
    } else {
      $('#mainBody').css('background-color', 'rgb(23, 25, 26)'); 
    }
  });

  const images = [
    '/images/grupoRoma1.jpg',
    '/images/grupoRoma2.jpg', 
    '/images/grupoRoma3.jpg'
  ];

  let currentImageIndex = 0;
  const backgroundElement = document.getElementById('dynamicBackground');

  function changeBackgroundImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    backgroundElement.style.backgroundImage = `url('${images[currentImageIndex]}')`;
  }

  setInterval(changeBackgroundImage, 10000); 

  $('#searchInput').on('input', function() {
    var input = $(this).val().toLowerCase();
    $('.nav-item, .dropdown-item').hide();
    $('.nav-item, .dropdown-item').filter(function() {
      return $(this).text().toLowerCase().includes(input);
    }).show();
  });
});
