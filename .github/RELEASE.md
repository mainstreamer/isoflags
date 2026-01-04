# Release Process

This document explains how to create a new release for the IsoFlags library.

## Prerequisites

- All changes merged to `master` via Pull Requests
- Never push directly to `master` branch
- GitHub Actions workflow configured (`.github/workflows/release.yml`)

## Release Steps

### 1. Create PR with your changes

```bash
git checkout -b feat/my-feature
# Make your changes
git add .
git commit -m "feat: add new feature"
git push origin feat/my-feature
```

### 2. Update CHANGELOG.md in the PR

Before merging, update CHANGELOG.md:

```markdown
## [Unreleased]

## [1.3.2] - 2026-01-04

### Added
- New feature description

### Fixed
- Bug fix description
```

### 3. Merge PR to master

- Ensure all QA checks pass (tests, Psalm, PHP CS Fixer, PHPCS)
- Get approval if required
- Merge the PR

### 4. Trigger GitHub Release Workflow

1. Go to: **Actions** → **"Create Release"** → **Run workflow**
2. Enter version number (e.g., `1.3.2`)
3. Select release type:
   - `patch` - Bug fixes (1.3.1 → 1.3.2)
   - `minor` - New features (1.3.2 → 1.4.0)
   - `major` - Breaking changes (1.4.0 → 2.0.0)
4. Click **"Run workflow"**

### 5. Done!

The workflow automatically:
- Runs all QA checks
- Creates Git tag (e.g., `v1.3.2`)
- Publishes GitHub Release
- Packagist updates automatically within minutes

## Semantic Versioning

Follow [Semantic Versioning](https://semver.org/):

- **MAJOR** (x.0.0): Breaking changes, incompatible API changes
- **MINOR** (1.x.0): New features, backwards-compatible
- **PATCH** (1.3.x): Bug fixes, backwards-compatible

Examples:
- Fix typo: `1.3.1` → `1.3.2` (patch)
- Add new method: `1.3.2` → `1.4.0` (minor)
- Remove deprecated methods: `1.4.0` → `2.0.0` (major)

## Verify Release

### Check Packagist

```bash
# View all versions
curl -s https://packagist.org/packages/mainstreamer/isoflags.json | jq '.package.versions | keys'

# Or visit: https://packagist.org/packages/mainstreamer/isoflags
```

### Test Installation

```bash
composer create-project --no-install tmp/test-project
cd tmp/test-project
composer require mainstreamer/isoflags:^1.3.2
```

## Troubleshooting

### Workflow Failed

1. Check the Actions tab for error details
2. Fix the issue in a new PR
3. Merge the fix
4. Trigger the release workflow again

### Packagist Not Updating

- Packagist auto-updates within 5-10 minutes after tag creation
- If delayed, manually click "Update" on [Packagist package page](https://packagist.org/packages/mainstreamer/isoflags)
- Verify GitHub webhook is configured in Packagist settings

### Wrong Version Released

You cannot delete Packagist versions, but you can:
1. Create a new patch release with the fix
2. Mark the broken version as abandoned on Packagist (if critical)

## Best Practices

✅ **DO:**
- Update CHANGELOG.md in your PR before merging
- One PR = One Release (release after each merge)
- Run QA locally before creating PR (`make qa`)
- Use descriptive commit messages
- Follow semantic versioning

❌ **DON'T:**
- Never push directly to `master` branch
- Never create tags manually (use the workflow)
- Never skip QA checks
- Never release from feature branches

## Quick Reference

```bash
# Local development
git checkout -b feat/my-feature
# ... make changes ...
git commit -m "feat: description"
git push origin feat/my-feature

# After PR merged → Go to GitHub Actions
# Trigger "Create Release" workflow with version number

# Verify
curl -s https://packagist.org/packages/mainstreamer/isoflags.json | jq
```

For automation details, see [RELEASE_AUTOMATION.md](./RELEASE_AUTOMATION.md).
