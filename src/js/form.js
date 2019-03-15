document.addEventListener('DOMContentLoaded', function(e) {
  let testimonialForm = document.getElementById('guisopo-testimonial-form');
  testimonialForm.addEventListener('submit', (event) => {
    event.preventDefault();
    // Reset Form Messages
    resetMessages();
    // Collect all the data
    let data = {
      name: testimonialForm.querySelector('[name="name"]').value,
      email: testimonialForm.querySelector('[name="email"]').value,
      message: testimonialForm.querySelector('[name="message"]').value,
      nonce: testimonialForm.querySelector('[name="nonce"]').value
    }
    // Validate email address
    if(!data.name) {
      testimonialForm.querySelector('[data-error="invalidName"').classList.add('show');
      return;
    }
    if(!validateEmail(data.email)) {
      testimonialForm.querySelector('[data-error="invalidEmail"').classList.add('show');
      return;
    }
    if(!data.message) {
      testimonialForm.querySelector('[data-error="invalidMessage"').classList.add('show');
      return;
    }
    // Ajax http post request
    let url = testimonialForm.dataset.url;
    let params = new URLSearchParams(new FormData(testimonialForm));
    testimonialForm.querySelector('.js-form-submission').classList.add('show');

    fetch(url, {
      method: "POST",
      body: params
    }).then(result => result.json())
      .catch(error => {
        resetMessages();
        testimonialForm.querySelector('.js-form-error').classList.add('show');
      })
      .then(response => {
        resetMessages();
        // Deal with the response
        if(response === 0 || response.status === 'error') {
          testimonialForm.querySelector('.js-form-error').classList.add('show');
          return;
        }
        testimonialForm.querySelector('.js-form-success').classList.add('show');
        testimonialForm.reset();
      });

  });
});

function resetMessages() {
  document.querySelectorAll('.field-msg').forEach( field => field.classList.remove('show') );
}

function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}