<h1># wp-admin-ajax</h1>
Demo for creating a wp options page powered by React.
This is a barebones example for updating a WordPress options field with an admin powered by React.

<h2>HOW TO RUN THE DEMO</h2>
Install the package into the Wordpress directory: wp-content/plugins 

<h2>WORDPRESS FILES</h2>

<strong>plugin.php</strong> - Registers the plugin<br>
<strong>ajax.php</strong> - Contains Wordpress Ajax interaction<br>
<strong>settingsPage.php</strong> - Sets up the settings page<br>
<strong>reactFileParser.php</strong> - Searches the build directory of the React application and enqueues relevant files

<h2>REACT FILES</h2>

React files are located in the `admin` directory. 
To edit the react files:

<h3>Install</h3>
npm install

<h3>Usage</h3>
npm start
