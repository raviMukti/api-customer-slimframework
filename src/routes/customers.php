<?php

$app = new \Slim\App($config);

// Define app routes

// Get All Customers
$app->get('/api/customers', function ($request, $response, $args) {
    // return $response->withStatus(200)->write('Customers Works!');

    $sql = "SELECT * FROM customers";

    try {
        //Get Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($customers, JSON_PRETTY_PRINT));

    } catch (PDOException $e) {
        //throw $e
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write('Ada kesalahan koneksi ke database '.json_encode($e->getMessage(), JSON_PRETTY_PRINT));
    }
});

// Get Single Customer
$app->get('/api/customers/{id}', function ($request, $response, $args) {

    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM customers WHERE id = $id";

    try {
        //Get Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write(json_encode($customer, JSON_PRETTY_PRINT));

    } catch (PDOException $e) {
        //throw $e
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write('Ada kesalahan koneksi ke database '.json_encode($e->getMessage(), JSON_PRETTY_PRINT));
    }
});


// Add Customer
$app->post('/api/customers/add', function ($request, $response, $args) {

    // Get the required params
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $city = $request->getParam('city');
    $state = $request->getParam('state');

    $sql = "INSERT INTO db_slim.customers (first_name, last_name, phone, email, city, state) VALUES (:first_name, :last_name, :phone, :email, :city, :state)";

    try {
        //Get Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);

        $stmt->execute();

        $db = null;
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write('Success OK!');

    } catch (PDOException $e) {
        //throw $e
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write('Ada kesalahan saat input data '.json_encode($e->getMessage(), JSON_PRETTY_PRINT));
    }
});



// Update Customer
$app->put('/api/customers/update/{id}', function ($request, $response, $args) {
    // Get id Attribute
    $id = $request->getAttribute('id');
    // Get the required params
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $city = $request->getParam('city');
    $state = $request->getParam('state');

    $sql = "UPDATE customers SET first_name = :first_name, last_name = :last_name, phone = :phone, email = :email, city = :city, state = :state WHERE id = $id";

    try {
        //Get Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);

        $stmt->execute();

        $db = null;
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write('Updated Successfully!');

    } catch (PDOException $e) {
        //throw $e
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write('Ada kesalahan saat update data '.json_encode($e->getMessage(), JSON_PRETTY_PRINT));
    }
});



// Delete Customer
$app->delete('/api/customers/delete/{id}', function ($request, $response, $args) {

    $id = $request->getAttribute('id');

    $sql = "DELETE FROM customers WHERE id = $id";

    try {
        //Get Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        
        $stmt->execute();

        $db = null;
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json')->write('Auch Deleted successfully!');

    } catch (PDOException $e) {
        //throw $e
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json')->write('Ada kesalahan koneksi ke database '.json_encode($e->getMessage(), JSON_PRETTY_PRINT));
    }
});