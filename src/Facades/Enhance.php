<?php

namespace Vented\EnhanceApiLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Vented\EnhanceApiLaravel\Client\Api\AppsApi apps()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\BackupsApi backups()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\BrandingApi branding()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\CustomersApi customers()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\DnsApi dns()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\DomainsApi domains()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\EmailClientApi emailClient()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\EmailsApi emails()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\FtpApi ftp()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\ImportersApi importers()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\InstallApi install()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\InvitesApi invites()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\LetsencryptApi letsencrypt()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\LicenceApi licence()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\LoginsApi logins()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\MembersApi members()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\MetricsApi metrics()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\MigrationsApi migrations()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\MysqlApi mysql()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\OrgsApi orgs()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\OwnerApi owner()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\PlansApi plans()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\ReportsApi reports()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\ServersApi servers()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\SettingsApi settings()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\SslApi ssl()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\SubscriptionsApi subscriptions()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\TagsApi tags()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\WebsitesApi websites()
 * @method static \Vented\EnhanceApiLaravel\Client\Api\WordpressApi wordpress()
 *
 * @see \Vented\EnhanceApiLaravel\EnhanceApiLaravel
 */
class Enhance extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Vented\EnhanceApiLaravel\EnhanceApiLaravel::class;
    }
}
