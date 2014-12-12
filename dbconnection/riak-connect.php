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

    # Connect to Riak
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
    $data = $person->getData();
    $data = $data['name'];
    # Update the object
    //$person->data['company'] = "Google";
    //$person->store();

    print_r($data);
