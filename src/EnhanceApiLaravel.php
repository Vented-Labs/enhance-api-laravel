<?php

namespace Vented\EnhanceApiLaravel;

use Vented\EnhanceApiLaravel\Client\Api\AppsApi;
use Vented\EnhanceApiLaravel\Client\Api\BackupsApi;
use Vented\EnhanceApiLaravel\Client\Api\BrandingApi;
use Vented\EnhanceApiLaravel\Client\Api\CustomersApi;
use Vented\EnhanceApiLaravel\Client\Api\DnsApi;
use Vented\EnhanceApiLaravel\Client\Api\DomainsApi;
use Vented\EnhanceApiLaravel\Client\Api\EmailClientApi;
use Vented\EnhanceApiLaravel\Client\Api\EmailsApi;
use Vented\EnhanceApiLaravel\Client\Api\FtpApi;
use Vented\EnhanceApiLaravel\Client\Api\ImportersApi;
use Vented\EnhanceApiLaravel\Client\Api\InstallApi;
use Vented\EnhanceApiLaravel\Client\Api\InvitesApi;
use Vented\EnhanceApiLaravel\Client\Api\LetsencryptApi;
use Vented\EnhanceApiLaravel\Client\Api\LicenceApi;
use Vented\EnhanceApiLaravel\Client\Api\LoginsApi;
use Vented\EnhanceApiLaravel\Client\Api\MembersApi;
use Vented\EnhanceApiLaravel\Client\Api\MetricsApi;
use Vented\EnhanceApiLaravel\Client\Api\MigrationsApi;
use Vented\EnhanceApiLaravel\Client\Api\MysqlApi;
use Vented\EnhanceApiLaravel\Client\Api\OrgsApi;
use Vented\EnhanceApiLaravel\Client\Api\OwnerApi;
use Vented\EnhanceApiLaravel\Client\Api\PlansApi;
use Vented\EnhanceApiLaravel\Client\Api\ReportsApi;
use Vented\EnhanceApiLaravel\Client\Api\ServersApi;
use Vented\EnhanceApiLaravel\Client\Api\SettingsApi;
use Vented\EnhanceApiLaravel\Client\Api\SslApi;
use Vented\EnhanceApiLaravel\Client\Api\SubscriptionsApi;
use Vented\EnhanceApiLaravel\Client\Api\TagsApi;
use Vented\EnhanceApiLaravel\Client\Api\WebsitesApi;
use Vented\EnhanceApiLaravel\Client\Api\WordpressApi;
use Vented\EnhanceApiLaravel\Client\Configuration;

class EnhanceApiLaravel
{
    protected Configuration $config;

    protected array $apiInstances = [];

    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    public function apps(): AppsApi
    {
        return $this->apiInstances['apps'] ??= new AppsApi(null, $this->config);
    }

    public function backups(): BackupsApi
    {
        return $this->apiInstances['backups'] ??= new BackupsApi(null, $this->config);
    }

    public function branding(): BrandingApi
    {
        return $this->apiInstances['branding'] ??= new BrandingApi(null, $this->config);
    }

    public function customers(): CustomersApi
    {
        return $this->apiInstances['customers'] ??= new CustomersApi(null, $this->config);
    }

    public function dns(): DnsApi
    {
        return $this->apiInstances['dns'] ??= new DnsApi(null, $this->config);
    }

    public function domains(): DomainsApi
    {
        return $this->apiInstances['domains'] ??= new DomainsApi(null, $this->config);
    }

    public function emailClient(): EmailClientApi
    {
        return $this->apiInstances['emailClient'] ??= new EmailClientApi(null, $this->config);
    }

    public function emails(): EmailsApi
    {
        return $this->apiInstances['emails'] ??= new EmailsApi(null, $this->config);
    }

    public function ftp(): FtpApi
    {
        return $this->apiInstances['ftp'] ??= new FtpApi(null, $this->config);
    }

    public function importers(): ImportersApi
    {
        return $this->apiInstances['importers'] ??= new ImportersApi(null, $this->config);
    }

    public function install(): InstallApi
    {
        return $this->apiInstances['install'] ??= new InstallApi(null, $this->config);
    }

    public function invites(): InvitesApi
    {
        return $this->apiInstances['invites'] ??= new InvitesApi(null, $this->config);
    }

    public function letsencrypt(): LetsencryptApi
    {
        return $this->apiInstances['letsencrypt'] ??= new LetsencryptApi(null, $this->config);
    }

    public function licence(): LicenceApi
    {
        return $this->apiInstances['licence'] ??= new LicenceApi(null, $this->config);
    }

    public function logins(): LoginsApi
    {
        return $this->apiInstances['logins'] ??= new LoginsApi(null, $this->config);
    }

    public function members(): MembersApi
    {
        return $this->apiInstances['members'] ??= new MembersApi(null, $this->config);
    }

    public function metrics(): MetricsApi
    {
        return $this->apiInstances['metrics'] ??= new MetricsApi(null, $this->config);
    }

    public function migrations(): MigrationsApi
    {
        return $this->apiInstances['migrations'] ??= new MigrationsApi(null, $this->config);
    }

    public function mysql(): MysqlApi
    {
        return $this->apiInstances['mysql'] ??= new MysqlApi(null, $this->config);
    }

    public function orgs(): OrgsApi
    {
        return $this->apiInstances['orgs'] ??= new OrgsApi(null, $this->config);
    }

    public function owner(): OwnerApi
    {
        return $this->apiInstances['owner'] ??= new OwnerApi(null, $this->config);
    }

    public function plans(): PlansApi
    {
        return $this->apiInstances['plans'] ??= new PlansApi(null, $this->config);
    }

    public function reports(): ReportsApi
    {
        return $this->apiInstances['reports'] ??= new ReportsApi(null, $this->config);
    }

    public function servers(): ServersApi
    {
        return $this->apiInstances['servers'] ??= new ServersApi(null, $this->config);
    }

    public function settings(): SettingsApi
    {
        return $this->apiInstances['settings'] ??= new SettingsApi(null, $this->config);
    }

    public function ssl(): SslApi
    {
        return $this->apiInstances['ssl'] ??= new SslApi(null, $this->config);
    }

    public function subscriptions(): SubscriptionsApi
    {
        return $this->apiInstances['subscriptions'] ??= new SubscriptionsApi(null, $this->config);
    }

    public function tags(): TagsApi
    {
        return $this->apiInstances['tags'] ??= new TagsApi(null, $this->config);
    }

    public function websites(): WebsitesApi
    {
        return $this->apiInstances['websites'] ??= new WebsitesApi(null, $this->config);
    }

    public function wordpress(): WordpressApi
    {
        return $this->apiInstances['wordpress'] ??= new WordpressApi(null, $this->config);
    }

    public function getConfig(): Configuration
    {
        return $this->config;
    }
}
