# Installation Guide

**Important**: This extension does NOT modify any core OpenCart files. It uses OCMOD to safely integrate filtering functionality without touching core code.

## OCMOD Package Installation

### Step 1: Create OCMOD Package
1. Create a ZIP file containing the `upload/` folder
2. Name it `oc_filter.ocmod.zip`
3. The ZIP should contain:
   ```
   upload/
   ├── install.json
   ├── install.xml
   ├── install.php
   ├── uninstall.php
   ├── admin/
   │   ├── controller/extension/oc_filter/module/oc_filter.php (OC 4.0+)
   │   ├── controller/extension/module/oc_filter.php (OC 3.x)
   │   ├── model/extension/oc_filter/module/oc_filter.php (OC 4.0+)
   │   ├── model/extension/module/oc_filter.php (OC 3.x)
   │   ├── language/en-gb/extension/oc_filter/module/oc_filter.php (OC 4.0+)
   │   ├── language/en-gb/extension/module/oc_filter.php (OC 3.x)
   │   ├── view/template/extension/oc_filter/module/oc_filter.twig (OC 4.0+)
   │   └── view/template/extension/module/oc_filter.twig (OC 3.x)
   └── catalog/
       ├── controller/extension/oc_filter/module/oc_filter.php (OC 4.0+)
       ├── controller/extension/module/oc_filter.php (OC 3.x)
       ├── model/extension/oc_filter/module/oc_filter.php (OC 4.0+)
       ├── model/extension/module/oc_filter.php (OC 3.x)
       ├── language/en-gb/extension/oc_filter/module/oc_filter.php (OC 4.0+)
       ├── language/en-gb/extension/module/oc_filter.php (OC 3.x)
       ├── view/theme/default/template/extension/oc_filter/module/oc_filter.twig (OC 4.0+)
       └── view/theme/default/template/extension/module/oc_filter.twig (OC 3.x)
   ```

### Step 2: Install via OpenCart Admin
1. Go to **Extensions > Installer**
2. Upload `oc_filter.ocmod.zip`
3. Go to **Extensions > Modifications**
4. Click **"Refresh"** to apply OCMOD changes
5. **Register extension manually** (see Manual Installation section)
6. Go to **Extensions > Extensions > Modules**
7. Find **"Product Filter"** and click **Install**
8. Click **Edit** to configure filter options

## Manual Installation (Recommended)

### Method 1: Direct File Upload
1. Extract `upload/` folder contents to your OpenCart root directory
2. Go to **Extensions > Modifications**
3. Click **"Refresh"** to apply OCMOD changes
4. **Manually register the extension:**
   - Go to your database (phpMyAdmin/similar)
   - Run this SQL query:
   ```sql
   INSERT INTO `oc_extension` SET `type` = 'module', `code` = 'oc_filter';
   ```
5. Go to **Extensions > Extensions > Modules**
6. Find **"Product Filter"** and click **Install**

### Method 2: OCMOD Package (If Supported)
1. Create ZIP of `upload/` folder → `oc_filter.ocmod.zip`
2. Upload via **Extensions > Installer**
3. Follow steps 2-6 from Method 1

### Database Registration
If module doesn't appear, manually add to database:
```sql
INSERT INTO `oc_extension` SET `type` = 'module', `code` = 'oc_filter';
```

**Note:** Replace `oc_` with your actual database prefix if different.

## OCMOD Requirements

For OpenCart Extension Installer to work:
- ✅ File must be named `*.ocmod.zip`
- ✅ Must contain `upload/` folder
- ✅ Must have `install.json` (extension metadata)
- ✅ Must have `install.xml` (OCMOD modifications)
- ✅ Proper directory structure

## Configuration

1. Enable the module and configure filter types
2. The filter automatically appears on category pages
3. No layout configuration needed - OCMOD handles integration

## Uninstallation / Cleanup

### Before Reinstalling (Fix "File already exist!" error)

1. **Remove Extension Files:**
   ```
   Delete these files from OpenCart root:
   - admin/controller/extension/module/oc_filter.php
   - admin/model/extension/module/oc_filter.php
   - admin/language/en-gb/extension/module/oc_filter.php
   - admin/view/template/extension/module/oc_filter.twig
   - catalog/controller/extension/module/oc_filter.php
   - catalog/model/extension/module/oc_filter.php
   - catalog/language/en-gb/extension/module/oc_filter.php
   - catalog/view/theme/default/template/extension/module/oc_filter.twig
   ```

2. **Remove OCMOD Modification:**
   - Go to **Extensions > Modifications**
   - Find "Product Filter Extension" and click **Delete**
   - Click **Refresh**

3. **Clean Database:**
   ```sql
   DELETE FROM `oc_extension` WHERE `code` = 'oc_filter';
   DELETE FROM `oc_setting` WHERE `code` = 'module_oc_filter';
   DROP TABLE IF EXISTS `oc_filter_cache`;
   ```

4. **Clear OpenCart Cache:**
   
   **OpenCart 4.x:**
   - Delete contents of `system/storage/cache/`
   - Delete contents of `system/storage/logs/`
   
   **OpenCart 3.x:**
   - Delete contents of `system/storage/cache/`
   - Delete contents of `system/storage/logs/`
   
   **OpenCart 2.x and older:**
   - Delete contents of `system/cache/`
   - Delete contents of `system/logs/`
   - Delete contents of `image/cache/` (optional)

### Quick Cleanup Script
Run this SQL to completely remove the extension:
```sql
-- Remove extension registration
DELETE FROM `oc_extension` WHERE `code` = 'oc_filter';
-- Remove all settings
DELETE FROM `oc_setting` WHERE `code` = 'module_oc_filter';
-- Remove cache table
DROP TABLE IF EXISTS `oc_filter_cache`;
```

## Core Files Integrity

This extension maintains OpenCart's core file integrity by using:
- Standard extension file structure
- OCMOD for safe core integration
- No direct core file modifications