<?php
/**
 * Elasticsearch PHP client
 *
 * @link      https://github.com/elastic/elasticsearch-php/
 * @copyright Copyright (c) Elasticsearch B.V (https://www.elastic.co)
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @license   https://www.gnu.org/licenses/lgpl-2.1.html GNU Lesser General Public License, Version 2.1 
 * 
 * Licensed to Elasticsearch B.V under one or more agreements.
 * Elasticsearch B.V licenses this file to you under the Apache 2.0 License or
 * the GNU Lesser General Public License, Version 2.1, at your option.
 * See the LICENSE file in the project root for more information.
 */
declare(strict_types = 1);

namespace Elasticsearch\Endpoints\Ilm;

use Elasticsearch\Endpoints\AbstractEndpoint;

/**
 * Class MigrateToDataTiers
 * Elasticsearch API name ilm.migrate_to_data_tiers
 *
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and Elasticsearch 7.16.0 (6fc81662312141fe7691d7c1c91b8658ac17aa0d)
 */
class MigrateToDataTiers extends AbstractEndpoint
{

    public function getURI(): string
    {

        return "/_ilm/migrate_to_data_tiers";
    }

    public function getParamWhitelist(): array
    {
        return [
            'dry_run'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function setBody($body): MigrateToDataTiers
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}
