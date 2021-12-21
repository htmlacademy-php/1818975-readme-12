CREATE DATABASE readme DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE readme;

CREATE TABLE posts(
    id INT AUTO_INCREMENT PRIMARY KEY,
    add_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    title VARCHAR(64),
    content TEXT,
    like_count INT,
    show_count INT,
    img_path VARCHAR(255),
    video_path VARCHAR(255),
    quote_author VARCHAR(255),
    link VARCHAR(255),
    type_id INT,
    user_id INT
);

CREATE TABLE user(
    id INT AUTO_INCREMENT PRIMARY KEY,
    add_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(255),
    login VARCHAR(255),
    password VARCHAR(64),
    avatar_path VARCHAR(255)
);

CREATE TABLE comments(
    id INT AUTO_INCREMENT PRIMARY KEY,
    add_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content TEXT,
    post_id INT,
    user_id INT
);

CREATE TABLE  messages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    add_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    content TEXT,
    user_sender_id INT,
    user_recipient_id INT
);

CREATE TABLE subscriptions(
    user_subscriber_id INT,
    user_subscription_id INT
);

CREATE TABLE post_types(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64)
);

CREATE TABLE hashtags(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(64)
);

CREATE TABLE posts_hashtags(
    post_id INT,
    hashtag_id INT
);

CREATE TABLE post_likes(
    post_id INT,
    user_id INT
);

