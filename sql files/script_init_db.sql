DROP TABLE users CASCADE CONSTRAINTS;
/

DROP TABLE locations CASCADE CONSTRAINTS;
/

DROP TABLE friends CASCADE CONSTRAINTS;
/

DROP TABLE books CASCADE CONSTRAINTS;
/

DROP TABLE books_users CASCADE CONSTRAINTS;
/

DROP TABLE genres CASCADE CONSTRAINTS;
/

DROP TABLE genres_users CASCADE CONSTRAINTS;
/

DROP TABLE apreciate_books CASCADE CONSTRAINTS;
/

CREATE TABLE users (
  id INT NOT NULL PRIMARY KEY,
  username VARCHAR2(50) NOT NULL UNIQUE,
  password VARCHAR2(200) NOT NULL,
  firstname VARCHAR2(50) NOT NULL,
  lastname VARCHAR2(50) NOT NULL,
  age INT NOT NULL,
  description VARCHAR2(500) NOT NULL,
  created_at DATE,
  updated_at DATE
)
/

CREATE TABLE locations (
  l_username VARCHAR2(50) NOT NULL,
  latitude INT NOT NULL,
  longitude INT NOT NULL,
  created_at DATE,
  updated_at DATE,
  CONSTRAINT fk_location_users FOREIGN KEY (l_username) REFERENCES users(username),
  CONSTRAINT no_duplicates_locations UNIQUE (l_username)
)
/

CREATE TABLE apreciate_books (
  a_username VARCHAR2(50) NOT NULL,
  a_title VARCHAR2(50) NOT NULL,
  liked INT NOT NULL,
  dislike INT NOT NULL,
  created_at DATE,
  updated_at DATE,
  CONSTRAINT fk_apreciate_books_users FOREIGN KEY (a_username) REFERENCES users(username),
  CONSTRAINT fk_apreciate_books_books FOREIGN KEY (a_title) REFERENCES books(title),
  CONSTRAINT no_apreciate_books UNIQUE (a_username,a_title)
)
/

CREATE TABLE friends (
--  id INT PRIMARY KEY,
  id_user1 INT NOT NULL,
  id_user2 INT NOT NULL,
  created_at DATE,
  updated_at DATE,
  CONSTRAINT fk_friends_id_user1 FOREIGN KEY (id_user1) REFERENCES users(id),
  CONSTRAINT fk_friends_id_user2 FOREIGN KEY (id_user2) REFERENCES users(id),
  CONSTRAINT no_duplicates_friends UNIQUE (id_user1, id_user2)
)
/

CREATE TABLE books (
  id INT NOT NULL PRIMARY KEY,
  title VARCHAR2(50) NOT NULL UNIQUE,
  author VARCHAR2(50) NOT NULL,
  id_genre INT NOT NULL,
  an INT NOT NULL,
  ISBN VARCHAR2(50) NOT NULL,
  created_at DATE,
  updated_at DATE
)
/

CREATE TABLE books_users (
--  id INT PRIMARY KEY,
  u_username INT NOT NULL,
  b_title INT NOT NULL,
  created_at DATE,
  updated_at DATE,
  CONSTRAINT fk_booksusers_username FOREIGN KEY (u_username) REFERENCES users(username),
  CONSTRAINT fk_booksusers_title FOREIGN KEY (t_title) REFERENCES books(title),
  CONSTRAINT no_duplicates_booksusers UNIQUE (u_username, t_title)
)
/

CREATE TABLE genres (
  id INT NOT NULL PRIMARY KEY,
  denumire VARCHAR2(50) NOT NULL UNIQUE,
  created_at DATE,
  updated_at DATE
)
/


CREATE TABLE genres_users (
--  id INT PRIMARY KEY,
  u_username INT NOT NULL,
  g_denumire INT NOT NULL,
  created_at DATE,
  updated_at DATE,
  CONSTRAINT fk_genresusers_username FOREIGN KEY (u_username) REFERENCES users(username),
  CONSTRAINT fk_genresusers_genre FOREIGN KEY (g_denumire) REFERENCES genres(denumire),
  CONSTRAINT no_duplicates_genresusers UNIQUE (u_username, g_denumire)
)
/

commit;
