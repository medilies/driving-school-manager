use ae;

CREATE TABLE clients ( 
    client_id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    lname VARCHAR(60) NOT NULL,
    fname VARCHAR(60) NOT NULL,
    bday DATE NOT NULL,
    mail VARCHAR(150) UNIQUE NOT NULL,
    phone VARCHAR(15) UNIQUE NOT NULL,
    pass VARCHAR(100) NOT NULL 
) ENGINE = InnoDB CHARSET=UTF8MB4;

CREATE TABLE exam_code (
    exam_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    planned_on DATE,
    result VARCHAR(15),
    client_id INTEGER,
    FOREIGN KEY (client_id) REFERENCES clients(client_id) on DELETE CASCADE
) ENGINE = InnoDB CHARSET=UTF8MB4;

CREATE TABLE exam_creno (
    exam_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    planned_on DATE,
    result VARCHAR(15),
    client_id INTEGER,
    FOREIGN KEY (client_id) REFERENCES clients(client_id) on DELETE CASCADE
) ENGINE = InnoDB CHARSET=UTF8MB4;

CREATE TABLE exam_circuit (
    exam_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    planned_on DATE,
    result VARCHAR(15),
    client_id INTEGER,
    FOREIGN KEY (client_id) REFERENCES clients(client_id) on DELETE CASCADE
) ENGINE = InnoDB CHARSET=UTF8MB4;

CREATE TABLE posts (
    post_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    post_title VARCHAR(80) NOT NULL,
    post_content TEXT NOT NULL,
    post_created_at DATETIME DEFAULT CURRENT_TIMESTAMP(),
    client_id INTEGER,
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
) ENGINE = InnoDB CHARSET=UTF8MB4;

CREATE TABLE comments (
    comment_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    comment_content TEXT NOT NULL,
    comment_created_at DATETIME DEFAULT CURRENT_TIMESTAMP(),
    post_id INTEGER,
    client_id INTEGER,
    FOREIGN KEY (post_id) REFERENCES posts(post_id) on DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
) ENGINE = InnoDB CHARSET=UTF8MB4;

INSERT INTO clients (
    client_id, lname, fname, bday, mail, phone, pass) 
    VALUES ('0', 'admin', 'admin', '2021-05-01', 'admin@admin.admin', '0', 'admin');