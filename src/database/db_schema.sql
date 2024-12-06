DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS votes;
DROP TABLE IF EXISTS categories;

CREATE TABLE employees (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

CREATE TABLE categories (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL UNIQUE
);

CREATE TABLE votes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    voter_id INTEGER NOT NULL,
    nominee_id INTEGER NOT NULL,
    category_id INTEGER NOT NULL,
    comment TEXT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (voter_id) REFERENCES employees(id),
    FOREIGN KEY (nominee_id) REFERENCES employees(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);


INSERT INTO employees (name) VALUES ('Maja');
INSERT INTO employees (name) VALUES ('Bojan');
INSERT INTO employees (name) VALUES ('Alex');
INSERT INTO employees (name) VALUES ('Tamara');
INSERT INTO employees (name) VALUES ('Ilina');
INSERT INTO employees (name) VALUES ('Jovan');
INSERT INTO employees (name) VALUES ('Aleksandar');
INSERT INTO employees (name) VALUES ('Ravi');

INSERT INTO categories (name) VALUES ('Makes Work Fun');
INSERT INTO categories (name) VALUES ('Team Player');
INSERT INTO categories (name) VALUES ('Culture Champion');
INSERT INTO categories (name) VALUES ('Difference Maker');