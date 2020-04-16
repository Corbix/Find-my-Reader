CREATE OR REPLACE PACKAGE accounts_settings IS

    PROCEDURE add_book(title_add books.username%type, author_add books.author%type, genre_add books.id_genre%type, an_add books.an%type , ISBN_add books.ISBN%type, success OUT INT);
	
	PROCEDURE delete_book(title_delete books.username%type, success OUT INT);
	
	PROCEDURE add_user_book(u_username users.username%type, b_title books.title%type, success OUT INT);
	
	PROCEDURE delete_book_user(u_username users.username%type title_delete books.username%type, success OUT INT);
	
	PROCEDURE add_modify_description(u_username users.username%type, u_description users.description%type, success OUT INT);
	
	PROCEDURE add_preferences(u_username users.username%type, g_denumire genres.denumire%type, success OUT INT);
	
	PROCEDURE delete_preferences(u_username users.username%type, g_denumire genres.denumire%type, success OUT INT);

END accounts_settings;
/
CREATE OR REPLACE PACKAGE BODY accounts_settings IS

    PROCEDURE add_book(title_add books.username%type, author_add books.author%type, genre_add books.id_genre%type, an_add books.an%type , ISBN_add books.ISBN%type, success OUT INT) IS
    valid INT DEFAULT 0;
    BEGIN
        select count(*) into valid from books where title like title_add;
        if valid = 0 then
            success := 1;
			insert into books (title, author, id_genre, an, ISBN) values (title_add, author_add, id_genre, an_add, ISBN_add);
        else
            success := 0;
        end if;
    END;
	
	PROCEDURE add_user_book(u_username users.username%type, b_title books.title%type, success OUT INT) IS
    valid INT DEFAULT 0;
    BEGIN
        select count(*) into valid from books_users where username like u_username and title like b_title;
        if valid = 0 then
            success := 1;
			insert into books_users values (u_username, b_title);
        else
            success := 0;
        end if;
    END;
	
	PROCEDURE add_modify_description(u_username users.username%type, u_description users.description%type, success OUT INT) IS
    valid INT DEFAULT 0;
    BEGIN
        select count(*) into valid from users where username like u_username;
        if valid = 1 then
            success := 1;
			update users set description = u_description where username = u_username;
        else
            success := 0;
        end if;
    END;
	
	PROCEDURE add_preferences(u_username users.username%type, g_denumire genres.denumire%type, success OUT INT) IS
    valid INT DEFAULT 0;
    BEGIN
        select count(*) into valid from genres_users where username like u_username and denumire like g_denumire;
        if valid = 0 then
            success := 1;
			insert into genres_users values (u_username, g_denumire);
        else
            success := 0;
        end if;
    END;
	
	PROCEDURE delete_preferences(u_username users.username%type, g_denumire genres.denumire%type, success OUT INT) IS
    valid INT DEFAULT 0;
    BEGIN
        select count(*) into valid from genres_users where username like u_username and denumire like g_denumire;
        if valid = 1 then
            success := 1;
			delete from genres_users where username = u_username and denumire = g_denumire;
        else
            success := 0;
        end if;
    END;
	
	PROCEDURE delete_book_user(u_username users.username%type title_delete books.username%type, success OUT INT) IS
    valid INT DEFAULT 0;
    BEGIN
        select count(*) into valid from books_users where username like u_username and title like title_delete;
        if valid = 1 then
            success := 1;
			delete from books_users where username = u_username and title = title_delete;
        else
            success := 0;
        end if;
    END;
	
	PROCEDURE delete_book(title_delete books.username%type, success OUT INT) IS
    valid INT DEFAULT 0;
    BEGIN
        select count(*) into valid from books where title like title_delete;
        if valid = 1 then
            success := 1;
			delete from books where title = title_delete;
        else
            success := 0;
        end if;
    END;

END accounts_settings;
