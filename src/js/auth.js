document.addEventListener('DOMContentLoaded', function(event) {
  const showAuthButton = document.getElementById('guisopo-show-auth-form'),
        authContainer = document.getElementById('guisopo-auth-container'),
        close = document.getElementById('guisopo-auth-close');

  showAuthButton.addEventListener('click', () => {
    authContainer.classList.add('show');
    showAuthButton.parentElement.classList.add('hide');
  });

  close.addEventListener('click', () => {
    authContainer.classList.remove('show');
    showAuthButton.parentElement.classList.remove('hide');
  });



});