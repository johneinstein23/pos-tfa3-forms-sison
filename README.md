# TFA6 POS: Database-Backed Customer and User Accounts

A CodeIgniter 4 POS account manager that rebuilds the array-based customer and user pages with a real database. The application uses migrations, a repeatable seeder, framework models, controller queries, and server-rendered account lists.

## Features

- Customer Accounts: list, add, and edit customers.
- User Accounts: list, add, and edit users.
- Required customer full name and valid email checks.
- Required username and unique-username checks.
- Invalid forms redisplay with errors and entered values.
- User edit form accepts JPG/PNG avatars up to 2 MB.
- Uploaded images are cropped to 256 × 256 display-ready copies in public/uploads/avatars; the database stores only a generated filename.
- The User Accounts list displays the avatar or a placeholder.
- Database migration and seeder plus a MySQL export are included.

## TFA6 activity coverage

The database-backed implementation covers the required activity outcomes:

- `customers` migration fields: `full_name`, `email`, and `phone`.
- `users` migration fields: unique `username` and `full_name`.
- `PosDemoSeeder` inserts five sample customers and five sample users.
- `CustomerModel` and `UserModel` provide the application data layer.
- `Customers` and `Users` controllers retrieve records through those models before rendering the existing account views.
- The list views continue to display the same customer and user data while reading from the database.

## Requirements

- Windows with PHP 8.1+, Composer, and MySQL/MariaDB (XAMPP is suitable).
- PHP extensions mysqli, fileinfo, and gd enabled.

## Setup on Windows

1. Open this folder in VS Code and choose Terminal → New Terminal.
2. Run the following command. The script creates a sibling folder called pos-tfa3-forms-validation-upload-app and merges the POS files into a clean CodeIgniter appstarter.

       powershell -ExecutionPolicy Bypass -File .\setup.ps1

3. In XAMPP, start Apache and MySQL. In phpMyAdmin, create an empty database named pos_tfa3_db.
4. Open a VS Code terminal in the generated app folder. The .env file is already present; change the MySQL username/password if your XAMPP settings differ.
5. Run these commands from the generated app folder:

       php spark migrate
       php spark db:seed PosDemoSeeder

6. Start the app and open http://localhost:8080:

       php spark serve

The migrations create the customer/user tables, then add the optional avatar column used by the user edit flow. The seeder adds five demo customers and five demo users. The SQL export at `sql/pos_tfa3.sql` creates the same final schema and demo records. Use either migrations/seeder or the SQL export on an empty database, not both.

## Temporary public preview with Cloudflare

Keep the CodeIgniter server running on port 8080. Open a second PowerShell terminal and run the Cloudflare executable:

       & "$env:USERPROFILE\Downloads\cloudflared-windows-amd64.exe" tunnel --url http://localhost:8080

Copy the trycloudflare.com URL printed by the command. Set app.baseURL in the generated app's .env file to that full URL with a trailing slash, save, and restart php spark serve. Keep both the app server and tunnel running while sharing the URL. Quick Tunnel URLs are temporary and intended for testing.

## Try the required flows

- Customer list: /customers
- Add customer: /customers/new
- Edit a customer: use an Edit link in the list.
- User list: /users
- Add user: /users/new
- Edit user and upload an avatar: use an Edit link in the list.
- About: /about

Test validation by submitting empty customer fields, an invalid email, a blank username, and a duplicate username. The form should show errors and keep entered text. On a user edit page, test a JPG/PNG under 2 MB, then test a larger or non-image file. The invalid upload should be rejected.

## GitHub submission

This repository contains the raw project files, migrations, seeder, models, views, and SQL export required for submission. To publish a new commit from a configured clone, run:

       git init -b main
       git add .
       git commit -m "Complete TFA6 database-backed POS activity"
       git push -u origin main

The .gitignore excludes .env, vendor, writable runtime files, and uploaded avatar files. Never commit database passwords or real customer photos.

## Notes

The uploaded assignment did not include the TFA2 source folder, so this package is a standalone TFA2-compatible POS app using the established customers and users fields. If your TFA2 project has additional fields or different routes, merge those project-specific changes before submitting.
