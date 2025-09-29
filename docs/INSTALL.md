# Installation Guide

**Important**: This extension does NOT modify any core OpenCart files. It uses OCMOD to safely integrate filtering functionality without touching core code.

## Installation Steps

1. Upload all extension files to your OpenCart root directory:
   - `admin/` folder contents
   - `catalog/` folder contents

2. Install the OCMOD modification:
   - Upload `upload/oc_filter.ocmod.xml` via Extensions > Installer
   - OR manually copy to `system/` folder

3. Apply modifications:
   - Go to Extensions > Modifications
   - Click "Refresh" to apply OCMOD changes

4. Install the module:
   - Go to Extensions > Extensions > Modules
   - Find "Product Filter" and click Install
   - Click Edit to configure filter options

## Why OCMOD is Required

The OCMOD file safely modifies core functionality without changing core files:
- Integrates filter parameters into category controller
- Adds filtering logic to product model queries
- Displays filter module in category templates

## Configuration

1. Enable the module and configure filter types
2. The filter automatically appears on category pages
3. No layout configuration needed - OCMOD handles integration

## Core Files Integrity

This extension maintains OpenCart's core file integrity by using:
- Standard extension file structure
- OCMOD for safe core integration
- No direct core file modifications