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
      message: testimonialForm.querySelector('[name="message"]').value
    }
    // Validate email address
    if(!data.name) {
      testimonialForm.querySelector('[data-error="invalidName"').classList.add('show');
    }
    if(! validateEmail(data.email)) {
      testimonialForm.querySelector('[data-error="invalidEmail"').classList.add('show');
    }
    if(!data.message) {
      testimonialForm.querySelector('[data-error="invalidMessage"').classList.add('show');
    }
    // Ajax http post request
  });
});

function resetMessages() {
  document.querySelectorAll('.field-msg').forEach( field => field.classList.remove('show') );
}

function validateEmail() {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}