CREATE TABLE membership_rank(
    id_rank INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
);

CREATE TABLE client(
    id_client INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    membership INTEGER REFERENCES membership_rank(id_rank) 
);

CREATE TABLE socials(
    id_socials INTEGER AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50) NOT NULL,
    name VARCHAR(50) NOT NULL,
    id_client INTEGER REFERENCES client(id_client)
);

CREATE TABLE points(
    id_points INTEGER AUTO_INCREMENT PRIMARY KEY,
    quantity INTEGER NOT NULL DEFAULT 0,
    expiry_date DATE,
    id_client INTEGER REFERENCES client(id_client)
);

CREATE TABLE points_history(
    id_history INTEGER AUTO_INCREMENT PRIMARY KEY,
    action VARCHAR(50) NOT NULL,
    quantity INTEGER DEFAULT 0,
    action_date DATE DEFAULT NOW(),
    id_client INTEGER REFERENCES client(id_client)
);

CREATE TABLE redeemable(
    id_redeemable INTEGER AUTO_INCREMENT PRIMARY KEY,
    points INTEGER NOT NULL DEFAULT 0,
    description TEXT,
    name VARCHAR(50) NOT NULL,
    gift_rank INTEGER REFERENCES membership(id_rank)
);

CREATE TABLE redeemable_tracker(
    id_redeemable INTEGER REFERENCES redeemable(id_redeemable),
    id_client INTEGER REFERENCES client(id_client),
    PRIMARY KEY(id_redeemable,id_client)
);

CREATE TABLE address(
    id_address INTEGER AUTO_INCREMENT PRIMARY KEY,
    country VARCHAR(50) NOT NULL,
    street VARCHAR(50) NOT NULL,
    city VARCHAR(50) NOT NULL,
    zip VARCHAR(5) NOT NULL
);

CREATE TABLE client_lives_at(
    id_address INTEGER REFERENCES address(id_address),
    id_client INTEGER REFERENCES client(id_client),
    PRIMARY KEY (id_address,id_client)
);

CREATE TABLE orders_status(
    id_orders_status INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
);

CREATE TABLE orders(
    id_orders INTEGER AUTO_INCREMENT PRIMARY KEY,
    id_status INTEGER REFERENCES orders_status(id_orders_status),
    id_client INTEGER REFERENCES client(id_client) 
);

CREATE TABLE company(
    id_company INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
);

CREATE TABLE product(
    id_product INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    id_company INTEGER REFERENCES company(id_company)
);

CREATE TABLE stock(
    quantity INTEGER NOT NULL DEFAULT 0,
    unit_price NUMERIC(16,2) NOT NULL,
    id_product INTEGER REFERENCES product(id_product),
    PRIMARY KEY (unit_price,id_product)
);

CREATE TABLE courier(
    id_courier INTEGER AUTO_INCREMENT PRIMARY KEY,
    country VARCHAR(50),
    name VARCHAR(50)
);

CREATE TABLE parcel(
    id_parcel INTEGER AUTO_INCREMENT PRIMARY KEY,
    dispatch_date DATE DEFAULT NOW(),
    arrival_date DATE,
    delivery_fee INTEGER DEFAULT 0,
    id_address INTEGER REFERENCES address(id_address),
    id_courier INTEGER REFERENCES courier(id_courier)
);

CREATE TABLE status_order_product(
    id_status_order_product INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50)
);

CREATE TABLE product_order(
    quantity INTEGER NOT NULL,
    price NUMERIC(16,2) NOT NULL DEFAULT 0,
    id_status INTEGER REFERENCES status_order_product(id_status_order_product),
    id_parcel INTEGER REFERENCES parcel(id_parcel),
    id_orders INTEGER REFERENCES orders(id_orders),
    id_product INTEGER REFERENCES product(id_product),
    PRIMARY KEY (id_orders,id_product)
);

CREATE TABLE facture(
    id_facture INTEGER AUTO_INCREMENT PRIMARY KEY,
    date_facture DATE DEFAULT NOW(),
    frais_service INTEGER NOT NULL DEFAULT 0,
    frais_livraison INTEGER NOT NULL DEFAULT 0,
    promotion INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE payment(
    id_payment INTEGER AUTO_INCREMENT PRIMARY KEY,
    method VARCHAR(50) NOT NULL,
    type VARCHAR(50) NOT NULL,
    amount NUMERIC(16,2) NOT NULL DEFAULT 0,
    payment_date DATE NOT NULL DEFAULT NOW()
);