// Function to make REST API requests
window.nrd_request = function (method, route, data = {}) {
  const url = `${window.nrd_app_vars.rest.url}/${route}`;

  // Define headers for the request, including nonce
  const headers = {'X-WP-Nonce': window.nrd_app_vars.rest.nonce};

  // Handle non-GET requests by setting appropriate headers
  if (['PUT', 'PATCH', 'DELETE'].indexOf(method.toUpperCase()) !== -1) {
    headers['X-HTTP-Method-Override'] = method;
    method = 'POST';
  }

  // Add a query timestamp to data
  data.query_timestamp = Date.now();

  // Create a Promise for the AJAX request
  return new Promise((resolve, reject) => {
    window.jQuery.ajax({
      url,
      type: method,
      data,
      headers
    })
      .then(response => resolve(response))
      .fail((errors) => {
        // Handle AJAX request failures and errors
        if (!errors.responseJSON) {
          console.info('Your server firewall blocked the request or it\'s a plugin conflict. Please check the detailed error.');
          console.log(errors);
        }
        reject(errors.responseJSON);
      });
  });
};

// Execute the following code when jQuery is ready
jQuery(($) => {
  (() => {
    // Set up global AJAX settings for the application
    $.ajaxSetup({
      success: function (response, status, xhr) {
        // Update nonce if provided in the response header
        const nonce = xhr.getResponseHeader('X-WP-Nonce');
        if (nonce) {
          window.nrd_app_vars.rest.nonce = nonce;
        }
      },
      error: function (response) {
        // Handle AJAX error responses
        if (Number(response.status) > 423 && Number(response.status) < 410) {
          let message = '';

          if (response.responseJSON) {
            message = response.responseJSON.message || response.responseJSON.error;
          }
          return message;
        } else if (response.responseJSON && response.responseJSON.code === 'rest_cookie_invalid_nonce') {
          // Send AJAX request to renew nonce if invalid
          jQuery.post(window.nrd_app_vars.ajax_url, {
            action: 'basic_plugin/renew_rest_nonce'
          })
            .then(response => {
              // Update the renewed nonce
              window.nrd_app_vars.rest.nonce = response.nonce;
            });
        }
      }
    });
  })();

  $('.basic-plugin-menu li a').on('click', function () {
    $('.basic-plugin-menu li').removeClass('active');
    $(this).closest('li').addClass('active');
  });
});
