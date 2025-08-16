<?php

/**
 * Standalone script to auto-generate the EnhanceApiLaravel service class
 * This script scans all API classes and generates the complete service class with methods
 */

require_once __DIR__ . '/../vendor/autoload.php';

class ServiceClassGenerator
{
    private string $basePath;
    private array $apiClasses = [];
    
    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, '/');
    }
    
    public function generate(): void
    {
        echo "Generating EnhanceApiLaravel service class...\n";
        
        $this->scanApiClasses();
        $this->generateServiceClass();
        
        echo "Service class generated successfully with " . count($this->apiClasses) . " API endpoints!\n";
    }
    
    private function scanApiClasses(): void
    {
        $apiPath = $this->basePath . '/src/Client/Api';
        
        if (!is_dir($apiPath)) {
            throw new Exception("API directory not found: {$apiPath}");
        }
        
        $files = glob($apiPath . '/*Api.php');
        
        foreach ($files as $file) {
            $basename = basename($file, '.php');
            
            if (!str_ends_with($basename, 'Api')) {
                continue;
            }
            
            $apiName = substr($basename, 0, -3); // Remove 'Api' suffix
            $methodName = $this->convertToMethodName($apiName);
            $cacheKey = $this->convertToCacheKey($apiName);
            
            $this->apiClasses[] = [
                'className' => $basename,
                'apiName' => $apiName,
                'methodName' => $methodName,
                'cacheKey' => $cacheKey,
                'fullClassName' => "Vented\\EnhanceApiLaravel\\Client\\Api\\{$basename}",
            ];
        }
        
        // Sort by method name for consistent output
        usort($this->apiClasses, fn($a, $b) => strcmp($a['methodName'], $b['methodName']));
        
        echo "Found " . count($this->apiClasses) . " API classes\n";
    }
    
    private function convertToMethodName(string $apiName): string
    {
        // Handle special cases first
        $specialCases = [
            'EmailClient' => 'emailClient',
            'DNS' => 'dns',
            'FTP' => 'ftp',
            'SSL' => 'ssl',
            'MySQL' => 'mysql',
        ];
        
        if (isset($specialCases[$apiName])) {
            return $specialCases[$apiName];
        }
        
        // Convert PascalCase to camelCase
        return lcfirst($apiName);
    }
    
    private function convertToCacheKey(string $apiName): string
    {
        // Cache key should match method name for consistency
        return $this->convertToMethodName($apiName);
    }
    
    private function generateServiceClass(): void
    {
        $serviceClassPath = $this->basePath . '/src/EnhanceApiLaravel.php';
        
        // Generate imports
        $imports = [];
        foreach ($this->apiClasses as $api) {
            $imports[] = "use {$api['fullClassName']};";
        }
        sort($imports); // Alphabetical order
        
        // Generate methods
        $methods = [];
        foreach ($this->apiClasses as $api) {
            $methods[] = $this->generateApiMethod($api);
        }
        
        // Build the complete class
        $classContent = $this->buildClassTemplate($imports, $methods);
        
        file_put_contents($serviceClassPath, $classContent);
        
        echo "Updated service class at: {$serviceClassPath}\n";
    }
    
    private function generateApiMethod(array $api): string
    {
        return "    public function {$api['methodName']}(): {$api['className']}
    {
        return \$this->apiInstances['{$api['cacheKey']}'] ??= new {$api['className']}(null, \$this->config);
    }";
    }
    
    private function buildClassTemplate(array $imports, array $methods): string
    {
        $importsString = implode("\n", $imports);
        $methodsString = implode("\n\n", $methods);
        
        return "<?php

namespace Vented\EnhanceApiLaravel;

use Vented\EnhanceApiLaravel\Client\Configuration;
{$importsString}

class EnhanceApiLaravel
{
    protected Configuration \$config;
    protected array \$apiInstances = [];

    public function __construct(Configuration \$config)
    {
        \$this->config = \$config;
    }

{$methodsString}

    public function getConfig(): Configuration
    {
        return \$this->config;
    }
}
";
    }
}

// Run the generator
try {
    $generator = new ServiceClassGenerator(__DIR__ . '/..');
    $generator->generate();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}