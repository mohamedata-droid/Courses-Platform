USE codepath_academy;

ALTER TABLE users
ADD role ENUM('user', 'admin') NOT NULL DEFAULT 'user';

ALTER TABLE courses
ADD instructor VARCHAR(100) NOT NULL DEFAULT 'CodePath Instructor',
ADD status ENUM('Available', 'Unavailable') NOT NULL DEFAULT 'Available';

-- Change one registered account into an administrator.
-- Replace the email with the email address of the account you want to manage the dashboard.
UPDATE users SET role = 'admin' WHERE email = 'your-admin-email@example.com';
