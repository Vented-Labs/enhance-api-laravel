<?php

/**
 * Standalone script to generate PHPDoc annotations for the Enhance facade
 * This script is called as part of the build process in generate.sh
 */

require_once __DIR__.'/../vendor/autoload.php';

class FacadeDocGenerator
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = rtrim($basePath, '/');
    }

    public function generate(): void
    {
        echo "Generating facade documentation...\n";

        $serviceMethods = $this->scanServiceClass();
        $this->generateFacadeDocBlocks($serviceMethods);

        echo "Facade documentation generated successfully!\n";
    }

    private function scanServiceClass(): array
    {
        $serviceClass = 'Vented\\EnhanceApiLaravel\\EnhanceApiLaravel';

        if (! class_exists($serviceClass)) {
            throw new Exception("Service class not found: {$serviceClass}");
        }

        $reflection = new ReflectionClass($serviceClass);
        $methods = [];

        foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            // Skip constructor and config methods
            if ($method->getName() === '__construct' ||
                $method->getName() === 'getConfig' ||
                $method->isStatic()) {
                continue;
            }

            $returnType = $this->getReturnType($method);

            $methods[] = [
                'name' => $method->getName(),
                'parameters' => $this->getMethodParameters($method),
                'returnType' => $returnType,
            ];
        }

        return $methods;
    }

    private function getMethodParameters(ReflectionMethod $method): string
    {
        $params = [];

        foreach ($method->getParameters() as $param) {
            $paramStr = '';

            // Add type hint
            if ($param->hasType()) {
                $type = $param->getType();
                if ($type instanceof ReflectionNamedType) {
                    $typeName = $type->getName();
                    // Convert built-in types to short form
                    $typeName = match ($typeName) {
                        'string' => 'string',
                        'int' => 'int',
                        'bool' => 'bool',
                        'array' => 'array',
                        'float' => 'float',
                        default => '\\'.$typeName
                    };
                    $paramStr .= ($type->allowsNull() ? '?' : '').$typeName.' ';
                }
            }

            // Add parameter name
            $paramStr .= '$'.$param->getName();

            // Add default value
            if ($param->isDefaultValueAvailable()) {
                $default = $param->getDefaultValue();
                if (is_null($default)) {
                    $paramStr .= ' = null';
                } elseif (is_bool($default)) {
                    $paramStr .= ' = '.($default ? 'true' : 'false');
                } elseif (is_string($default)) {
                    $paramStr .= " = '".addslashes($default)."'";
                } elseif (is_array($default)) {
                    $paramStr .= ' = []';
                } else {
                    $paramStr .= ' = '.$default;
                }
            }

            $params[] = $paramStr;
        }

        return implode(', ', $params);
    }

    private function getReturnType(ReflectionMethod $method): string
    {
        if ($method->hasReturnType()) {
            $returnType = $method->getReturnType();
            if ($returnType instanceof ReflectionNamedType) {
                return '\\'.$returnType->getName();
            }
        }

        // Fallback: try to guess from method name for service methods
        $methodName = $method->getName();
        $apiClassName = '\\Vented\\EnhanceApiLaravel\\Client\\Api\\'.ucfirst($methodName).'Api';
        if (class_exists($apiClassName)) {
            return $apiClassName;
        }

        return 'mixed';
    }

    private function generateFacadeDocBlocks(array $serviceMethods): void
    {
        $facadePath = $this->basePath.'/src/Facades/Enhance.php';

        if (! file_exists($facadePath)) {
            throw new Exception("Facade file not found: {$facadePath}");
        }

        $content = file_get_contents($facadePath);

        // Generate method annotations
        $annotations = [];

        // Add service method annotations
        foreach ($serviceMethods as $method) {
            $params = $method['parameters'] ?: '';
            $annotations[] = " * @method static {$method['returnType']} {$method['name']}({$params})";
        }

        // Build the new docblock
        $docBlock = "/**\n";
        $docBlock .= implode("\n", $annotations)."\n";
        $docBlock .= " *\n";
        $docBlock .= " * @see \\Vented\\EnhanceApiLaravel\\EnhanceApiLaravel\n";
        $docBlock .= ' */';

        // Replace the existing docblock or add if missing
        if (preg_match('/\/\*\*.*?\*\//s', $content)) {
            $content = preg_replace('/\/\*\*.*?\*\//s', $docBlock, $content, 1);
        } else {
            // Add docblock before class declaration
            $content = preg_replace('/(class\s+Enhance)/', $docBlock."\n$1", $content);
        }

        file_put_contents($facadePath, $content);

        echo 'Updated facade with '.count($serviceMethods)." method annotations\n";
    }
}

// Run the generator
try {
    $generator = new FacadeDocGenerator(__DIR__.'/..');
    $generator->generate();
} catch (Exception $e) {
    echo 'Error: '.$e->getMessage()."\n";
    exit(1);
}
