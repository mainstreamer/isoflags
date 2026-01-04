# Release Automation

## Release Flow (PR-based only)

All changes must go through Pull Requests. Never push directly to `master`.

### Standard Release Process

1. **Create a PR with your changes**
   ```bash
   git checkout -b feat/my-feature
   # Make changes
   git commit -m "feat: add new feature"
   git push origin feat/my-feature
   ```

2. **Update CHANGELOG in the same PR** (before merging)
   - Add new version section
   - List all changes

3. **Merge PR to master**
   - All QA checks must pass
   - Get approval if required

4. **Trigger GitHub Release Workflow**
   - Go to: Actions → "Create Release" → Run workflow
   - Enter version (e.g., `1.3.2`)
   - Select type (`patch`, `minor`, or `major`)
   - Click "Run workflow"

5. **Done!**
   - Tag created automatically
   - GitHub Release published
   - Packagist updates automatically

### Versioning

Follow semantic versioning (MAJOR.MINOR.PATCH):
- **PATCH** (1.3.1 → 1.3.2): Bug fixes, typos
- **MINOR** (1.3.2 → 1.4.0): New features, backwards-compatible
- **MAJOR** (1.4.0 → 2.0.0): Breaking changes

### Best Practices

- Update CHANGELOG.md in your PR before merging
- One PR = One Release (release after each merge)
- Never tag/release from feature branches
- All QA checks are automated in the workflow
