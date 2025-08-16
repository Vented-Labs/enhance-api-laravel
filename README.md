# Enhance API Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vented/enhance-api-laravel.svg?style=flat-square)](https://packagist.org/packages/vented/enhance-api-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/vented-labs/enhance-api-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/vented-labs/enhance-api-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/vented-labs/enhance-api-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/vented-labs/enhance-api-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/vented/enhance-api-laravel.svg?style=flat-square)](https://packagist.org/packages/vented/enhance-api-laravel)

An Enhance API SDK tailored for usage within Laravel applications. This package provides a clean, Laravel-friendly wrapper around the auto-generated Enhance API client, making it easy to integrate Enhance's hosting management capabilities into your Laravel projects.

## Installation

You can install the package via composer:

```bash
composer require vented/enhance-api-laravel
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="enhance-config"
```

## Configuration

Set your Enhance API credentials in your `.env` file:

```env
ENHANCE_API_URL=https://your-enhance-api-endpoint.com
ENHANCE_API_TOKEN=your-api-token-here
ENHANCE_API_ORGANIZATION=your-default-org-id
```

This is the contents of the published config file:

```php
return [
    'base_url' => env('ENHANCE_API_URL', ''),
    'api_key' => env('ENHANCE_API_TOKEN'),
    'default_organization' => env('ENHANCE_API_ORGANIZATION', ''),
    'timeout' => env('ENHANCE_API_TIMEOUT', 30),
    'retry' => [
        'times' => env('ENHANCE_API_RETRY_TIMES', 3),
        'sleep' => env('ENHANCE_API_RETRY_SLEEP', 1000),
    ],
];
```

## Usage

### Via Facade

```php
use Vented\EnhanceApiLaravel\Facades\Enhance;

// Get all organizations
$orgs = Enhance::orgs()->getAllOrgs();

// Get websites
$websites = Enhance::websites()->getWebsites();

// Get domains
$domains = Enhance::domains()->getDomains();

// Manage servers
$servers = Enhance::servers()->getServers();
```

### Via Service Container

```php
use Vented\EnhanceApiLaravel\EnhanceApiLaravel;

class YourController extends Controller
{
    public function __construct(
        private EnhanceApiLaravel $enhance
    ) {}

    public function index()
    {
        $websites = $this->enhance->websites()->getWebsites();
        $domains = $this->enhance->domains()->getDomains();
        
        return view('dashboard', compact('websites', 'domains'));
    }
}
```

## Available API Endpoints

The SDK provides access to all Enhance API endpoints:

- **Apps**: `Enhance::apps()` - Application management
- **Backups**: `Enhance::backups()` - Backup operations  
- **Customers**: `Enhance::customers()` - Customer management
- **DNS**: `Enhance::dns()` - DNS record management
- **Domains**: `Enhance::domains()` - Domain operations
- **Emails**: `Enhance::emails()` - Email account management
- **MySQL**: `Enhance::mysql()` - Database management
- **Organizations**: `Enhance::orgs()` - Organization management
- **Servers**: `Enhance::servers()` - Server management
- **Websites**: `Enhance::websites()` - Website management
- **WordPress**: `Enhance::wordpress()` - WordPress-specific operations
- And many more...

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Vented Labs](https://github.com/Vented-Labs)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
