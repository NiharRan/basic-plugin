# WordPress Basic Plugin for understanding WordPress Plugin Development properly

This plugin should consist of a top-level registered menu item, which displays a Vue app, to administrator-level users only.

Failure of This Vue app to load on the page (for example, a user not having JavaScript enabled) should be handled (a simple text error will suffice for this)

This Vue app should have 3 tabs: Table, Graph, and Settings, controlled via a Vue Router. When the page is loaded for the first time, the Table tab will display by default.

The Settings tab should contain a basic settings form which has 3 inputs:

- A numerical input field to set the number of rows to display in a table which should allow a value between 1 and 5 inclusive. Default to 5 on install.
- A checkbox or radio toggle to change whether the table’s date column shows the date in human-readable format or as a Unix timestamp. Default to human readable on install.
- A repeatable text field that should allow no less than 1 but no more than 5 emails to be entered. By default, the WordPress admin email should be pre-populated as one of the emails, but it should be removeable by the user. A user should be able to remove an email from any position (ie if 4 emails are saved, the user should be able to remove the third one without removing the fourth one)
Settings should be initialized when the Vue app first loads from the get all settings endpoint and should be saved into a Vuex store so that settings changes are saved both to the database and vuex state.
Standard on-screen error handling for form validation should be implemented, and the Vuex state should only be modified if the server update setting attempt succeeds (as one might expect).
The Table page should use your data endpoint to display a table of the data returned from your data endpoint that has the table key. This table should respect the settings for a number of rows and human date from your settings panel and the date format and number of rows displayed should change as the settings in the settings tabs are adjusted without requiring a refresh. Below the table, the list of emails from the emails setting should be displayed as an unordered list.
The Graph tab should display a simple graph of the graph data from the Data Endpoint. You may use any charging library to make this graph.


# Directory Structure

- /src/ 						  - Plugin backend stuff.
- /src/helpers/				- Functions of the plugin.
- /language/					- Translation files go here. 
- /resources/js/			- Vue, Vue router, Vuex files, and functions that matter on the front end go here.
- /resources/scss/		- The frontend CSS codes are included there.
- /assets/		        - The build version of the frontend code goes there
- index.php						- Dummy file.
- license.txt					- GPL v2
- basic-plugin.php		- Main plugin file containing plugin name and other version info for WordPress
