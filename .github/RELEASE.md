# Release Process

This document explains how to create a new release for the IsoFlags library on Packagist.

## Quick Release Steps

```bash
# 1. Ensure everything is committed
git status

# 2. Run QA checks
make qa

# 3. Update CHANGELOG.md with version and date

# 4. Commit changes
git add .
git commit -m "chore: prepare release v1.3.1"

# 5. Create and push tag
git tag -a v1.3.1 -m "Release v1.3.1 - 100% coverage, code quality tools"
git push origin master --tags

# 6. Packagist updates automatically (within minutes)
```

## Detailed Steps

### 1. Pre-Release Checklist

- [ ] All tests passing (`make test`)
- [ ] Code style clean (`make cs-check` and `make phpcs`)
- [ ] Psalm analysis passing (`make psalm`)
- [ ] Coverage at acceptable level (`make coverage-text`)
- [ ] CHANGELOG.md updated with version number and date
- [ ] README.md up to date
- [ ] All changes committed to master

### 2. Update CHANGELOG.md

Move unreleased changes to a new version section:

```markdown
## [Unreleased]

## [1.3.1] - 2026-01-04

### Added
- Feature A
- Feature B

### Fixed
- Bug fix A
```

### 3. Commit Release Preparation

```bash
git add CHANGELOG.md
git commit -m "chore: prepare release v1.3.1"
git push origin master
```

### 4. Create Git Tag

**Option A: Annotated Tag (Recommended)**

```bash
# Create annotated tag with message
git tag -a v1.3.1 -m "Release v1.3.1 - 100% coverage, code quality tools"

# Verify tag
git tag -l -n9 v1.3.1
```

**Option B: Lightweight Tag**

```bash
git tag v1.3.1
```

### 5. Push Tag to GitHub

```bash
# Push the tag
git push origin v1.3.1

# Or push all tags
git push origin --tags
```

### 6. Packagist Auto-Update

Packagist automatically detects the new tag within **5-10 minutes** and creates the release.

**Check status:**
- Go to https://packagist.org/packages/mainstreamer/isoflags
- The new version should appear in the version list

### 7. Create GitHub Release (Optional but Recommended)

**Via GitHub CLI:**

```bash
# Install gh if needed: https://cli.github.com/

gh release create v1.3.1 \
  --title "v1.3.1 - Code Quality & 100% Coverage" \
  --notes-file <(sed -n '/## \[1.3.1\]/,/## \[1.3.0\]/p' CHANGELOG.md | head -n -1)
```

**Via GitHub Web:**

1. Go to https://github.com/mainstreamer/isoflags/releases
2. Click "Draft a new release"
3. Select tag: `v1.3.1`
4. Release title: `v1.3.1 - Code Quality & 100% Coverage`
5. Copy description from CHANGELOG.md
6. Click "Publish release"

## Version Numbers (Semantic Versioning)

Follow [Semantic Versioning](https://semver.org/):

- **MAJOR** (1.x.x): Breaking changes
- **MINOR** (x.3.x): New features, backward compatible
- **PATCH** (x.x.1): Bug fixes, backward compatible

Examples:
- `1.3.1` → `1.3.2` - Bug fixes only
- `1.3.1` → `1.4.0` - New features added
- `1.3.1` → `2.0.0` - Breaking changes (remove deprecated methods)

## Post-Release

### Verify Release

```bash
# Check Packagist
curl -s https://packagist.org/packages/mainstreamer/isoflags.json | jq '.package.versions | keys'

# Test installation in a new project
composer create-project --no-install tmp/test-project
cd tmp/test-project
composer require mainstreamer/isoflags:^1.3.1
```

### Update Packagist (Manual)

If Packagist doesn't auto-update:

1. Go to https://packagist.org/packages/mainstreamer/isoflags
2. Click "Update" button
3. Or use webhook (automatic): https://packagist.org/about#how-to-update-packages

### Announce Release

- Twitter/X announcement
- Update documentation site (if any)
- Post in relevant communities

## Rolling Back a Release

If you need to remove a bad release:

```bash
# Delete local tag
git tag -d v1.3.1

# Delete remote tag
git push origin :refs/tags/v1.3.1

# Create new corrected tag
git tag -a v1.3.2 -m "Release v1.3.2 - fixes v1.3.1 issues"
git push origin v1.3.2
```

**Note:** You cannot delete versions from Packagist, but you can mark them as abandoned.

## Automating Releases

### GitHub Actions (Optional)

Create `.github/workflows/release.yml`:

```yaml
name: Release

on:
  push:
    tags:
      - 'v*'

jobs:
  release:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4

      - name: Create GitHub Release
        uses: softprops/action-gh-release@v1
        with:
          body_path: CHANGELOG.md
          draft: false
          prerelease: false
```

## Troubleshooting

### Tag Already Exists

```bash
# List all tags
git tag -l

# Delete and recreate
git tag -d v1.3.1
git tag -a v1.3.1 -m "New message"
git push origin :refs/tags/v1.3.1
git push origin v1.3.1
```

### Packagist Not Updating

1. Check webhook is configured on GitHub
2. Manually trigger update on Packagist.org
3. Check GitHub repository URL is correct in Packagist settings

### Wrong Version Tagged

1. Delete the tag (both local and remote)
2. Fix the version in composer.json (optional)
3. Create correct tag
4. Packagist will pick up the new tag

## Best Practices

1. **Always test before tagging**
   ```bash
   make qa
   ```

2. **Use annotated tags**
   ```bash
   git tag -a v1.3.1 -m "Descriptive message"
   ```

3. **Keep CHANGELOG.md updated**
   - Document all changes
   - Follow "Keep a Changelog" format

4. **Don't force push to tags**
   - Tags should be immutable
   - Create a new version instead

5. **Follow semantic versioning**
   - Makes dependency management easier
   - Helps users understand impact of updates

## Quick Reference

```bash
# Create release
git tag -a v1.3.1 -m "Release message"
git push origin v1.3.1

# Delete tag (if needed)
git tag -d v1.3.1
git push origin :refs/tags/v1.3.1

# List tags
git tag -l

# Show tag details
git show v1.3.1

# Verify Packagist
curl -s https://packagist.org/packages/mainstreamer/isoflags.json | jq
```
