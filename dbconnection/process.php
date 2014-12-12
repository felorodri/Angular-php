<?php

require_once('riak-php-client/src/Basho/Riak/Riak.php');
require_once('riak-php-client/src/Basho/Riak/Bucket.php');
require_once('riak-php-client/src/Basho/Riak/Exception.php');
require_once('riak-php-client/src/Basho/Riak/Link.php');
require_once('riak-php-client/src/Basho/Riak/MapReduce.php');
require_once('riak-php-client/src/Basho/Riak/Object.php');
require_once('riak-php-client/src/Basho/Riak/StringIO.php');
require_once('riak-php-client/src/Basho/Riak/Utils.php');
require_once('riak-php-client/src/Basho/Riak/Link/Phase.php');
require_once('riak-php-client/src/Basho/Riak/MapReduce/Phase.php');

$errors = array(); // array to hold validation errors
$data = array(); // array to pass back data
// validate the variables ======================================================
if (empty($_POST['name']))
$errors['name'] = 'Name is required.';
if (empty($_POST['email']))
$errors['email'] = 'Email is required.';
if (empty($_POST['password']))
$errors['password'] = 'Password is required.';
// return a response ===========================================================
// response if there are errors
if ( ! empty($errors)) {
  // if there are items in our errors array, return those errors
  $data['success'] = false;
  $data['errors'] = $errors;

  if (array_key_exists('name', $errors))
      $data['messageError'] = $errors['name'];
  if (array_key_exists('email', $errors))
      $data['messageError'] = $errors['email'];
  if (array_key_exists('password', $errors))
      $data['messageError'] = $errors['password'];

  //$data['messageError'] = 'Please check the fields in red';
} else {
  
  try {

      $name = $_POST['name']; // required
      $email = $_POST['email']; // required
      $password = $_POST['password']; // required
      $crypted_password = crypt('$password');

      
      $client = new Basho\Riak\Riak('127.0.0.1', 10018);

       # Choose a bucket name
      $bucket = $client->bucket('test');

      # Supply a key under which to store your data
      /*$person = $bucket->newObject('riak_developer_1', array(
          'name' => "John Smith",
          'age' => 28,
          'company' => "Facebook"
      ));

      # Save the object to Riak
      $person->store();*/

      # Fetch the object
      $person = $bucket->get('riak_developer_1');
      $person_data = $person->getData();
      $person_data = $person_data['name'];
      # Update the object
      //$person->data['company'] = "Google";
      //$person->store();

      // if there are no errors, return a message
      $data['success'] = true;
      $data['messageSuccess'] = $data_info;//'Registration complete!';
      // CHANGE THE TWO LINES BELOW
      //$email_to = "yourEmailHere@gmail.com";
      //$email_subject = "message submission";
      
      //$data['password'] = crypt('$password');
      //$data['messageSuccess'] = crypt($password);;
      //$email_message = "Form details below.nn";
      //$email_message .= "Name: ".$name."n";
      //$email_message .= "Email: ".$email_from."n";
      //$email_message .= "Message: ".$message."n";
      //$headers = 'From: '.$email_from."rn".
      //'Reply-To: '.$email_from."rn" .
      //'X-Mailer: PHP/' . phpversion();
      //@mail($email_to, $email_subject, $email_message, $headers);

    } catch (Exception $e) {
        
        $data['success'] = false;
        $data['errors'] = $errors;
        $data['messageError'] = 'No se pudo conectar el servidor. Por favor intentelo más tarde ';//,  $e->getMessage(), "\n";
       
      }
  
}
// return all our data to an AJAX call
echo json_encode($data);