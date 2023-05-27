CREATE DATABASE khademni;

CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    about varchar(1000) ,
    Job varchar(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE companies (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(100) NOT NULL,
    head_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL   
    about varchar(1000) ,
    field varchar(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE jobs (
    job_title VARCHAR(255) NOT NULL,
    job_description TEXT,
    job_location VARCHAR(255),
    job_type VARCHAR(255),
    job_salary float,
    job_id INT PRIMARY KEY AUTO_INCREMENT,
    worker_type VARCHAR(255),
    job_poster INT(11) 
);

CREATE TABLE comments (
  comment_id INT PRIMARY KEY AUTO_INCREMENT,
  comment_date DATE DEFAULT CURRENT_DATE,
  user_id INT(11) UNSIGNED,
  job_id INT,
  comment_content VARCHAR(255),
  rating INT CHECK (rating >= 0 AND rating <= 5),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (job_id) REFERENCES jobs(job_id)
);

