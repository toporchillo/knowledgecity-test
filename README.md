# Test task for knowledgecity (backend)

## Installation
- Upload files to you hosting or local http directory
- Import into MySQL database install.sql file
- Open config.php file and set up database connection constants
- Check .htaccess file. If you upload code to website home directory, replace this line: ```RewriteBase /testask/knowledgecity-test/ ```
to ```RewriteBase /```
- Open page http://localhost/index.html. Login: _root_ , password: _password_
- To create your own user, run this SQL-request: 
```INSERT INTO users SET login='your_login', password=sha1('your_passwordsalty-random-string');```
_salty-random-string_ - is a hash salt, whitch was defined into config.php


