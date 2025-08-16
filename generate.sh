#! /bin/sh

openapi-generator generate -i spec.yaml \
-g php \
-o generated \
--additional-properties=invokerPackage="Vented\EnhanceApiLaravel\Client"

# Copy to the proper directory
cp -R ./generated/lib src/Client

# Clean up the generated folder
rm -rf ./generated

composer dump-autoload

# Generate service class
php scripts/generate-service-class.php

# Generate facade documentation
php scripts/generate-facade-docs.php
