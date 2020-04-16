CREATE OR REPLACE PACKAGE accounts IS

    PROCEDURE create_account(u_username users.username%type, u_password users.password%type, success OUT INT);

    PROCEDURE login_account(u_username users.username%type, u_password users.password%type, success OUT INT);

END accounts;
/
CREATE OR REPLACE PACKAGE BODY accounts IS

    PROCEDURE create_account(u_username users.username%type, u_password users.password%type, success OUT INT) IS
    valid INT DEFAULT 0;
    BEGIN
        success := 1;
        select count(*) into valid from users where username = u_username;
        if valid <> 0 then
            success := 0;
            return;
        end if;
        insert into users values (0, u_username, u_password, sysdate, sysdate);
    END;

    PROCEDURE login_account(u_username users.username%type, u_password users.password%type, success OUT INT) IS
    v_user users%rowtype;
    valid INT DEFAULT 0;
    BEGIN
        select count(*) into valid from users where username like u_username and password like u_password;
        if valid = 1 then
            success := 1;
        else
            success := 0;
        end if;
    END;

END accounts;
