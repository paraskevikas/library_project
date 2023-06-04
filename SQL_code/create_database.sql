--
-- First, we create our database "library"
--

CREATE DATABASE IF NOT EXISTS library;
USE library;

--
-- Create tables
--

-- Table structure for super_admin

CREATE TABLE super_admin (
    super_admin_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,
    passcode VARCHAR(50) NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (super_admin_id) 
);

-- Table structure for schools

CREATE TABLE schools (
    school_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    school_name VARCHAR(255) UNIQUE NOT NULL,
    phone BIGINT UNSIGNED UNIQUE NOT NULL CHECK (1000000000 <= phone AND phone <= 9999999999),
    email VARCHAR(255) UNIQUE NOT NULL CHECK (email LIKE '_%@_%._%'),
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (school_id)
);

-- Table structure for addresses

CREATE TABLE addresses (
    school_id INT UNSIGNED NOT NULL,
    street_name VARCHAR(255) NOT NULL,
    street_number INT NOT NULL,
    postal_code INT NOT NULL CHECK (10000 <= postal_code AND postal_code <= 99999),
    city VARCHAR(255) NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (school_id),
    CONSTRAINT addr_school FOREIGN KEY (school_id) REFERENCES schools (school_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for administrators

CREATE TABLE administrators (
    admin_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    passcode VARCHAR(50) NOT NULL,
    school_id INT UNSIGNED UNIQUE NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (admin_id),
    CONSTRAINT admin_school FOREIGN KEY (school_id) REFERENCES schools (school_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for members

CREATE TABLE members (
    card_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    passcode VARCHAR(50) NOT NULL,
    birthday DATE NOT NULL,
    phone BIGINT UNSIGNED NOT NULL CHECK (1000000000 <= phone AND phone <= 9999999999),
    email VARCHAR(255) NOT NULL CHECK (email LIKE '_%@_%._%'),
    teacher TINYINT NOT NULL CHECK (teacher = 0 OR teacher = 1),
    active TINYINT NOT NULL DEFAULT 1 CHECK (active = 1 OR active = 0),
    school_id INT UNSIGNED NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (card_id),
    CONSTRAINT memb_school FOREIGN KEY (school_id) REFERENCES schools (school_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for principals

CREATE TABLE principals (
    principal_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    school_id INT UNSIGNED UNIQUE NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (principal_id),
    CONSTRAINT princ_school FOREIGN KEY (school_id) REFERENCES schools (school_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for books

CREATE TABLE books (
    ISBN BIGINT UNSIGNED NOT NULL CHECK (1000000000000 <= ISBN  AND ISBN <= 9999999999999),
    title VARCHAR(255) NOT NULL,
    lang VARCHAR(50) NOT NULL,
    page_number INT UNSIGNED NOT NULL,
    image_cover TEXT NOT NULL DEFAULT 'https://t4.ftcdn.net/jpg/03/64/17/57/360_F_364175760_dcXwFAHAjqzVEjBN7tpvSyQmlOe2IEVl.jpg',
    publisher VARCHAR(255) NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (ISBN)
);

-- Table structure for copies

CREATE TABLE copies (
    ISBN BIGINT UNSIGNED NOT NULL CHECK (1000000000000 <= ISBN  AND ISBN <= 9999999999999),
    school_id INT UNSIGNED NOT NULL,
    total_copies INT UNSIGNED NOT NULL,
    available_copies INT UNSIGNED NOT NULL DEFAULT (total_copies) CHECK (available_copies <= total_copies),
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (ISBN, school_id),
    CONSTRAINT copies_book FOREIGN KEY (ISBN) REFERENCES books (ISBN) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT copies_school FOREIGN KEY (school_id) REFERENCES schools (school_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for authors

CREATE TABLE authors (
    author_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ISBN BIGINT UNSIGNED NOT NULL CHECK (1000000000000 <= ISBN  AND ISBN <= 9999999999999),
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (author_id, ISBN),
    CONSTRAINT author_book FOREIGN KEY (ISBN) REFERENCES books (ISBN) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for categories

CREATE TABLE categories (
    ISBN BIGINT UNSIGNED NOT NULL CHECK (1000000000000 <= ISBN  AND ISBN <= 9999999999999),
    category_name VARCHAR(50) NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (ISBN, category_name),
    CONSTRAINT category_book FOREIGN KEY (ISBN) REFERENCES books (ISBN) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for keywords

CREATE TABLE keywords (
    ISBN BIGINT UNSIGNED NOT NULL CHECK (1000000000000 <= ISBN  AND ISBN <= 9999999999999),
    descr VARCHAR(50) NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (ISBN, descr),
    CONSTRAINT keyword_book FOREIGN KEY (ISBN) REFERENCES books (ISBN) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for summary

CREATE TABLE summary (
    ISBN BIGINT UNSIGNED NOT NULL CHECK (1000000000000 <= ISBN  AND ISBN <= 9999999999999),
    descr TEXT NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (ISBN),
    CONSTRAINT summary_book FOREIGN KEY (ISBN) REFERENCES books (ISBN) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for likert

CREATE TABLE likert (
    likert_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    answers VARCHAR(50) NOT NULL,
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (likert_id),
    CONSTRAINT likert_scale CHECK (answers in ('strongly agree', 'agree', 'neutral', 'disagree', 'strongly disagree'))
);

-- Table structure for reviews

CREATE TABLE reviews (
    ISBN BIGINT UNSIGNED NOT NULL CHECK (1000000000000 <= ISBN  AND ISBN <= 9999999999999),
    card_id INT UNSIGNED NOT NULL,
    review_text TEXT NOT NULL,
    likert_id INT UNSIGNED NOT NULL,
    active TINYINT NOT NULL DEFAULT 0 CHECK (active = 1 OR active = 0),
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (ISBN, card_id),
    CONSTRAINT likert_review FOREIGN KEY (likert_id) REFERENCES likert (likert_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT book_review FOREIGN KEY (ISBN) REFERENCES books (ISBN) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT memb_review FOREIGN KEY (card_id) REFERENCES members (card_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for borrows

CREATE TABLE borrows (
    borrow_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    card_id INT UNSIGNED NOT NULL,
    ISBN BIGINT UNSIGNED NOT NULL CHECK (1000000000000 <= ISBN  AND ISBN <= 9999999999999),
    b_date DATE NOT NULL DEFAULT CURRENT_DATE,
    r_date DATE NOT NULL DEFAULT DATE_ADD(b_date, INTERVAL 7 DAY),
    returned TINYINT NOT NULL DEFAULT 0 CHECK (returned = 0 OR returned = 1),
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (borrow_id),
    CONSTRAINT borrows_memb FOREIGN KEY (card_id) REFERENCES members (card_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT borrows_book FOREIGN KEY (ISBN) REFERENCES books (ISBN) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table structure for reservations

CREATE TABLE reservations (
    reservation_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ISBN BIGINT UNSIGNED NOT NULL CHECK (1000000000000 <= ISBN  AND ISBN <= 9999999999999),
    card_id INT UNSIGNED NOT NULL,
    creation_date DATE NOT NULL DEFAULT CURRENT_DATE,
    stat VARCHAR(50) NOT NULL DEFAULT 'pending',
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (reservation_id),
    CONSTRAINT reserv_book FOREIGN KEY (ISBN) REFERENCES books (ISBN) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT resrv_memb FOREIGN KEY (card_id) REFERENCES members (card_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT reserv_status CHECK (stat in ('pending', 'active', 'cancelled'))
);

-- Table structure for membership_applicant

CREATE TABLE membership_applicant (
    request_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    passcode VARCHAR(50) NOT NULL,
    birthday DATE NOT NULL,
    phone INT UNSIGNED NOT NULL CHECK (1000000000 <= phone AND phone <= 9999999999),
    email VARCHAR(255) NOT NULL,
    teacher TINYINT NOT NULL CHECK (teacher = 0 OR teacher = 1),
    school_id INT UNSIGNED NOT NULL,
    stat VARCHAR(50) NOT NULL DEFAULT 'pending',
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (request_id),
    CONSTRAINT memb_appl_school FOREIGN KEY (school_id) REFERENCES schools (school_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT admin_status CHECK (stat in ('pending', 'approved', 'rejected'))
);

-- Table structure for admin_applicant

CREATE TABLE admin_applicant (
    request_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    school_id INT UNSIGNED NOT NULL,
    stat VARCHAR(50) NOT NULL DEFAULT 'pending',
    last_update TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (request_id),
    CONSTRAINT admin_appl_school FOREIGN KEY (school_id) REFERENCES schools (school_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT admin_status CHECK (stat in ('pending', 'approved', 'rejected'))
);

--
-- Indexes
--

CREATE INDEX reserv_creation_date ON reservations (creation_date);
CREATE INDEX reserv_status ON reservations (stat);
CREATE INDEX borrows_ret_date ON borrows (r_date);
CREATE INDEX borrows_b_date ON borrows (b_date);
CREATE INDEX borrows_returned ON borrows (returned);
CREATE INDEX memb_birth ON members (birthday);

--
-- Procedures
--

-- Cancel a reservation if 7 days have passed since it initial creation

DELIMITER //

CREATE PROCEDURE update_reserv_expired()
BEGIN
    UPDATE reservations
    SET stat = 'cancelled'
    WHERE (CURRENT_DATE > DATE_ADD(creation_date, INTERVAL 7 DAY) AND stat <> 'cancelled');  
END//;

DELIMITER ;


-- Decrement the number of available copies

DELIMITER //

CREATE PROCEDURE decr_copies(IN p_ISBN BIGINT, IN p_school_id INT)
BEGIN
    UPDATE copies
    SET available_copies = available_copies - 1
    WHERE (ISBN = p_ISBN AND school_id = p_school_id);
END//;

ELIMITER ;

-- Chech whether a member has a book overdue

DELIMITER //

CREATE PROCEDURE book_overdue(IN p_card_id INT)
BEGIN
    IF (
        SELECT COUNT(*)
        FROM borrows
        WHERE (card_id = p_card_id AND CURRENT_DATE > r_date AND returned = 0)
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This member has a book to return first!';    
    END IF;
END//;

DELIMITER ;

--
-- Views
--

-- Used for query 3.1.5. A view with all the administrators who have lent more than
-- 20 books in a year

CREATE VIEW admin_lends (admin_id, first_name, last_name, books, year)
AS SELECT a.admin_id, a.first_name, a.last_name, COUNT(a.admin_id), year(b.b_date)
FROM administrators a
INNER JOIN members m ON m.school_id = a.school_id
INNER JOIN borrows b ON b.card_id = m.card_id
GROUP BY a.admin_id, year(b.b_date)
HAVING COUNT(a.admin_id) > 20;

/*ISBN, κατηγορία βιβλίου και πλήθος δανεισμών*/
CREATE view pop_cat AS
SELECT a.ISBN, category_name, count(a.ISBN) as total
FROM borrows a
INNER JOIN categories b ON a.ISBN=b.ISBN
GROUP BY 1,2;

/* O συγγραφέας με τα περισσότερα βιβλία */
CREATE VIEW author_max_books as 
SELECT COUNT(*) as maxbooks, author_id FROM authors GROUP BY author_id ORDER BY COUNT(*) DESC LIMIT 1;

--
-- Triggers
--

-- Cancel a reservation if 7 days have passed since it initial creation

DELIMITER //

-- reserv_expired1
CREATE TRIGGER reserv_exprired1
AFTER DELETE ON borrows FOR EACH ROW
BEGIN
    CALL update_reserv_expired();
END//;

DELIMITER ;

DELIMITER //

-- reserv_expired3
CREATE TRIGGER reserv_exprired3
AFTER INSERT ON borrows FOR EACH ROW
BEGIN
    CALL update_reserv_expired();
END//;

DELIMITER ;

DELIMITER //

-- reserv_expired2
CREATE TRIGGER reserv_exprired2
AFTER UPDATE ON borrows FOR EACH ROW
BEGIN
    CALL update_reserv_expired();
END//;

DELIMITER ;


-- A new tuple is about to be inserted into table 'borrows'. Check if there are
-- any available copies. If there are, then decrement the number of available
-- copies. If there aren't print an error message and abort. Also, check whether
-- any reservations have been 'pending' or 'active' for more than 7 days.

DELIMITER //

CREATE TRIGGER update_avail_copies
BEFORE INSERT ON borrows FOR EACH ROW
BEGIN

    IF new.returned = 0 THEN

        SELECT school_id INTO @new_id
        FROM members
        WHERE card_id = new.card_id;

        IF (
            SELECT available_copies
            FROM copies
            WHERE (ISBN = new.ISBN AND school_id = @new_id)
        ) >= 1 THEN
            CALL decr_copies(new.ISBN, @new_id);
        ELSE
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No available copies';
        END IF;

    END IF;

END//;

DELIMITER ;

-- Before inserting a new tuple in 'borrows', check whether the member wishing to
-- borrow a new book has already borrowed too many books. Also, check if the member
-- has a book overdue

DELIMITER //

CREATE TRIGGER borrows_check
BEFORE INSERT ON borrows FOR EACH ROW
BEGIN

    IF new.returned = 0 THEN

        CALL book_overdue(new.card_id);

        SELECT teacher into @isTeacher
        FROM members m
        WHERE card_id = new.card_id;

        IF @isTeacher = 0 AND
        (
            SELECT COUNT(card_id)
            FROM borrows
            WHERE card_id = new.card_id AND returned = 0
        ) >= 2 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This student has already borrowed two books';

        ELSEIF @isTeacher = 1 AND
        (
            SELECT COUNT(card_id)
            FROM borrows
            WHERE card_id = new.card_id AND returned = 0
        ) >= 1 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This teacher has already borrowed one book';

        END IF;

    END IF;
END//;

DELIMITER ;

-- A member cannot borrow a book they have already borrowed before returning it first

DELIMITER //

CREATE TRIGGER same_book
BEFORE INSERT ON borrows FOR EACH ROW
BEGIN
    IF new.returned = 0 THEN
        IF (
            SELECT COUNT(*)
            FROM borrows
            WHERE ISBN = new.ISBN AND card_id = new.card_id AND returned = 0
        ) >= 1 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This member already has this book!';
        END IF;
    END IF;
END//;

DELIMITER ;

-- A member cannot make a reservation for a book if they already have a 'pending' 
-- or 'active' reservation for the book

DELIMITER //

CREATE TRIGGER reserv_already_exists
BEFORE INSERT ON reservations FOR EACH ROW
BEGIN
    IF (
        SELECT COUNT(*)
        FROM reservations
        WHERE ISBN = new.ISBN AND card_id = new.card_id AND stat <> 'cancelled'
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'You already have an ''active'' or ''pending'' reservation for this book';
    END IF;
END//; 

DELIMITER ;

-- Forbid deletion of tuple from borrows if returned = 0 (the book hasn't been returned yet)

DELIMITER //

CREATE TRIGGER borrow_del_forbid
BEFORE DELETE ON borrows FOR EACH ROW
BEGIN
    IF old.returned = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Action forbidden: the book has not been returned yet!';
    END IF;
END//;

DELIMITER ;

-- Forbid deletion of tuple from copies if returned = 0 (the book hasn't been returned yet)

DELIMITER //

CREATE TRIGGER copies_del_forbid
BEFORE DELETE ON copies FOR EACH ROW
BEGIN
    IF
    (
        SELECT COUNT(*)
        FROM borrows b
        INNER JOIN copies c ON c.ISBN = b.ISBN
        WHERE b.ISBN = old.ISBN AND b.returned = 0 AND c.school_id = old.school_id
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Action forbidden: the book has not been returned yet!';
    END IF;
END//;

DELIMITER ;

-- Whenever a new tuple is inserted on table 'borrows' cancel the reservation the member has made for the book

DELIMITER //

CREATE TRIGGER cancel_reserv_borrows
AFTER INSERT ON borrows FOR EACH ROW
BEGIN
    UPDATE reservations
    SET stat = 'cancelled'
    WHERE ISBN = new.ISBN AND card_id = new.card_id AND stat <> 'cancelled';
END//;

DELIMITER ;

-- Before a tuple from members is deleted check if the member has borrowed a book they have not returned yet

DELIMITER //

CREATE TRIGGER del_member
BEFORE DELETE ON members FOR EACH ROW
BEGIN
    IF
    (
        SELECT COUNT(*)
        FROM borrows
        WHERE card_id = old.card_id AND returned = 0
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Action forbidden: this member has borrowed a book they have not returned yet!';
    END IF;
END//;

DELIMITER ;

-- Whenever a book is returned, increment the number of available copies

DELIMITER //

CREATE TRIGGER borrow_book_returned
AFTER UPDATE ON borrows FOR EACH ROW
BEGIN
    IF new.returned = 1 AND old.returned = 0 THEN
        SELECT school_id INTO @new_school_id
        FROM members
        WHERE card_id = new.card_id;

        UPDATE copies
        SET available_copies = available_copies + 1
        WHERE school_id = @new_school_id AND ISBN = new.ISBN;
    END IF;
END//;

DELIMITER ;

-- Before inserting a new tuple in 'reservations', check whether the member wishing to
-- make a reservations has already made too many reservations. Also, check if the member
-- has a book overdue

DELIMITER //

CREATE TRIGGER reservation_check
BEFORE INSERT ON reservations FOR EACH ROW
BEGIN

    CALL book_overdue(new.card_id);

    SELECT teacher into @isTeacher
    FROM members m
    WHERE card_id = new.card_id;

    IF @isTeacher = 0 AND
    (
        SELECT COUNT(card_id)
        FROM reservations
        WHERE card_id = new.card_id AND stat <> 'cancelled'
    ) >= 2 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This student has already made two reservations!';
    
    ELSEIF @isTeacher = 1 AND
    (
        SELECT COUNT(card_id)
        FROM reservations
        WHERE card_id = new.card_id AND stat <> 'cancelled'
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This teacher has already made one reservation!';
    END IF;

    IF new.stat <> 'cancelled' AND
    (
        SELECT COUNT(*)
        FROM borrows
        WHERE ISBN = new.ISBN AND card_id = new.card_id AND returned = 0
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This member has already borrowed this book!';
    END IF;
END//;

DELIMITER ;

-- Before a new tuple is inserted on 'members' check whether the username is already used by someone else in the database

DELIMITER //

CREATE TRIGGER username_members
BEFORE INSERT ON members FOR EACH ROW
BEGIN
    IF
    (
        SELECT COUNT(username)
        FROM administrators
        WHERE username = new.username
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';

    ELSEIF
    (
        SELECT COUNT(username)
        FROM super_admin
        WHERE username = new.username
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';

    ELSEIF
    (
        SELECT COUNT(username)
        FROM membership_applicant
        WHERE username = new.username AND stat <> 'approved'
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';

    END IF;
END//;

DELIMITER ;

-- Before a new tuple is inserted on 'administrators' check whether the username is already used by someone else in the database

DELIMITER //

CREATE TRIGGER username_administrators
BEFORE INSERT ON administrators FOR EACH ROW
BEGIN
    IF
    (
        SELECT COUNT(username)
        FROM members
        WHERE username = new.username
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';

    ELSEIF
    (
        SELECT COUNT(username)
        FROM super_admin
        WHERE username = new.username
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';

    ELSEIF
    (
        SELECT COUNT(username)
        FROM membership_applicant
        WHERE username = new.username AND stat <> 'approved'
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';

    END IF;
END//;

DELIMITER ;

-- Before a new tuple is inserted on 'super_admin' check whether the username is already used by someone else in the database

DELIMITER //

CREATE TRIGGER username_super_admin
BEFORE INSERT ON super_admin FOR EACH ROW
BEGIN
    IF
    (
        SELECT COUNT(username)
        FROM members
        WHERE username = new.username
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';

    ELSEIF
    (
        SELECT COUNT(username)
        FROM administrators
        WHERE username = new.username
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';
    
    ELSEIF
    (
        SELECT COUNT(username)
        FROM membership_applicant
        WHERE username = new.username AND stat <> 'approved'
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';

    END IF;
END//;

DELIMITER ;

-- Check whether the username registered by a membership_applicant is already used by someone else in the database

DELIMITER //

CREATE TRIGGER username_memb_applic
BEFORE INSERT ON membership_applicant FOR EACH ROW
BEGIN
    IF
    (
        SELECT COUNT(username)
        FROM members
        WHERE username = new.username
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';
    
    ELSEIF
    (
        SELECT COUNT(username)
        FROM administrators
        WHERE username = new.username
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';

    ELSEIF
    (
        SELECT COUNT(username)
        FROM super_admin
        WHERE username = new.username
    ) >= 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This username is already taken. Pick another one';

    END IF;
END//;

DELIMITER ;

-- When a membership_applicant is approved, insert the tuple in table 'members' 

DELIMITER //

CREATE TRIGGER insert_member
AFTER UPDATE ON membership_applicant FOR EACH ROW
BEGIN
    IF new.stat = 'approved' AND old.stat <> 'approved' THEN
        INSERT INTO members (first_name, last_name, username, passcode, birthday, phone, email, teacher, school_id)
        VALUES (new.first_name, new.last_name, new.username, new.passcode, new.birthday, new.phone, new.email, new.teacher, new.school_id);
    END IF;
END//;

DELIMITER ;

-- Whenever an admin_applicant is approved, insert that administrator on table 'administrators'

DELIMITER //

CREATE TRIGGER admin_accept
AFTER UPDATE ON admin_applicant FOR EACH ROW
BEGIN

    IF new.stat = 'approved' AND old.stat <> 'approved' THEN
        IF (
            SELECT COUNT(*)
            FROM administrators
            WHERE school_id = new.school_id
        ) >= 1 THEN
            UPDATE administrators
            SET first_name = new.first_name, last_name = new.last_name
            WHERE school_id = new.school_id;

        ELSE
            SELECT CONCAT("admin_", new.school_id) INTO @new_username;
            SELECT CONCAT("admin_", new.school_id) INTO @new_passcode;  

            INSERT INTO administrators(admin_id, first_name, last_name, username, passcode, school_id)
            VALUES (new.school_id, new.first_name, new.last_name, @new_username, @new_passcode, new.school_id);
        END IF;
    END IF;

END//;

DELIMITER ;
