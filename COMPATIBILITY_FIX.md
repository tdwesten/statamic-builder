# Statamic v5.67.0 Compatibility Fix

## Summary

This fix ensures compatibility with Statamic v5.67.0 where the `BlueprintRepository::$directory` property was changed to `BlueprintRepository::$directories`. The implementation maintains full backward compatibility with earlier versions.

## Changes Made

### 1. Updated `src/Repositories/BlueprintRepository.php`

Added a new protected method `getDirectory()` that:
- Checks for the new `directory()` method introduced in v5.67.0 (first priority)
- Checks for the new `$directories` property (associative array with 'default' key)
- Falls back to the old `$directory` property for pre-v5.67.0 compatibility
- Provides a sensible default if none of the above are available

Updated `makeBlueprintFromFile()` to use `getDirectory()` instead of directly accessing `$this->directory`.

## Compatibility Matrix

| Statamic Version | Property/Method | Status |
|-----------------|-----------------|--------|
| v5.0 - v5.66.x  | `$directory` (string) | ✅ Supported |
| v5.67.0+        | `$directories` (array) + `directory()` method | ✅ Supported |

## Testing

All compatibility scenarios have been tested:

1. ✅ v5.67.0+ with `directory()` method
2. ✅ v5.67.0+ accessing `$directories['default']` directly
3. ✅ Pre-v5.67.0 with `$directory` property
4. ✅ Simple array format (first element)
5. ✅ Fallback to default when no properties set
6. ✅ Empty directories array falls back to directory
7. ✅ Multiple directories in associative array
8. ✅ No PHP syntax errors

Run the test suite:
```bash
php test-compatibility.php
```

## Security

CodeQL analysis performed - no security vulnerabilities detected.

## Backward Compatibility

This fix maintains full backward compatibility. No changes are required to existing code that uses this package.

## References

- Statamic CMS Issue: https://github.com/statamic/cms/blob/d4f75c67534712cef8fd7e185488a27dba3170da/src/Fields/BlueprintRepository.php#L21
- Original Issue: https://github.com/tdwesten/statamic-builder/blob/e39234b5eaec049e29085aae4187b54660477aea/src/Repositories/BlueprintRepository.php#L92
