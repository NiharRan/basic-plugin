// Define a set of HTTP request methods using the window.nrd_request function
export default {
  // HTTP GET request method
  get(route, data = {}) {
    // Call the window.nrd_request function with 'GET' method
    return window.nrd_request('GET', route, data);
  },
  // HTTP POST request method
  post(route, data = {}) {
    // Call the window.nrd_request function with 'POST' method
    return window.nrd_request('POST', route, data);
  },
  // HTTP DELETE request method
  delete(route, data = {}) {
    // Call the window.nrd_request function with 'DELETE' method
    return window.nrd_request('DELETE', route, data);
  },
  // HTTP PUT request method
  put(route, data = {}) {
    // Call the window.nrd_request function with 'PUT' method
    return window.nrd_request('PUT', route, data);
  },
  // HTTP PATCH request method
  patch(route, data = {}) {
    // Call the window.nrd_request function with 'PATCH' method
    return window.nrd_request('PATCH', route, data);
  }
};
