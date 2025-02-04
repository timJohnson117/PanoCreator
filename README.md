# PanoCreator
A Panoramic Image Creator

## Contents
index.html - Frontend User Interface

upload.php - Upload and Image Processing, Download Interface

## Setup
### Install Packages and Enable Services
1  :: sudo apt install apache2 php

2  :: sudo systemctl enable apache2

3  :: sudo systemctl start apache2

### Setup Webserver Environemnt 
4  :: sudo cp ./webserver/* /var/www/html

5  :: cd /var/www/html

6  :: sudo mkdir uploads

7  :: sudo chown www-data:www-data . 

8  :: sudo chown www-data:www-data uploads

9  :: sudo chmod 777 .

10 :: sudo chmod 777 uploads


### Configure PHP to allow for file uploads
11 :: sudo nano /etc/php/x.x/apache2/php.ini (x.x is the version number. Latest = 8.1) 

12 :: Find the File Uploads section and ensure that the File Upload option is enabled

13 :: Increase the file_max_size option from 2M to at least 2000000M

14 :: Increase the post_max_size option from 8M to at least 8000000M

15 :: Exit and save (CTRL + X, Y, Enter) 


## Credits
Sam Escamilla = Design input and user experience

Tim Johnson   = Server-side processing

## Special Thanks
Deborah Scott

Carlos Monroy

Charles Tharangaraj

Kim & Bill Johnson 

Thanks for all your help and support :-) 

To everyone at UST, have a wonderful holiday season. It's been a great ride and I hope your future is bright

God Bless and thanks for all the Fun! 

