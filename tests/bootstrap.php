<?php
// Include package code
require_once __DIR__.'/../vendor/autoload.php';

// Include test fixtures
require_once __DIR__.'/fixtures/Mapping/AToBMapping.php';
require_once __DIR__.'/fixtures/Mapping/ExtraContentMapping.php';

require_once __DIR__.'/fixtures/Battery.php';
require_once __DIR__.'/fixtures/Device.php';
require_once __DIR__.'/fixtures/ChargeStatusDTO.php';

// Include test mocks
require_once __DIR__.'/mocks/Configuration/MapperConfigurationMock.php';
require_once __DIR__.'/mocks/MappingConfigurations/SimpleMappingConfigurationMock.php';
