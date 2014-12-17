<h1>Horus JsonDB ?</h1>
<blockquote>
A secure json based flatfile key value store that helps you in quick and light developments .
</blockquote>

<h1>When to use it ?</h1>
<blockquote>
<ul>
    <li>Building a persistent registry system</li>
    <li>Building a persistent caching system</li>
    <li>Simple key value store</li>
    <li>Store you application settings</li>
    <li>Simple webblogs</li>
</ul>
</blockquote>

<h1>Requirements ?</h1>
<ul>
    <li>Horus 9, from <a href="http://alash3al.github.io/Horus" target="_blank">here</a></li>
</ul>

<h1>Usage ?</h1>
```php
<?php

    // load horus 9 and jsonDB
    require( "H9.php" );
    require( "JsonDB.php" );

    $app = new Horus;

    // initialize jsonDB from a local file
    // it will be created if not exists
    // the directory must be writable .

    $app->jsdb = new JsonDB('basic.file');

    // or tell it to encrypt the file on end
    // $app->jsdb = new JsonDB('secure.file', 'secret-key-to-be-used');

    // it extends Horus_Container Object
    // so it is very easy, just commit after ending .

    // set a key
    $app->jsdb->set('k1', 'v1');
    $app->jsdb->k2 = 'v2';
    $app->jsdb->set(array(
        'k3'    =>  'v3',
        'k4'    =>  'v4'
    ));

    // set a key to false
    $app->jsdb->disable('a_key');

    // check if it were disabled
    $app->jsdb->disabled('a_key');

    // set a key to true
    $app->jsdb->enable('a_key');

    // check if it were enabled
    $app->jsdb->enabled('a_key');

    // get a key
    $k1 = $app->jsdb->get('k1');
    $k3 = $app->jsdb->k3;

    // export all as array
    $all = $app->jsdb->export();

    // export as iterator
    $iterator = $app->jsdb->getIterator();

    // delete
    unset($app->jsdb->k4);

    // save changes "write all to the disk" ?
    $app->jsdb->commit();

    $app->run();
```
