// Export a Vue mixin
export default {
  // Define methods for the mixin
  methods: {
    // Custom method to translate strings using translation object
    $t(string) {
      // Return the translated string from the translation object
      // If not found, return the original string
      return window.nrd_app_vars.trans[string] || string;
    }
  }
}
