CREATE TABLE administrator (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(20) NOT NULL,
    hashed_password VARCHAR(255) NOT NULL
);

CREATE TABLE craftman (
        craftman_id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL UNIQUE,
        company_name VARCHAR(100) NOT NULL,
        siret VARCHAR(14),
        description VARCHAR(255),
        hashed_password VARCHAR(255) NOT NULL,
        validator_id INT,
        FOREIGN KEY (validator_id) REFERENCES administrator (admin_id) ON UPDATE CASCADE
    );

CREATE TABLE category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(30) NOT NULL UNIQUE
);

CREATE TABLE terms_of_use (
    terms_of_use_id INT AUTO_INCREMENT PRIMARY KEY,
    version VARCHAR(20) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    writing_date DATE NOT NULL,
    writer_administrator_id INT,
    is_actual BOOLEAN NOT NULL,
    FOREIGN KEY (writer_administrator_id) REFERENCES administrator (admin_id) ON UPDATE CASCADE
);

CREATE TABLE product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    quantity INT UNSIGNED NOT NULL DEFAULT 0,
    unit_price DECIMAL(10,2) NOT NULL,
    description TEXT,
    category_id INT NOT NULL,
    craftman_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES category (category_id) ON UPDATE CASCADE,
    FOREIGN KEY (craftman_id) REFERENCES craftman (craftman_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    last_name VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(20) NOT NULL UNIQUE,
    hashed_password VARCHAR(255) NOT NULL,
    accepted_terms_of_use_id INT,
    FOREIGN KEY (accepted_terms_of_use_id) REFERENCES terms_of_use (terms_of_use_id) ON UPDATE CASCADE
);

CREATE TABLE address (
    address_id INT AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(255) NOT NULL,
    city VARCHAR(50) NOT NULL,
    zip_code VARCHAR(20) NOT NULL,
    country VARCHAR(50) NOT NULL,
    additionnal_information TEXT,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE image (
    image_id INT AUTO_INCREMENT PRIMARY KEY,
    image_link VARCHAR(255) NOT NULL,
    placeholder VARCHAR(50) NOT NULL,
    product_id INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES product (product_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE event (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(50),
    creator_craftman_id INT NOT NULL,
    place VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (creator_craftman_id) REFERENCES craftman (craftman_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE participate_to_event (
    event_id INT NOT NULL,
    craftman_id INT NOT NULL,
    PRIMARY KEY (event_id, craftman_id),
    FOREIGN KEY (event_id) REFERENCES event (event_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (craftman_id) REFERENCES craftman (craftman_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE shopping_cart (
    shopping_cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE shopping_cart_product (
    shopping_cart_id INT,
    product_id INT,
    quantity INT UNSIGNED NOT NULL DEFAULT 1,
    PRIMARY KEY (shopping_cart_id, product_id),
    FOREIGN KEY (shopping_cart_id) REFERENCES shopping_cart (shopping_cart_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product (product_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE customer_order (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    shopping_cart_id INT NOT NULL,
    order_date DATE NOT NULL,
    order_cost DECIMAL(10,2) NOT NULL,
    delivery_address_id INT NOT NULL,
    payment_intent_id VARCHAR(255),
    status VARCHAR(50),
    card_type VARCHAR(50),
    last_4_digits VARCHAR(4),
    FOREIGN KEY (shopping_cart_id) REFERENCES shopping_cart (shopping_cart_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (delivery_address_id) REFERENCES address (address_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE wishlist (
    user_id INT,
    product_id INT,
    PRIMARY KEY (user_id, product_id),
    FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product (product_id) ON UPDATE CASCADE
);

CREATE TABLE faq (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    writer_administrator_id INT,
    FOREIGN KEY (writer_administrator_id) REFERENCES administrator (admin_id) ON UPDATE CASCADE
);

CREATE TABLE legal_notices (
    legal_notices_id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    version VARCHAR(20) NOT NULL,
    writer_administrator_id INT,
    FOREIGN KEY (writer_administrator_id) REFERENCES administrator (admin_id) ON UPDATE CASCADE
);

CREATE TABLE support_ticket (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    writing_date DATE NOT NULL,
    content TEXT NOT NULL,
    answer_administrator_id INT,
    FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (answer_administrator_id) REFERENCES administrator (admin_id) ON UPDATE CASCADE
);

CREATE TABLE image_gallery (
    image_gallery_id INT AUTO_INCREMENT PRIMARY KEY,
    image_link VARCHAR(255) NOT NULL,
    placeholder VARCHAR(50) NOT NULL
);
