<?php

namespace FondOfSpryker\Client\CompanyUnitAddressPermission\Plugin;

use FondOfSpryker\Shared\CompanyUnitAddressPermission\CompanyUnitAddressPermissionConfig;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Shared\PermissionExtension\Dependency\Plugin\ExecutablePermissionPluginInterface;

class WriteCompanyUnitAddressPermissionPlugin extends AbstractPlugin implements ExecutablePermissionPluginInterface
{
    public const KEY = CompanyUnitAddressPermissionConfig::WRITE_COMPANY_UNIT_ADDRESS_PERMISSION_PLUGIN_KEY;
    public const CONFIG_COMPANY_IDS = CompanyUnitAddressPermissionConfig::PERMISSION_CONFIG_COMPANY_IDS;

    /**
     * Specification:
     * - Defines a permission plugin
     *
     * @api
     *
     * @return string
     */
    public function getKey(): string
    {
        return static::KEY;
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $configuration
     * @param int|string|array|null $context
     *
     * @return bool
     */
    public function can(array $configuration, $context = null): bool
    {
        if ($context === null || !is_int($context)) {
            return false;
        }

        if (
            !array_key_exists(static::CONFIG_COMPANY_IDS, $configuration)
            || !is_array($configuration[static::CONFIG_COMPANY_IDS])
        ) {
            return false;
        }

        return in_array($context, $configuration[static::CONFIG_COMPANY_IDS], false);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @return array
     */
    public function getConfigurationSignature(): array
    {
        return [
        ];
    }
}
