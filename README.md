# Blog

A blog implemented on Laravel.

## Environment Variables

You need to set these variables in order for it to work:

- **FILESYSTEM_DRIVER:** Default filesystem driver to store files. (public|cloudinary)
- **IMAGES_FOLDER:** Path inside the filesystem to store the files.
- **CONTACT_TO:** Destination e-mail of the contact form
- **DB_CONNECTION:** Database driver
- **DB_HOST:** Database host
- **DB_PORT:** Database port
- **DB_DATABASE:** Database name
- **DB_USERNAME:** Database username
- **DB_PASSWORD:** Database password
- **MAIL_MAILER:** Mail  driver
- **MAIL_HOST:** Mail host
- **MAIL_PORT:** Mail port
- **MAIL_USERNAME:** Mail username
- **MAIL_PASSWORD:** Mail password
- **MAIL_ENCRYPTION:** Mail encryption

If you intend to store images on Cloudinary, set these to:

- **CLOUDINARY_CLOUD_NAME:** Your cloud name
- **CLOUDINARY_API_KEY:** Your API key
- **CLOUDINARY_API_SECRET:** Your API secret
- **CLOUDINARY_OVERWRITE:** Ovewrite or not files when writing

## Inserting the first user

After deploying the application, set a admin user like this:

```
php artisan tinker
```
then
```
DB::table('users')->insert(['name'=>'user_name','email'=>'user_email','password'=>Hash::make('password')])
```
