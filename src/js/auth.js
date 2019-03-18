document.addEventListener('DOMContentLoaded', function(event) {
  const showAuthButton = document.getElementById('guisopo-show-auth-form'),
        authContainer = document.getElementById('guisopo-auth-container'),
        close = document.getElementById('guisopo-auth-close'),
        authForm = document.getElementById('guisopo-auth-form'),
        status = authForm.querySelector('[data-message="status"]');

  showAuthButton.addEventListener('click', () => {
    authContainer.classList.add('show');
    showAuthButton.parentElement.classList.add('hide');
  });

  close.addEventListener('click', () => {
    authContainer.classList.remove('show');
    showAuthButton.parentElement.classList.remove('hide');
  });

  authForm.addEventListener('submit', (event) => {
    event.preventDefault();

    // reset the form messages
    resetMessages();
    // collect data
    let data = {
      name: authForm.querySelector('[name="username"]').value,
      password: authForm.querySelector('[name="password"]').value,
      nonce: authForm.querySelector('[name="guisopo_auth"]').value,
    }

    // validate everything
    if(!data.name || !data.password) {
      status.innerHTML = 'Please, fill up the entire form';
      status.classList.add('error');
      return;
    }

    // ajax http post request
    let url = authForm.dataset.url;
    let params = new URLSearchParams( new FormData(authForm) );

    authForm.querySelector('[name="submit"]').value = 'Loggin in...';
    authForm.querySelector('[name="submit"]').disabled = true;

    fetch(url, {
      method: 'POST',
      body: params
    }).then(result => result.json())
      .catch(error => {
        resetMessages();
      })
      .then(response => {
        resetMessages();

        if(response === 0 || !response.status) {
          status.innerHTML = response.message;
          status.classList.add('error');
          return;
        }
        
        status.innerHTML = response.message;
        status.classList.add('success');
        authForm.reset();

        window.location.reload();
      });

  });

  function resetMessages() {
    status.innerHTML = '';
    status.classList.remove('success', 'error');
    authForm.querySelector('[name="submit"]').value = 'Login';
    authForm.querySelector('[name="submit"]').disabled = false;

  }

});