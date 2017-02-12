# laravel-mailchimp-segment
Simple Laravel service for MailChimp Segments

# Install
* composer install -- make sure to add repo as repository
* Add API key to .env file
    * `MAILCHIMP_APIKEY='123344dfff-us10'`
    * Must use the single quotes!
* Add provider in config/app.php
    * In package service providers add:
    *  `\calderawp\mailchimp\segments\PackageServiceProvider::class`

# Usage

Primary usage is to add or remove emails from segments, but lower-level APIs are provided.


## Working With Pre-Exsiting Segments
NOTE: `$listId` and `$segmentId` are assumed

### Get emails from a segment

```php
    //create object for segment
    $segement = \calderawp\mailchimp\segments\Factory::segment( config('mailchimp-segments.apiKey'), $listId, ) $segmentId );
    
    $emails = $segment->getEmails();
```

### Add emails to a segment

```php
    //create object for segment
    $segement = \calderawp\mailchimp\segments\Factory::segment( config('mailchimp-segments.apiKey'), $listId, ) $segmentId );
    
    //$emials will contain all emails in segment after update
    //Note, addresses not in list are ignored
    $emails = $segement->addEmails([
              		'frodo@bagend.com',
              		'bilbo@bagend.com'
              	]);
    
```

### Remove emails from a segment

```php
    //create object for segment
    $segement = \calderawp\mailchimp\segments\Factory::segment( config('mailchimp-segments.apiKey'), $listId, $segmentId );
    
    //$emials will contain all emails in segment after update
    //Note, addresses not in list are ignored
    $emails = $segement->removeEmails([
              		'sam@bagend.com',
              	]);
    
```

## Other Examples 
### Create segment
```php
    $segmentAPI = \calderawp\mailchimp\segments\Factory::segments( config('mailchimp-segments.apiKey') );
    $listId = 'f402a6993d';
    $segmentAPI->create( $listId, [
    			'frodo@bagend.com',
               'bilbo@bagend.com'
    		],'Test Segment' );
```

### Get All Segments Of A List

```php
    $segmentAPI = \calderawp\mailchimp\segments\Factory::segments( config('mailchimp-segments.apiKey') );
    $listId = 'f402a6993d';
    $segments = $segmentAPI->segments( $listId );
```

### Get All Segments Of All Lists For An Account
```php
    $lists = \calderawp\mailchimp\segments\Factory::lists( config('mailchimp-segments.apiKey') );
    $ids = $lists->getListIds();
    $segments = [];
    foreach( $ids as $listId ){
        $segmentAPI = \calderawp\mailchimp\segments\Factory::segments( config('mailchimp-segments.apiKey') );
    
        $s = $segmentAPI->segments( $listId );
        $segments  = array_merge($segments, $s );
    }

```


# License, etc.
 Copyrigtht 2017 CalderaWP LLC - License: GPL V2 or later
