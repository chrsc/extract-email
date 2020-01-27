# Extract Email
I built this package for use in a couple private projects, sharing it to the open source community to grow, their may
be other libraries/packages out there but I required something simple, and fast. This is not a release, consider it beta
for the time being.
 
## Installation
- Clone repo `git clone git@github.com:chrsc/email-extract.git`
- Add to your composer.json file in the repositories section
    ```json
    "repositories": [{
        "type": "path",
        "url": "../{path/to/repo}/extract-email"
    }]
    ```
- Re-run `composer dump-autoload` and package should be discovered.

## Example Usage
- inject url in constructor
```php
use Chrsc\ExtractEmail;

$extractEmails = new ExtractEmail('http://example.url.com');
$emails = $extractEmails->getEmail();
foreach($emails as $email) {
    // do something
}
```
- use setter/getter methods
```php
use Chrsc\ExtractEmail;

$extractEmails = new ExtractEmail();
$emails = $extractEmails->setUrl('http://example.url.com')->getEmail();
foreach($emails as $email) {
    // do something
}
```
## Current test coverage
- 50%

## Todo
- Laravel package auto-loader support
- Laravel Facade creation
- considering separate package for specific usage which is been 1/2 written already, but need to add spreedsheet
    support)
- add to packagist once complete
 