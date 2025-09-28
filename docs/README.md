# OpenCart Product Filter Extension

A minimal, efficient product filtering extension for OpenCart that provides:

## Features

- **Price Range Filter**: Min/max price inputs
- **Brand Filter**: Checkbox list of manufacturers
- **Attribute Filter**: Dynamic attribute-based filtering
- **Metakeywords Filter**: Filter by product meta keywords
- **AJAX-free**: Simple form submission for better compatibility
- **Responsive**: Works with default OpenCart themes

## Filter Types

1. **Price Filter**: Number inputs for minimum and maximum price
2. **Brand Filter**: Checkboxes for each manufacturer/brand
3. **Attribute Filter**: Checkboxes for product attributes (color, size, etc.)
4. **Metakeywords Filter**: Checkboxes for product meta keywords

## Technical Details

- Compatible with OpenCart 3.x
- Uses OCMOD for core integration
- Minimal code footprint
- No external dependencies
- Standard OpenCart MVC structure

## Files Structure

```
admin/
├── controller/extension/module/oc_filter.php
├── language/en-gb/extension/module/oc_filter.php
└── view/template/extension/module/oc_filter.twig

catalog/
├── controller/extension/module/oc_filter.php
├── language/en-gb/extension/module/oc_filter.php
├── model/extension/module/oc_filter.php
└── view/theme/default/template/extension/module/oc_filter.twig

upload/
└── oc_filter.ocmod.xml
```

## Installation

See [INSTALL.md](INSTALL.md) for detailed installation instructions.