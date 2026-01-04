.PHONY: help install test coverage psalm cs-fix cs-check phpcs phpcbf qa pipeline clean

CYAN := \033[0;36m
RESET := \033[0m

# Default target
help: ## Show this help message
	@printf "\\nUsage: make $(CYAN)[target]$(RESET)\\n\\n"
	@echo 'Targets:'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  $(CYAN)%-22s$(RESET) %s\n", $$1, $$2}' $(MAKEFILE_LIST) | sort -f

install: ## Install dependencies
	@composer install

update: ## Update dependencies
	@composer update

test: ## Run PHPUnit tests
	@vendor/bin/phpunit

test-filter: ## Run specific test: make test-filter FILTER=testMethodName
	@vendor/bin/phpunit --filter $(FILTER)

coverage: ## Generate code coverage report (HTML) - requires PCOV or Xdebug
	@echo "Checking for coverage driver..."
	@php -r "if (!extension_loaded('pcov') && !extension_loaded('xdebug')) { echo 'Error: No coverage driver found. Install PCOV or Xdebug.\n'; echo 'Run: sudo dnf install php-pecl-pcov\n'; exit(1); }"
	@php -d pcov.enabled=1 vendor/bin/phpunit --coverage-html coverage/html --coverage-text
	@echo "Coverage report: coverage/html/index.html"

coverage-text: ## Show code coverage in terminal - requires PCOV or Xdebug
	@echo "Checking for coverage driver..."
	@php -r "if (!extension_loaded('pcov') && !extension_loaded('xdebug')) { echo '\nError: No coverage driver found.\n'; echo 'Install PCOV: sudo dnf install php-pecl-pcov\n'; echo 'Or Xdebug: sudo dnf install php-pecl-xdebug\n\n'; echo 'Note: Coverage works automatically in CI/GitHub Actions.\n'; exit(1); }"
	@php -d pcov.enabled=1 vendor/bin/phpunit --coverage-text

psalm: ## Run Psalm static analysis
	@vendor/bin/psalm --no-cache

psalm-baseline: ## Generate Psalm baseline
	@vendor/bin/psalm --set-baseline=psalm-baseline.xml

psalm-info: ## Show Psalm info (detailed analysis)
	@vendor/bin/psalm --show-info=true

cs-fix: ## Fix code style with PHP CS Fixer
	@echo "Fixing code style with PHP CS Fixer..."
	@vendor/bin/php-cs-fixer fix --verbose

cs-check: ## Check code style without fixing
	@echo "Checking code style with PHP CS Fixer..."
	@vendor/bin/php-cs-fixer check --diff --verbose

phpcs: ## Check PSR-12 and line length with PHPCS
	@echo "Checking code standards with PHPCS..."
	@vendor/bin/phpcs src/ tests/ --standard=phpcs.xml.dist

phpcbf: ## Auto-fix code standards with PHPCBF
	@echo "Fixing code standards with PHPCBF..."
	@vendor/bin/phpcbf src/ tests/ --standard=phpcs.xml.dist

qa: ## Run full quality assurance pipeline
	@echo "=== Running Quality Assurance Pipeline ==="
	@echo ""
	@echo "1/4 Running PHPUnit tests..."
	@vendor/bin/phpunit
	@echo ""
	@echo "2/4 Running Psalm static analysis..."
	@vendor/bin/psalm --no-cache
	@echo ""
	@echo "3/4 Checking code style (PHP CS Fixer)..."
	@vendor/bin/php-cs-fixer check --diff
	@echo ""
	@echo "4/4 Checking PSR-12 standards (PHPCS)..."
	@vendor/bin/phpcs src/ tests/ --standard=phpcs.xml.dist
	@echo ""
	@echo "=== Quality Assurance Complete ==="

pipeline: qa ## Alias for qa (run full pipeline)

fix: ## Auto-fix all code style issues
	@echo "Fixing code style issues..."
	@vendor/bin/php-cs-fixer fix --verbose
	@vendor/bin/phpcbf src/ tests/ --standard=phpcs.xml.dist || true
	@echo "Code style fixes applied!"

clean: ## Clean generated files
	@rm -rf coverage/
	@rm -rf .phpunit.cache/
	@rm -f .php-cs-fixer.cache
	@echo "Cleaned generated files"

validate: ## Validate composer.json
	@composer validate --strict

init: install ## Initialize project (install dependencies)
	@echo "Project initialized!"

check: qa ## Alias for qa
