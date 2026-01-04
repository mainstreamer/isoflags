# Codecov Badge Showing "Unknown" - Troubleshooting Guide

If your Codecov badge is showing "unknown", follow these steps to diagnose and fix the issue.

## Quick Diagnosis Checklist

1. ✅ **Has the GitHub Actions workflow run?**
2. ✅ **Is Codecov configured for your repository?**
3. ✅ **Is the CODECOV_TOKEN set in GitHub Secrets?**
4. ✅ **Did the coverage upload succeed?**

## Step-by-Step Fix

### 1. Check GitHub Actions Status

First, verify that your CI pipeline has run:

1. Go to your repository on GitHub
2. Click on the "Actions" tab
3. Look for workflow runs of "CI Pipeline"
4. Check if any workflows have run and their status

**If no workflows have run:**
- Push a commit to trigger the workflow
- The workflow runs on pushes to `master` and on pull requests

**If workflows failed:**
- Click on the failed workflow
- Check the logs for errors
- Common issues:
  - Missing dependencies
  - Test failures
  - Coverage generation errors

### 2. Set Up Codecov

**Option A: Using Codecov (Recommended for Public Repos)**

1. Go to [codecov.io](https://codecov.io)
2. Sign in with GitHub
3. Click "Add new repository"
4. Find and select `mainstreamer/isoflags`
5. **For public repositories:** No token needed! Skip to step 3
6. **For private repositories:** Copy the upload token

**Option B: Skip Codecov Token (Public Repos Only)**

For public repositories, you can use Codecov without a token. The workflow is already configured with `fail_ci_if_error: false`, so it will work even without the token.

### 3. Configure GitHub Secrets (Private Repos Only)

If your repository is private:

1. Go to your GitHub repository
2. Click **Settings** → **Secrets and variables** → **Actions**
3. Click "New repository secret"
4. Name: `CODECOV_TOKEN`
5. Value: Paste the token from Codecov
6. Click "Add secret"

### 4. Trigger a Workflow Run

Push a commit or manually trigger the workflow:

```bash
# Make a small change
git commit --allow-empty -m "chore: trigger codecov"
git push origin master
```

Or manually trigger from GitHub:
1. Go to **Actions** tab
2. Select "CI Pipeline" workflow
3. Click "Run workflow"
4. Select the branch and click "Run workflow"

### 5. Verify Coverage Upload

After the workflow runs:

1. Go to the **Actions** tab in your GitHub repository
2. Click on the latest "CI Pipeline" run
3. Expand the "Upload coverage to Codecov" step
4. Look for success messages like:
   ```
   [info] Uploading reports
   [info] View reports at https://codecov.io/github/mainstreamer/isoflags
   ```

### 6. Check Codecov Dashboard

1. Go to [codecov.io/gh/mainstreamer/isoflags](https://codecov.io/gh/mainstreamer/isoflags)
2. You should see coverage data
3. If you see "Not found", the upload may have failed

## Badge URL Options

### Current Badge (Simple)
```markdown
[![codecov](https://codecov.io/gh/mainstreamer/isoflags/branch/master/graph/badge.svg)](https://codecov.io/gh/mainstreamer/isoflags)
```

### With Token (If Simple Version Doesn't Work)
```markdown
[![codecov](https://codecov.io/gh/mainstreamer/isoflags/branch/master/graph/badge.svg?token=YOUR_BADGE_TOKEN)](https://codecov.io/gh/mainstreamer/isoflags)
```

**To get your badge token:**
1. Go to codecov.io/gh/mainstreamer/isoflags
2. Click **Settings** → **Badge**
3. Copy the badge markdown (includes token)

### Alternative Badge Services

If you prefer not to use Codecov, you can use alternatives:

**Coveralls:**
```markdown
[![Coverage Status](https://coveralls.io/repos/github/mainstreamer/isoflags/badge.svg?branch=master)](https://coveralls.io/github/mainstreamer/isoflags?branch=master)
```

**Shields.io (Manual Update Required):**
```markdown
![Coverage](https://img.shields.io/badge/coverage-100%25-brightgreen)
```

## Common Issues & Solutions

### Issue: "Error: Codecov token not found"

**Solution:**
- For public repos: Remove the token requirement from the workflow
- For private repos: Add `CODECOV_TOKEN` to GitHub Secrets

**Fix for public repos:** Update `.github/workflows/tests.yml`:
```yaml
- name: Upload coverage to Codecov
  uses: codecov/codecov-action@v4
  with:
    files: ./coverage.xml
    fail_ci_if_error: false
    verbose: true
  # Remove the 'token' line for public repos
```

### Issue: "No coverage data uploaded"

**Possible causes:**
1. Coverage file not generated
2. Wrong file path in workflow
3. Coverage driver (PCOV) not installed in CI

**Solution:**
Check the workflow logs for the "Generate coverage report" step. Ensure it completes successfully.

### Issue: Badge shows old coverage percentage

**Solution:**
- Wait a few minutes for Codecov to update
- Clear your browser cache
- Add `?branch=master` to the badge URL to ensure it's reading the right branch

### Issue: Workflow runs but coverage not uploaded

**Check:**
1. Verify `coverage.xml` is generated:
   ```yaml
   - name: Generate coverage report
     run: ./vendor/bin/phpunit --coverage-clover coverage.xml
   ```

2. Check file exists before upload (add debug step):
   ```yaml
   - name: Check coverage file
     run: |
       ls -la coverage.xml
       head -20 coverage.xml
   ```

## Testing Locally

Generate coverage locally to test:

```bash
# Install PCOV (if not installed)
pecl install pcov

# Generate coverage
./vendor/bin/phpunit --coverage-text

# Generate Clover XML (same format as CI)
./vendor/bin/phpunit --coverage-clover coverage.xml

# Check if file was created
ls -la coverage.xml
```

## Manual Upload (Testing)

Test manual upload to Codecov:

```bash
# Install Codecov uploader
curl -Os https://uploader.codecov.io/latest/linux/codecov
chmod +x codecov

# Upload (requires CODECOV_TOKEN for private repos)
./codecov -t YOUR_TOKEN -f coverage.xml
```

## Still Having Issues?

1. **Check Codecov Status:** [status.codecov.io](https://status.codecov.io)
2. **Review Workflow Logs:** Look for specific error messages
3. **Test with Empty Commit:** `git commit --allow-empty -m "test: codecov"`
4. **Contact Support:** Open an issue on [codecov/feedback](https://github.com/codecov/feedback)

## Success Indicators

You'll know it's working when:

- ✅ Badge shows a percentage (e.g., "100%")
- ✅ Codecov dashboard shows your repository
- ✅ GitHub Actions workflow completes successfully
- ✅ "Upload coverage to Codecov" step shows success
- ✅ Codecov comments appear on pull requests (if enabled)

## Next Steps After Setup

Once working, consider:

1. **Set coverage targets** in `codecov.yml`
2. **Enable PR comments** for coverage changes
3. **Add coverage requirements** to protect branch rules
4. **Monitor coverage trends** on Codecov dashboard

---

**Quick Start for Public Repos (No Token Needed):**

1. Push your code to GitHub
2. Workflow runs automatically
3. Badge updates within 5-10 minutes
4. That's it! No Codecov account or token needed.

**Quick Start for Private Repos:**

1. Sign up at codecov.io
2. Add your repository
3. Copy the upload token
4. Add as `CODECOV_TOKEN` in GitHub Secrets
5. Push code to trigger workflow
6. Badge updates automatically
