# Codecov Setup Guide

This guide explains how to set up Codecov for the IsoFlags repository to get code coverage reporting and badges working.

> **⚠️ Badge showing "unknown"?** See [CODECOV_TROUBLESHOOTING.md](CODECOV_TROUBLESHOOTING.md) for detailed troubleshooting steps.

## What is Codecov?

Codecov is a code coverage reporting tool that integrates with GitHub to provide:
- Code coverage visualization
- Coverage trends over time
- Pull request coverage reports
- Coverage badges for your README

## Setup Steps

### 1. Sign Up for Codecov

1. Go to [codecov.io](https://codecov.io/)
2. Click "Sign up with GitHub"
3. Authorize Codecov to access your GitHub repositories

### 2. Add Your Repository

1. Once logged in, click "Add new repository"
2. Find and select `mainstreamer/isoflags` from the list
3. Codecov will provide you with a repository upload token

### 3. Configure GitHub Secrets

1. Go to your GitHub repository settings
2. Navigate to **Settings → Secrets and variables → Actions**
3. Click "New repository secret"
4. Add a secret with:
   - Name: `CODECOV_TOKEN`
   - Value: [paste the token from Codecov]

### 4. Verify Setup

Once you push code to GitHub:

1. The GitHub Actions workflow will automatically run
2. Tests will execute and generate coverage reports
3. Coverage data will be uploaded to Codecov
4. Check your Codecov dashboard at: `https://codecov.io/gh/mainstreamer/isoflags`

### 5. Badge Configuration

The README already includes the Codecov badge:

```markdown
[![codecov](https://codecov.io/gh/mainstreamer/isoflags/branch/master/graph/badge.svg)](https://codecov.io/gh/mainstreamer/isoflags)
```

This will automatically update once coverage reports start uploading.

## Troubleshooting

### Badge Not Showing

- Make sure the repository is public or you have configured Codecov for private repos
- Verify the repository name in the badge URL matches your GitHub repository
- Check that at least one coverage report has been uploaded

### Coverage Upload Failing

- Verify `CODECOV_TOKEN` is correctly set in GitHub Secrets
- Check the GitHub Actions workflow logs for errors
- Ensure the coverage file path is correct in the workflow

### Coverage Seems Wrong

- Make sure PCOV or Xdebug is properly installed in the CI environment (already configured in workflow)
- Verify `phpunit.xml.dist` has the correct source paths
- Check that all source files are included in the coverage report

## Codecov Configuration (Optional)

You can create a `.codecov.yml` file in the repository root for advanced configuration:

```yaml
# .codecov.yml
coverage:
  status:
    project:
      default:
        target: 80%
        threshold: 5%
    patch:
      default:
        target: 80%

comment:
  layout: "reach, diff, flags, files"
  behavior: default
  require_changes: false

ignore:
  - "tests/*"
  - "vendor/*"
```

## Alternative: Using Coveralls

If you prefer Coveralls over Codecov:

1. Sign up at [coveralls.io](https://coveralls.io)
2. Add your repository
3. Update `.github/workflows/tests.yml` to use Coveralls action instead
4. Update the badge in README.md

## Benefits of Code Coverage

- **Quality Assurance**: Ensures new code is tested
- **Visibility**: Shows which parts of code need more tests
- **Confidence**: Higher coverage often means fewer bugs
- **Documentation**: Coverage reports help new contributors understand what's tested

## Current Coverage

The IsoFlags library currently has 254 tests with 1010 assertions. Once Codecov is configured, you'll be able to see:

- Overall coverage percentage
- File-by-file coverage breakdown
- Line-by-line coverage visualization
- Coverage trends over time
- Pull request coverage impact

## Questions?

If you have issues setting up Codecov, check:
- [Codecov Documentation](https://docs.codecov.io/)
- [GitHub Actions Documentation](https://docs.github.com/en/actions)
- Open an issue in this repository
