# camagru
Camagru, allows users to upload/capture photos with webcam and apply filters to the image. Also users can like, comment on photo. Hosted version of this project is available [here](https://icamagru.herokuapp.com/)

# installation instructions
1. A web server with PHP support e.g. mamp <br />
2. Start the server <br />
3. Clone this repo and keep it inside of htdocs folder of your server <br />
4. In the browser, type localhost:3000/camagru <br />
5. Emails (e.g. registration confirmation email) are sent through PHP mail() function, which may or may not work depending on your settings. <br />

# dependencies
1. PHP7 <br />
2. Mysql <br />

# Security
1. User password is encrypted <br />
2. No sql injection <br />
3. Unwanted content disallowed <br />
4. Sanitised user input. <br />

# Users features
1. Sign up with valid email ID <br />
2. Confirmation link send to user email to verify user email <br />
3. Forgot password feature <br />
4. Logout from any page <br />
5. User can update their information once the logged in <br />
6. User can turn on/off notification. <br />

# Posts/Gallery features
1. Comment on photos <br />
2. Like or unlike photos <br />
3. Delete user own photo. <br />

# Photo capturing features
1. Allow user to capture photos by webcam <br />
2. Allow user to upload photos from their device <br />
3. Allow user to select filters <br />
4. Only logged on user can captur/upload photo.
