# 🔐 User Registration & Login System

A secure and beginner-friendly user authentication system built with PHP, MySQL, HTML, and CSS. Perfect for learning web development fundamentals and implementing user authentication in your projects.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

## 📋 Table of Contents

- [Features](#features)
- [Demo](#demo)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Security Features](#security-features)
- [Troubleshooting](#troubleshooting)
- [Future Enhancements](#future-enhancements)
- [Contributing](#contributing)
- [License](#license)

## ✨ Features

- ✅ User registration with validation
- ✅ Secure login system with session management
- ✅ Password hashing using bcrypt
- ✅ Protected user dashboard
- ✅ Logout functionality
- ✅ SQL injection protection (prepared statements)
- ✅ XSS protection
- ✅ Email validation
- ✅ Password strength requirements
- ✅ Responsive design
- ✅ User-friendly error messages
- ✅ Modern gradient UI

## 🎬 Demo

### Registration Page
- Create new accounts with username, email, and password
- Real-time validation for duplicate usernames and emails
- Password confirmation

### Login Page
- Secure authentication
- Session-based access control
- Redirects to dashboard upon successful login

### Dashboard
- Displays user information
- Protected route (requires authentication)
- Logout option

## 🔧 Requirements

Before you begin, ensure you have the following installed:

- **PHP** >= 7.0
- **MySQL** >= 5.6
- **Apache Server** (XAMPP, WAMP, or MAMP recommended)
- **Web Browser** (Chrome, Firefox, Safari, etc.)

## 📥 Installation

### Step 1: Clone or Download

```bash
# Clone the repository
git clone https://github.com/CHANGED-1/User-Registration---Login-System.git

# Or download and extract the ZIP file
```

### Step 2: Set Up Web Server

1. Install [XAMPP](https://www.apachefriends.org/), [WAMP](https://www.wampserver.com/), or [MAMP](https://www.mamp.info/)
2. Copy the project folder to your web server directory:
   - **XAMPP**: `C:\xampp\htdocs\user-auth-system\`
   - **WAMP**: `C:\wamp64\www\user-auth-system\`
   - **MAMP**: `/Applications/MAMP/htdocs/user-auth-system/`

### Step 3: Create Database

1. Start Apache and MySQL from your control panel
2. Open phpMyAdmin: `http://localhost/phpmyadmin`
3. Click "New" to create a database named `user_system`
4. Select the database and click "SQL" tab
5. Copy and paste the following SQL code:

```sql
CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

6. Click "Go" to execute

### Step 4: Configure Database Connection

Edit `config.php` with your database credentials:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');           // Your MySQL username
define('DB_PASS', '');               // Your MySQL password
define('DB_NAME', 'user_system');    // Database name
```

### Step 5: Launch Application

Open your browser and navigate to:
```
http://localhost/user-auth-system/register.php
```

## 🚀 Usage

### Registering a New User

1. Navigate to `register.php`
2. Fill in the registration form:
   - Username (must be unique)
   - Email (must be valid and unique)
   - Password (minimum 6 characters)
   - Confirm Password (must match)
3. Click "Register"
4. Upon success, you'll be redirected to the login page

### Logging In

1. Navigate to `login.php`
2. Enter your username and password
3. Click "Login"
4. You'll be redirected to your dashboard

### Accessing Dashboard

- Only accessible when logged in
- Displays your user information
- Provides logout option

### Logging Out

- Click the "Logout" button on the dashboard
- Your session will be destroyed
- You'll be redirected to the login page

## 📁 Project Structure

```
user-auth-system/
│
├── config.php              # Database configuration & session management
├── register.php            # User registration page
├── login.php               # User login page
├── dashboard.php           # Protected user dashboard
├── logout.php              # Logout handler
├── style.css               # Styling for all pages
└── README.md               # Project documentation
```

### File Descriptions

| File | Purpose |
|------|---------|
| `config.php` | Database connection setup and session initialization |
| `register.php` | Handles user registration with validation |
| `login.php` | Authenticates users and creates sessions |
| `dashboard.php` | Protected page displaying user information |
| `logout.php` | Destroys session and logs user out |
| `style.css` | Responsive styling with modern gradient design |

## 🔒 Security Features

This system implements several security best practices:

### 1. Password Security
- **Bcrypt hashing**: Passwords are hashed using `password_hash()` with bcrypt algorithm
- **No plain text storage**: Passwords are never stored in readable format
- **Secure verification**: Uses `password_verify()` for authentication

### 2. SQL Injection Protection
- **Prepared statements**: All database queries use parameterized queries
- **Bound parameters**: User input is never directly concatenated into SQL

### 3. XSS Protection
- **Output escaping**: `htmlspecialchars()` sanitizes all output
- **Input validation**: Server-side validation for all user inputs

### 4. Session Security
- **Session regeneration**: `session_regenerate_id()` prevents session fixation
- **Access control**: Protected pages check for valid sessions
- **Secure logout**: Proper session destruction on logout

### 5. Input Validation
- Username uniqueness check
- Email format validation
- Email uniqueness check
- Password length requirements
- Password confirmation matching

## 🐛 Troubleshooting

### Common Issues and Solutions

#### Issue: "Connection failed" error

**Solution:**
- Verify MySQL is running in your control panel
- Check database credentials in `config.php`
- Ensure the database `user_system` exists

#### Issue: Session not working / Can't stay logged in

**Solution:**
- Ensure `session_start()` is at the top of PHP files
- Check for any output (spaces, HTML) before `session_start()`
- Verify sessions are enabled in `php.ini`

#### Issue: Redirect not working (headers already sent)

**Solution:**
- Remove any whitespace or output before `<?php`
- Ensure no `echo` or HTML before `header()` function
- Check file encoding is UTF-8 without BOM

#### Issue: Password validation failing

**Solution:**
- Ensure password is at least 6 characters
- Check password and confirm password match
- Verify form field names match PHP code

#### Issue: Duplicate username/email not detected

**Solution:**
- Verify UNIQUE constraint on database columns
- Check the database query is executing properly
- Look for SQL errors in browser console or logs

#### Issue: Styling not loading

**Solution:**
- Verify `style.css` is in the same directory
- Check file path in `<link>` tag
- Clear browser cache (Ctrl+F5 or Cmd+Shift+R)

## 🚀 Future Enhancements

Here are some features you can add to expand this system:

### Basic Features
- [ ] Profile editing (update username, email)
- [ ] Change password functionality
- [ ] Delete account option
- [ ] Profile picture upload
- [ ] User bio/description

### Intermediate Features
- [ ] "Remember Me" checkbox with cookies
- [ ] Password reset via email
- [ ] Email verification on registration
- [ ] Password strength meter
- [ ] Account activation links
- [ ] User roles and permissions (admin, user, moderator)

### Advanced Features
- [ ] Two-factor authentication (2FA)
- [ ] OAuth integration (Google, Facebook, GitHub login)
- [ ] Activity logs and login history
- [ ] Rate limiting for login attempts
- [ ] CAPTCHA for bot protection
- [ ] Email notifications for suspicious activity
- [ ] API endpoints for mobile apps
- [ ] Admin panel for user management

### Security Enhancements
- [ ] CSRF token protection
- [ ] Password breach checking (HaveIBeenPwned API)
- [ ] Account lockout after failed attempts
- [ ] Security question recovery
- [ ] IP address logging
- [ ] Audit trail

## 🤝 Contributing

Contributions are welcome! Here's how you can help:

1. Fork the project
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Contribution Guidelines

- Follow PSR-12 coding standards for PHP
- Write clear commit messages
- Add comments for complex logic
- Test thoroughly before submitting
- Update documentation if needed

## 📝 License

This project is licensed under the MIT License - see below for details:

```
MIT License

Copyright (c) 2025 Guloba Moses

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## 📞 Support

If you encounter any issues or have questions:

1. Check the [Troubleshooting](#troubleshooting) section
2. Search existing [Issues](https://github.com/CHANGED-1/User-Registration---Login-System/issues)
3. Open a new issue with detailed information
4. Contact: consult@guloba.com

## 🙏 Acknowledgments

- Built as a learning project for PHP and MySQL beginners
- Inspired by modern authentication best practices
- Thanks to the PHP and web development community

## 📚 Resources

### Learn More:
- [PHP Official Documentation](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [OWASP Security Guidelines](https://owasp.org/)
- [PHP The Right Way](https://phptherightway.com/)

---

⭐ **Star this repository** if you found it helpful!

Made with ❤️ for learning web development